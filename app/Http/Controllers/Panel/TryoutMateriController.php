<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Models\Tryout;
use App\Models\TryoutJawaban;
use App\Models\TryoutMateri;
use App\Models\TryoutSoal;
use App\Models\TryoutPengerjaan;
use App\Models\TryoutNilai;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Illuminate\Support\Facades\Validator;

class TryoutMateriController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'soal_jenis' => 'required|in:PDF,EXCEL,FORM',
            'tyout_materi_id' => 'required',
            /*'periode_mulai' => 'required',
            'periode_selesai' => 'required',
            'waktu_mulai' => 'nullable',
            'waktu_selesai' => 'nullable',
            'durasi' => 'nullable',
            'safe_mode' => 'required|integer',*/
        ]);

        $tryoutMateri = TryoutMateri::find($request->tyout_materi_id);
        $tryoutMateri->jenis_soal = $request->soal_jenis;
        /*$tryoutMateri->periode_mulai = $request->periode_mulai;
        $tryoutMateri->periode_selesai = $request->periode_selesai;
        $tryoutMateri->waktu_mulai = $request->waktu_mulai;
        $tryoutMateri->waktu_selesai = $request->waktu_selesai;
        $tryoutMateri->durasi = $request->durasi;
        $tryoutMateri->safe_mode = $request->safe_mode;*/
        if ($request->soal_jenis == 'PDF') {
            $request->validate([
                'soal' => 'required|mimes:pdf|max:10000',
            ]);

            if ($request->file('soal')) {
                $file = $request->file('soal');

                // Buat direktori jika belum ada
                $directory = 'public/uploads/soal';
                if (!Storage::exists($directory)) {
                    Storage::makeDirectory($directory);
                }

                // Rename file
                $fileName = time() . '_' . $file->getClientOriginalName();

                // Simpan file
                $file->storeAs($directory, $fileName);

                $fileSoal = $directory . '/' . $fileName;

                $tryoutMateri->master_soal =  $fileSoal;


                $result = $this->convertPdfToImage(($fileName));

                $postSoal = [];
                $nomorSoal = 1;
                foreach ($result as $key => $value) {
                    $postSoal[] = [
                        'tryout_materi_id' => $tryoutMateri->tryout_materi_id,
                        'tryout_nomor' => $nomorSoal,
                        'tryout_soal' => $value['soal'],
                        'tryout_penyelesaian' => $value['jawaban'],
                    ];
                    $nomorSoal++;
                }
                $tryoutMateri->jumlah_soal =  $nomorSoal;
                TryoutSoal::insert($postSoal);
                //dd($result);
            }
        } else if ($request->soal_jenis == 'EXCEL') {
            $request->validate([
                'soal' => 'required|mimes:xls,xlsx|max:10000',
            ]);

            $file = $request->file('soal');

            // Buat direktori jika belum ada
            $directory = 'public/uploads/soal';
            if (!Storage::exists($directory)) {
                Storage::makeDirectory($directory);
            }

            // Rename file
            $fileName = time() . '_' . $file->getClientOriginalName();
            $fileName = '1761660654_Contoh Format Upload SOal.xlsx';

            // Simpan file
            //$file->storeAs($directory, $fileName);

            $fileSoal = $directory . '/' . $fileName;

            $tryoutMateri->master_soal =  $fileSoal;

            $spreadsheet = IOFactory::load(storage_path('app/' . $fileSoal));
            $sheet = $spreadsheet->getActiveSheet();

            $rows = array_map(function ($r) {
                $r = array_pad($r, 10, null);
                $r = array_map(fn($v) => is_string($v) ? trim($v) : $v, $r);
                if (isset($r[1])) $r[1] = strtoupper($r[1]); // tipe soal
                return $r;
            }, array_slice($sheet->toArray(), 1));

            foreach ($rows as $i => $row) {
                $baris = $i + 2; // karena baris pertama header

                $rules["{$i}.1"] = ['required', 'in:SC,MCMA,TF']; // tipe soal
                $rules["{$i}.2"] = ['required', 'string']; // pertanyaan
                $rules["{$i}.7"] = ['required']; // kunci jawaban
                $rules["{$i}.8"] = ['required', 'numeric', 'min:1']; // bobot

                $messages["{$i}.1.required"] = "Baris {$baris}: Tipe Soal wajib diisi.";
                $messages["{$i}.1.in"] = "Baris {$baris}: Tipe Soal hanya boleh SC, MCMA, atau TF.";
                $messages["{$i}.2.required"] = "Baris {$baris}: Pertanyaan wajib diisi.";
                $messages["{$i}.7.required"] = "Baris {$baris}: Kunci Jawaban wajib diisi.";
                $messages["{$i}.8.required"] = "Baris {$baris}: Bobot wajib diisi.";
                $messages["{$i}.8.numeric"] = "Baris {$baris}: Bobot harus berupa angka.";
                $messages["{$i}.8.min"] = "Baris {$baris}: Bobot minimal 1.";
            }

            $validator = Validator::make($rows, $rules, $messages);

            $validator->after(function ($validator) use ($rows) {
                foreach ($rows as $i => $row) {
                    $baris = $i + 2;
                    $tipeSoal = strtoupper(trim($row[1] ?? ''));
                    $kunci = strtoupper(trim($row[7] ?? ''));
                    $notes = trim($row[9] ?? '');

                    // validasi lanjutan tergantung tipe soal
                    if ($tipeSoal === 'SC') {
                        if (!preg_match('/^[A-D]$/', $kunci)) {
                            $validator->errors()->add("{$i}.7", "Baris {$baris}: SC harus punya satu kunci jawaban (A-D).");
                        }
                    }

                    if ($tipeSoal === 'MCMA') {
                        $keys = array_map('trim', explode(',', $kunci));
                        foreach ($keys as $key) {
                            if (!in_array($key, ['A', 'B', 'C', 'D'])) {
                                $validator->errors()->add("{$i}.7", "Baris {$baris}: MCMA hanya boleh huruf A-D (contoh: A,C).");
                            }
                        }
                    }

                    if ($tipeSoal === 'TF') {
                        $keys = array_map('trim', explode(',', $kunci));
                        $jumlahPernyataan = 0;
                        for ($col = 3; $col <= 6; $col++) {
                            if (!empty($row[$col])) $jumlahPernyataan++;
                        }

                        if (count($keys) !== $jumlahPernyataan) {
                            $validator->errors()->add("{$i}.7", "Baris {$baris}: Jumlah kunci TF tidak sesuai jumlah pernyataan ({$jumlahPernyataan}).");
                        }

                        foreach ($keys as $key) {
                            if (!in_array($key, ['B', 'S'])) {
                                $validator->errors()->add("{$i}.7", "Baris {$baris}: Kunci TF hanya boleh berisi B atau S.");
                            }
                        }
                    }
                }
            });

            if ($validator->fails()) {
                return back()->withErrors($validator)->withInput();
            }
            foreach ($rows as $key => $value) {

                $tipe = $value[1];
                $kunci = strtoupper(trim($value[7]));

                if ($tipe == 'SC') {
                    $formattedKunci = [$kunci]; // ['A'] 
                } elseif ($tipe == 'MCMA') {
                    $formattedKunci = array_map('trim', explode(',', $kunci)); // ['A','C','D']
                } elseif ($tipe == 'TF') {
                    // buat pasangan huruf ke Benar/Salah
                    $keys = array_map('trim', explode(',', $kunci));
                    $formattedKunci = [];
                    $opsi = ['A', 'B', 'C', 'D'];
                    foreach ($keys as $idx => $key) {
                        $formattedKunci[$opsi[$idx]] = ($key === 'B') ? 'Benar' : 'Salah';
                    }
                }

                $dataSoal['tryout_materi_id'] = $request->tyout_materi_id;
                $dataSoal['tryout_nomor'] = $value[0];
                $dataSoal['point'] = $value[8];
                $dataSoal['tryout_soal'] = $value[2];
                $dataSoal['tryout_soal_type'] = $value[1];
                $dataSoal['tryout_kunci_jawaban'] = json_encode($formattedKunci);
                $dataSoal['notes'] = $value[9];
               
                $inertSoal = TryoutSoal::create($dataSoal);

                $prefixes = ['A', 'B', 'C', 'D']; // huruf pilihan jawaban
                $dataJawaban = [];
                foreach ($prefixes as $index => $prefix) {
                    $kolomIndex = 3 + $index;
                    $dataJawaban[] = [
                        'tryout_materi_id'       => $request->tyout_materi_id,
                        'tryout_soal_id'         => $inertSoal->tryout_soal_id,
                        'tryout_jawaban_prefix'  => $prefix,
                        'tryout_jawaban_urutan'  => $index + 1,
                        'tryout_jawaban_isi'     => $value[$kolomIndex],
                        'created_at'             => now(),
                        'updated_at'             => now(),
                    ];
                }

                // lalu tinggal insert batch
                TryoutJawaban::insert($dataJawaban);
            }
            $tryoutMateri->update();

            return redirect()->route('panel.tryout_materi.show', $tryoutMateri->tryout_materi_id);
        } else {
            $request->validate([
                'jumlah_soal' => 'required',
            ]);
            $tryoutMateri->jumlah_soal =  $request->jumlah_soal;

            $postSoal = [];
            $nomorSoal = 1;
            for ($i = 1; $i <= $request->jumlah_soal; $i++) {
                $postSoal[] = [
                    'tryout_materi_id' => $tryoutMateri->tryout_materi_id,
                    'tryout_nomor' => $i,
                ];
            }
            TryoutSoal::insert($postSoal);
        }
        $tryoutMateri->update();

        return redirect()->route('panel.tryout_materi.createJawaban', $tryoutMateri->tryout_materi_id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $tryoutMateri = TryoutMateri::find($id);

        $load['tryout_materi'] = $tryoutMateri;
        $load['pengajar'] = User::whereHas(
            'roles',
            function ($q) {
                $q->where('id', 3);
            }
        )->get();


        return view('pages.panel.tryout_materi.show', $load);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tryoutMateri = TryoutMateri::find($id);
        $tryoutMateri->delete();
        TryoutSoal::where('tryout_materi_id', $tryoutMateri->tryout_materi_id)->delete();
        TryoutJawaban::where('tryout_materi_id', $tryoutMateri->tryout_materi_id)->delete();
        TryoutPengerjaan::where('tryout_materi_id', $tryoutMateri->tryout_materi_id)->delete();
        TryoutNilai::where('tryout_materi_id', $tryoutMateri->tryout_materi_id)->delete();


        return redirect()->route('panel.tryout.show', $tryoutMateri->tryout_id)
            ->withSuccess(('Materi Tryout Berhasil dihapus.'));
    }

    /**
     * Add jawaban after input soal.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function createJawaban($id)
    {
        $tryoutMateri = TryoutMateri::find($id);

        $load['tryout_materi'] = $tryoutMateri;

        return view('pages.panel.tryout_materi.createJawaban', $load);
    }
    /**
     * Store jawaban after input soal.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateJawaban($id, Request $request)
    {
        $request->validate([
            'opsi_jawaban' => 'required',
            'jawaban' => 'required'
        ]);

        $tryoutSaol = TryoutSoal::find($id);
        $tryoutSaol->tryout_kunci_jawaban = json_encode($request->opsi_jawaban);
        $tryoutSaol->update();

        foreach ($request->jawaban as $key => $value) {
            $tryouJawaban = TryoutJawaban::find($key);
            $tryouJawaban->tryout_jawaban_isi = $value;
            $tryouJawaban->update();
        }

        return redirect()->route('panel.tryout_materi.show', $tryoutSaol->tryout_materi_id);
    }
    /**
     * Store jawaban after input soal.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function storeJawaban($id, Request $request)
    {
        $request->validate([
            'point'        => 'required|array',
            'jenis_soal'   => 'required|array',
            'notes'        => 'required|array',
            'jawaban'      => 'required|array',
        ]);

        foreach ($request->jenis_soal as $key => $jenis) {
            // --- Validasi point ---
            if (empty($request->point[$key]) || $request->point[$key] <= 0) {
                throw ValidationException::withMessages([
                    "point.$key" => "Point untuk soal ID $key harus diisi dan lebih dari 0.",
                ]);
            }

            // --- Validasi jenis soal SC ---
            if ($jenis === 'SC') {
                if (empty($request->opsi_jawaban[$key]) || count($request->opsi_jawaban[$key]) != 1) {
                    throw ValidationException::withMessages([
                        "opsi_jawaban.$key" => "Soal SC (Single Choice) harus memiliki tepat 1 jawaban benar.",
                    ]);
                }
            }

            // --- Validasi jenis soal MCMA ---
            if ($jenis === 'MCMA') {
                if (empty($request->opsi_jawaban[$key]) || count($request->opsi_jawaban[$key]) < 2) {
                    throw ValidationException::withMessages([
                        "opsi_jawaban.$key" => "Soal MCMA (Multiple Answer) harus memiliki minimal 2 jawaban benar.",
                    ]);
                }
            }

            // --- Validasi jenis soal TF (True/False) ---
            if ($jenis === 'TF') {
                // Pastikan notes diisi dan sesuai format
                $notes = trim(strtolower($request->notes[$key]));
                if (!in_array($notes, ['benar,salah', 'setuju,tidak setuju'])) {
                    throw ValidationException::withMessages([
                        "notes.$key" => "Soal TF harus memiliki notes 'Benar,Salah' atau 'Setuju,Tidak setuju'.",
                    ]);
                }

                // Pastikan tiap pernyataan punya jawaban benar/salah
                if (empty($request->opsi_jawaban_tf[$key]) || !is_array($request->opsi_jawaban_tf[$key])) {
                    throw ValidationException::withMessages([
                        "opsi_jawaban_tf.$key" => "Soal TF harus memiliki opsi jawaban Benar/Salah untuk setiap pernyataan.",
                    ]);
                }

                foreach ($request->opsi_jawaban_tf[$key] as $label => $value) {
                    $val = strtolower($value);
                    if (!in_array($val, ['benar', 'salah', 'setuju', 'tidak setuju'])) {
                        throw ValidationException::withMessages([
                            "opsi_jawaban_tf.$key.$label" => "Nilai '$value' pada soal TF ID $key tidak valid. Gunakan 'Benar', 'Salah', 'Setuju', atau 'Tidak setuju'.",
                        ]);
                    }
                }
            }
        }

        $susunJawaban = [];
        $urutan = 1;

        // --- Simpan opsi jawaban (A, B, C, D) ---
        foreach ($request->jawaban as $soalId => $opsi) {
            foreach ($opsi as $prefix => $jawaban) {
                $susunJawaban[] = [
                    'tryout_materi_id' => $id,
                    'tryout_soal_id' => $soalId,
                    'tryout_jawaban_prefix' => $prefix,
                    'tryout_jawaban_urutan' => $urutan,
                    'tryout_jawaban_isi' => $jawaban,
                ];
                $urutan++;
            }
            $urutan = 1;
        }

        // --- Update point tiap soal ---
        foreach ($request->point as $soalId => $point) {
            $tryoutSoal = TryoutSoal::find($soalId);
            if ($tryoutSoal) {
                $tryoutSoal->point = $point;
                $tryoutSoal->update();
            }
        }

        // --- Update teks soal ---
        if ($request->soal) {
            foreach ($request->soal as $soalId => $value) {
                $tryoutSoal = TryoutSoal::find($soalId);
                if ($tryoutSoal) {
                    $tryoutSoal->tryout_soal = $value;
                    $tryoutSoal->update();
                }
            }
        }

        // --- Update jenis soal dan kunci jawaban ---
        foreach ($request->jenis_soal as $soalId => $jenis) {
            $tryoutSoal = TryoutSoal::find($soalId);
            if (!$tryoutSoal) continue;

            $tryoutSoal->tryout_soal_type = $jenis;

            // Tentukan kunci jawaban sesuai jenis soal
            if ($jenis === 'MCMA' || $jenis === 'SC') {
                // multiple choice / single choice
                $tryoutSoal->tryout_kunci_jawaban = isset($request->opsi_jawaban[$soalId])
                    ? json_encode($request->opsi_jawaban[$soalId])
                    : null;
            } elseif ($jenis === 'TF') {
                // multiple choice multiple answer (Benar / Salah)
                $tryoutSoal->tryout_kunci_jawaban = isset($request->opsi_jawaban_tf[$soalId])
                    ? json_encode($request->opsi_jawaban_tf[$soalId])
                    : null;
            }

            // Simpan jenis jawaban tambahan (contoh: Benar,Salah)
            if (isset($request->notes[$soalId])) {
                $tryoutSoal->notes = $request->notes[$soalId];
            }

            $tryoutSoal->update();
        }

        // --- Insert jawaban baru ---
        TryoutJawaban::where('tryout_materi_id', $id)->delete();
        TryoutJawaban::insert($susunJawaban);

        return redirect()->route('panel.tryout_materi.show', $id);
    }

    public function convertPdfToImage($pdfFilePath)
    {
        $outputImagePath = 'public/uploads/soal/image';
        if (!Storage::exists($outputImagePath)) {
            Storage::makeDirectory($outputImagePath);
        }

        $pdf = new \Spatie\PdfToImage\Pdf(storage_path('app/public/uploads/soal/' . $pdfFilePath));

        $pageNumber = $pdf->getNumberOfPages();
        $susunSoal = [];
        $susunJawaban = [];

        for ($i = 1; $i <= $pageNumber; $i++) {

            // buat nama file
            $fileName = ($i % 2 == 0 ? 'jawaban_' : 'soal_') . $i . '_' . time() . '.jpg';
            $fullPath = storage_path('app/public/uploads/soal/image/' . $fileName);

            // konversi ke gambar
            $pdf->setPage($i)->saveImage($fullPath);

            // buka hasil gambar pakai Imagick
            $imagick = new \Imagick($fullPath);

            // ambil ukuran asli
            $width = $imagick->getImageWidth();
            $height = $imagick->getImageHeight();

            // crop setengah bagian atas
            $imagick->cropImage($width, $height / 2, 0, 0); // x=0, y=0 artinya mulai dari atas
            $imagick->writeImage($fullPath);

            // simpan ke array hasil
            if ($i % 2 == 0) {
                $susunJawaban[] = 'public/uploads/soal/image/' . $fileName;
            } else {
                $susunSoal[] = 'public/uploads/soal/image/' . $fileName;
            }

            // bersihkan memory
            $imagick->clear();
            $imagick->destroy();
        }

        // susun hasil akhir
        $susunData = [];
        foreach ($susunSoal as $key => $value) {
            $susunData[$key]['soal'] = $value;
            $susunData[$key]['jawaban'] = $susunJawaban[$key] ?? '';
        }

        return $susunData;
    }
}
