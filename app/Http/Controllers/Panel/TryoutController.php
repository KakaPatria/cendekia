<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use App\Models\KelasCendekia;
use App\Models\KelasSiswaCendekia;
use App\Models\PrefixNumber;
use App\Models\Tryout;
use App\Models\TryoutMateri;
use App\Models\TryoutPeserta;
use App\Models\TryoutSoal;
use App\Models\TryoutJawaban;
use App\Models\TryoutPengerjaan;
use App\Models\TryoutNilai;
use Illuminate\Support\Str;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;

class TryoutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user = auth()->user();
        $tryout = Tryout::query();
        
        // Filter berdasarkan kata kunci pencarian
        if ($request->keyword) {
            $keyword = $request->keyword;
            $keywordUpper = strtoupper($keyword);
            
            // Cek apakah keyword berisi angka kelas (1-12)
            if (is_numeric($keyword) && $keyword >= 1 && $keyword <= 12) {
                $tryout->where('tryout_kelas', $keyword);
            }
            // Cek apakah keyword berisi kata kunci jenjang
            else if (in_array($keywordUpper, ['SD', 'SMP', 'SMA'])) {
                $tryout->where('tryout_jenjang', $keywordUpper);
            } 
            // Cek apakah keyword adalah 'cendekia' atau 'umum'
            else if (strtolower($keyword) === 'cendekia') {
                $tryout->where('is_open', 'Cendekia');
            }
            else if (strtolower($keyword) === 'umum') {
                $tryout->where('is_open', 'Umum');
            }
            // Pencarian normal untuk keyword lainnya
            else {
                $tryout->where(function($q) use ($request) {
                    $q->where('tryout_judul', 'like', "%{$request->keyword}%")
                      ->orWhere('tryout_deskripsi', 'like', "%{$request->keyword}%")
                      ->orWhere('tryout_jenis', 'like', "%{$request->keyword}%")
                      ->orWhereHas('materi.refMateri', function($q) use ($request) {
                          $q->where('ref_materi_judul', 'like', "%{$request->keyword}%");
                      });
                });
            }
        }

        // Filter berdasarkan jenjang dan kelas dari dropdown
        $tryout->when($request->jenjang, function ($query) use ($request) {
            return $query->where('tryout_jenjang', $request->jenjang);
        })->when($request->kelas, function ($query) use ($request) {
            return $query->where('tryout_kelas', $request->kelas);
        });
        if (!$user->hasRole(['Admin'])) {
            // dd($user->hasRole(['Admin']));

            $tryout->whereHas('materi', function ($q1) use ($user) {
                $q1->where('pengajar_id', $user->id);
            });
        }
        $tryout = $tryout->orderByDesc('tryout_register_due');
        $load['tryout'] = $tryout->paginate(10);

        $load['keyword'] = $request->keyword;
        $load['filter_jenjang'] = $request->jenjang;
        $load['filter_kelas'] = $request->kelas;

        return view('pages.panel.tryout.index', ($load));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $load['pengajar'] = User::whereHas(
            'roles',
            function ($q) {
                $q->where('id', 3);
            }
        )->get();

        return view('pages.panel.tryout.create', ($load));
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
            'tryout_judul' => 'required|string|max:255',
            'tryout_jenjang' => 'required|string|in:SD,SMP,SMA',
            'tryout_kelas' => 'required|integer|min:1|max:12',
            'tryout_register_due' => 'required|date',
            'tryout_status' => 'required',
            'tryout_jenis' => 'required|in:Gratis,Berbayar',
            'tryout_nominal' => [
                function ($attribute, $value, $fail) use ($request) {
                    if ($request->is_open === 'Umum' && $request->tryout_jenis === 'Berbayar' && $value <= 0) {
                        $fail('Nominal harus lebih dari 0 jika tryout berbayar.');
                    }
                },
            ],
            'is_open' => 'required|in:Cendekia,Umum',
            'tampilkan_kunci' => 'required|in:Ya,Tidak',
        ]);

        $tryout = new Tryout();
        $tryout->tryout_judul = $request->tryout_judul;
        $tryout->tryout_deskripsi = $request->tryout_deskripsi ?? '';
        $tryout->tryout_jenjang = $request->tryout_jenjang;
        $tryout->tryout_kelas = $request->tryout_kelas;
        $tryout->tryout_register_due = $request->tryout_register_due;
        $tryout->tryout_status = $request->tryout_status;
        $tryout->tryout_jenis = $request->tryout_jenis;
        $tryout->tryout_nominal = $request->tryout_nominal ?? 0;
        $tryout->tryout_diskon = $request->tryout_diskon ?? 0;
        $tryout->is_open = $request->is_open;
        $tryout->tampilkan_kunci = $request->tampilkan_kunci;
        $tryout->save();

        if ($request->is_open == 'Cendekia') {
            $kelasCendekia = KelasCendekia::find($request->kelas_cendekia_id);

            $peserta = KelasSiswaCendekia::where('kelas_cendekia_id', $request->kelas_cendekia_id)
                ->get();
            $listPesertaData = [];
            foreach ($peserta as $key => $value) {
                $listPesertaData[$key]['tryout_id'] =  $tryout->tryout_id;
                $listPesertaData[$key]['user_id'] = $value->siswa_id;
                $listPesertaData[$key]['tryout_peserta_name'] = $value->siswa->name;
                $listPesertaData[$key]['tryout_peserta_telpon'] = $value->siswa->telepon;
                $listPesertaData[$key]['tryout_peserta_email'] = $value->siswa->email;
                $listPesertaData[$key]['tryout_peserta_alamat'] = $value->siswa->alamat ?? '';
                $listPesertaData[$key]['tryout_peserta_status'] = 1;
            }
            TryoutPeserta::insert($listPesertaData);

            foreach ($kelasCendekia->jadwal as $key => $value) {
                TryoutMateri::insert([
                    'tryout_materi_id' => Str::random(10),
                    'tryout_id' => $tryout->tryout_id,
                    'materi_id' => $value->ref_materi_id,
                    'pengajar_id' => $value->guru_id,
                    'durasi' => '120',
                    'safe_mode' => 1,
                    'tryout_materi_deskripsi' => $value->jadwal_cendekia_keterangan
                ]);
            }
        }

        if ($request->file('tryout_banner')) {
            $file = $request->file('tryout_banner');

            // Buat direktori jika belum ada
            $directory = 'public/uploads/banner_tryout';
            if (!Storage::exists($directory)) {
                Storage::makeDirectory($directory);
            }

            // Rename file
            $fileName = time() . '_' . $file->getClientOriginalName();

            // Simpan file
            $file->storeAs($directory, $fileName);

            $tryout->tryout_banner = $directory . '/' . $fileName;
            $tryout->update();
        }

        return redirect()->route('panel.tryout.show', $tryout->tryout_id)
            ->withSuccess(('Tryout Berhasil ditambahkan.'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $load['tryout'] = Tryout::where('tryout_id', $id)->first()->load('materi.refMateri');
        $load['pengajar'] = User::whereHas(
            'roles',
            function ($q) {
                $q->where('id', 3);
            }
        )->get();

        return view('pages.panel.tryout.show', $load);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $load['pengajar'] = User::whereHas(
            'roles',
            function ($q) {
                $q->where('id', 3);
            }
        )->get();

        $load['tryout'] = Tryout::where('tryout_id', $id)->first()->load('materi.refMateri');

        return view('pages.panel.tryout.edit', $load);
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
        $request->validate([
            'tryout_judul' => 'required|string|max:255',
            'tryout_jenjang' => 'required|string|in:SD,SMP,SMA',
            'tryout_kelas' => 'required|integer|min:1|max:12',
            'tryout_register_due' => 'required|date',
            'tryout_status' => 'required',
            //'tryout_jenis' => 'required|in:Gratis,Berbayar',
            'tryout_nominal' => [
                function ($attribute, $value, $fail) use ($request) {
                    if ($request->tryout_jenis === 'Berbayar' && $value <= 0) {
                        $fail('Nominal harus lebih dari 0 jika tryout berbayar.');
                    }
                },
            ],
            //'tryout_nominal' => 'required',
            //'is_open' => 'required',
            'tampilkan_kunci' => 'required|in:Ya,Tidak',
        ]);

        $tryout = Tryout::find($id);
        $tryout->tryout_judul = $request->tryout_judul;
        $tryout->tryout_deskripsi = $request->tryout_deskripsi ?? '';
        $tryout->tryout_jenjang = $request->tryout_jenjang;
        $tryout->tryout_kelas = $request->tryout_kelas;
        $tryout->tryout_register_due = $request->tryout_register_due;
        $tryout->tryout_status = $request->tryout_status;
        //$tryout->tryout_jenis = $request->tryout_jenis;
        $tryout->tryout_nominal = $request->tryout_nominal ?? 0;
        $tryout->tryout_diskon = $request->tryout_diskon ?? 0;
        //$tryout->is_open = $request->is_open;
        $tryout->tampilkan_kunci = $request->tampilkan_kunci;
        $tryout->update();

        if ($request->file('tryout_banner')) {
            $file = $request->file('tryout_banner');

            // Buat direktori jika belum ada
            $directory = 'public/uploads/banner_tryout';
            if (!Storage::exists($directory)) {
                Storage::makeDirectory($directory);
            }

            // Rename file
            $fileName = time() . '_' . $file->getClientOriginalName();

            // Simpan file
            $file->storeAs($directory, $fileName);

            $tryout->tryout_banner = $directory . '/' . $fileName;
            $tryout->update();
        }



        return redirect()->route('panel.tryout.show', $tryout->tryout_id)
            ->withSuccess(('Tryout Berhasil Diupdate.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Tryout::where('tryout_id', $id)->delete();
        TryoutPeserta::where('tryout_id', $id)->delete();
        $materi = TryoutMateri::where('tryout_id', $id)->get();

        foreach ($materi as $key => $value) {
            TryoutSoal::where('tryout_materi_id', $value->tryout_materi_id)->delete();
            TryoutJawaban::where('tryout_materi_id', $value->tryout_materi_id)->delete();
            TryoutPengerjaan::where('tryout_materi_id', $value->tryout_materi_id)->delete();
            TryoutNilai::where('tryout_materi_id', $value->tryout_materi_id)->delete();
            $value->delete();
        }



        return redirect()->route('panel.tryout.index')
            ->withSuccess(('Tryout Berhasil dihapus.'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function addMateri(Request $request, $id)
    {
        $request->validate([
            'materi_id' => 'required',
            'pengajar_id' => 'required',
            'tryout_materi_deskripsi' => 'required',
            'durasi' => 'required',
        ]);
        $tryout = Tryout::find($id);


        TryoutMateri::insert([
            'tryout_materi_id' => Str::random(10),
            'tryout_id' => $tryout->tryout_id,
            'materi_id' => $request->materi_id,
            'pengajar_id' => $request->pengajar_id,
            'durasi' => $request->durasi,
            'safe_mode' => $request->safe_mode,
            'tryout_materi_deskripsi' => $request->tryout_materi_deskripsi
        ]);

        return redirect()->route('panel.tryout.show', $tryout->tryout_id)
            ->withSuccess(('Materi Tryout Berhasil ditambahkan.'));
    }

    public function editMateri(Request $request, $id)
    {
        $request->validate([
            'materi_id' => 'required',
            'pengajar_id' => 'required',
            'tryout_materi_deskripsi' => 'required',
            'periode_mulai' => 'required',
            'periode_selesai' => 'required',
            'safe_mode' => 'required|integer',
        ]);
        $tryoutMateri = TryoutMateri::find($id);
        $tryoutMateri->materi_id =  $request->materi_id;
        $tryoutMateri->pengajar_id =  $request->pengajar_id;
        $tryoutMateri->tryout_materi_deskripsi =  $request->tryout_materi_deskripsi;
        $tryoutMateri->periode_mulai = $request->periode_mulai;
        $tryoutMateri->periode_selesai = $request->periode_selesai;
        $tryoutMateri->safe_mode = $request->safe_mode;
        $tryoutMateri->waktu_mulai = $request->waktu_mulai;
        $tryoutMateri->waktu_selesai = $request->waktu_selesai;
        $tryoutMateri->durasi = $request->durasi * 60;
        $tryoutMateri->update();


        return redirect()->route('panel.tryout_materi.show', $id)
            ->withSuccess(('Materi Tryout Berhasil diupdate.'));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function addPeserta(Request $request, $id)
    {
        $tryout = Tryout::find($id);

        foreach ($request->siswa as $key => $value) {

            $user = User::find($value);
            $peserta = new TryoutPeserta();

            $peserta->tryout_id = $id;
            $peserta->user_id = $user->id;
            $peserta->tryout_peserta_name = $user->name;
            $peserta->tryout_peserta_telpon = $user->telepon;
            $peserta->tryout_peserta_email = $user->email;
            $peserta->tryout_peserta_alamat = $user->alamat ?? '';
            $peserta->tryout_peserta_status = 1;
            $peserta->save();

            if ($tryout->tryout_jenis != 'Gratis') {
                $prefix = PrefixNumber::find('Invoice')->first() ?? 1;
                $prefix->value = $prefix->value + 1;
                $prefix->update();

                $invoice = new Invoice();
                $invoice->user_id = $user->id;
                $invoice->inv_id = 'IN-' . date('ym') . '-' . sprintf('%04d', ($prefix->value));
                $invoice->keterangan = 'Biaya ' . $tryout->tryout_judul;
                $invoice->tryout_id = $request->tryout_id;
                $invoice->tryout_peserta_id = $peserta->tryout_peserta_id;
                $invoice->amount = $tryout->getRawOriginal('tryout_nominal');
                $invoice->status = 1;
                $invoice->due_date = Carbon::now()->format('Y-m-d');
                $invoice->inv_paid = Carbon::now()->format('Y-m-d');
                $invoice->save();
            }
        }
        return redirect()->route('panel.tryout.show', $tryout->tryout_id)
            ->withSuccess(('Siswa Berhasil ditambahkan.'));
    }

    public function exportPeserta($id)
    {

        $tryout = Tryout::where('tryout_id', $id)->first()->load('materi.refMateri');

        //$spreadsheet = new Spreadsheet();
        //$pegawaiSheet = new \PhpOffice\PhpSpreadsheet\Worksheet\Worksheet($spreadsheet, 'Data Peserta tryout');
        //$spreadsheet->addSheet($pegawaiSheet, 0);

        //$activeSheet = $spreadsheet->getSheetByName('Data Peserta tryout');
        $spreadsheet = new Spreadsheet();
        $activeSheet = $spreadsheet->getActiveSheet();
        $activeSheet->getColumnDimension('A')->setAutoSize(true);
        $activeSheet->getColumnDimension('B')->setAutoSize(true);
        $activeSheet->getColumnDimension('C')->setAutoSize(true);
        $activeSheet->getColumnDimension('D')->setAutoSize(true);
        $activeSheet->getColumnDimension('E')->setAutoSize(true);
        $activeSheet->getColumnDimension('F')->setAutoSize(true);
        $activeSheet->getColumnDimension('G')->setAutoSize(true);


        $activeSheet->mergeCells('A1:H1');
        $activeSheet->getStyle('A1')->getFont()->setSize(14);  // Mengatur ukuran font
        $activeSheet->getStyle('A1')->getFont()->setBold(true);  // Mengatur bold
        $activeSheet->getStyle('A1')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
        $activeSheet->getStyle('A1')->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);
        $activeSheet->setCellValue('A1', $tryout->tryout_judul);

        $activeSheet->mergeCells('A2:H2');
        $activeSheet->getStyle('A2')->getFont()->setSize(14);  // Mengatur ukuran font
        $activeSheet->getStyle('A2')->getFont()->setBold(true);  // Mengatur bold
        $activeSheet->getStyle('A2')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
        $activeSheet->getStyle('A2')->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);
        $activeSheet->setCellValue('A2', $tryout->tryout_jenjang . ' Kelas ' . $tryout->tryout_kelas);

        $activeSheet->getStyle('A3')->getFont()->setSize(14);  // Mengatur ukuran font
        $activeSheet->getStyle('A3')->getFont()->setBold(true);  // Mengatur bold
        $activeSheet->setCellValue('A3', 'Materi');
        $activeSheet->getStyle('B3')->getFont()->setSize(14);  // Mengatur ukuran font
        $activeSheet->getStyle('B3')->getFont()->setBold(true);  // Mengatur bold
        $activeSheet->setCellValue('B3', 'Pengajar');
        $activeSheet->getStyle('C3')->getFont()->setSize(14);  // Mengatur ukuran font
        $activeSheet->getStyle('C3')->getFont()->setBold(true);  // Mengatur bold
        $activeSheet->setCellValue('C3', 'Periode');
        $activeSheet->getStyle('D3')->getFont()->setSize(14);  // Mengatur ukuran font
        $activeSheet->getStyle('D3')->getFont()->setBold(true);  // Mengatur bold
        $activeSheet->setCellValue('D3', 'Waktu Pengerjaan');
        $activeSheet->getStyle('E3')->getFont()->setSize(14);  // Mengatur ukuran font
        $activeSheet->getStyle('E3')->getFont()->setBold(true);  // Mengatur bold
        $activeSheet->setCellValue('E3', 'Durasi Pegerjaan');

        $rowMateri = 4;
        foreach ($tryout->materi as $materi) {
            $activeSheet->setCellValue('A' . $rowMateri, $materi->refMateri->ref_materi_judul);
            $activeSheet->setCellValue('B' . $rowMateri, $materi->pengajar->name ?? '');
            $activeSheet->setCellValue('C' . $rowMateri, $materi->periode);
            if ($materi->periode_mulai && $tryout) {
                $activeSheet->setCellValue('D' . $rowMateri, $materi->waktu);
            }
            if ($materi->durasi) {
                $activeSheet->setCellValue('E' . $rowMateri, ($materi->durasi / 60) . ' Menit');
            }
            $rowMateri++;
        }
        $activeSheet->getStyle('A3:E' . ($rowMateri - 1))->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN);
        $activeSheet->getStyle('A3:E' . ($rowMateri - 1))->getBorders()->getAllBorders()->setColor(new \PhpOffice\PhpSpreadsheet\Style\Color('FF000000')); // Warna hitam


        $rowPesertaTitle  = $rowMateri + 1;

        $activeSheet->getStyle('A' . $rowPesertaTitle)->getFont()->setSize(14);  // Mengatur ukuran font
        $activeSheet->getStyle('A' . $rowPesertaTitle)->getFont()->setBold(true);  // Mengatur bold
        $activeSheet->setCellValue('A' . $rowPesertaTitle, 'Nama');

        $activeSheet->getStyle('B' . $rowPesertaTitle)->getFont()->setSize(14);  // Mengatur ukuran font
        $activeSheet->getStyle('B' . $rowPesertaTitle)->getFont()->setBold(true);  // Mengatur bold
        $activeSheet->setCellValue('B' . $rowPesertaTitle, 'Jenjang');

        $activeSheet->getStyle('C' . $rowPesertaTitle)->getFont()->setSize(14);  // Mengatur ukuran font
        $activeSheet->getStyle('C' . $rowPesertaTitle)->getFont()->setBold(true);  // Mengatur bold
        $activeSheet->setCellValue('C' . $rowPesertaTitle, 'Kelas');

        $activeSheet->getStyle('D' . $rowPesertaTitle)->getFont()->setSize(14);  // Mengatur ukuran font
        $activeSheet->getStyle('D' . $rowPesertaTitle)->getFont()->setBold(true);  // Mengatur bold
        $activeSheet->setCellValue('D' . $rowPesertaTitle, 'Asal Sekolah');

        $activeSheet->getStyle('E' . $rowPesertaTitle)->getFont()->setSize(14);  // Mengatur ukuran font
        $activeSheet->getStyle('E' . $rowPesertaTitle)->getFont()->setBold(true);  // Mengatur bold
        $activeSheet->setCellValue('E' . $rowPesertaTitle, 'Telepon');

        $activeSheet->getStyle('F' . $rowPesertaTitle)->getFont()->setSize(14);  // Mengatur ukuran font
        $activeSheet->getStyle('F' . $rowPesertaTitle)->getFont()->setBold(true);  // Mengatur bold
        $activeSheet->setCellValue('F' . $rowPesertaTitle, 'Alamat');

        $activeSheet->getStyle('G' . $rowPesertaTitle)->getFont()->setSize(14);  // Mengatur ukuran font
        $activeSheet->getStyle('G' . $rowPesertaTitle)->getFont()->setBold(true);  // Mengatur bold
        $activeSheet->setCellValue('G' . $rowPesertaTitle, 'Nama Orangtua');

        $activeSheet->getStyle('H' . $rowPesertaTitle)->getFont()->setSize(14);  // Mengatur ukuran font
        $activeSheet->getStyle('H' . $rowPesertaTitle)->getFont()->setBold(true);  // Mengatur bold
        $activeSheet->setCellValue('H' . $rowPesertaTitle, 'Telepon Orangtua');


        $rowPeserta = $rowPesertaTitle + 1;
        foreach ($tryout->peserta as $peserta) {
            $activeSheet->setCellValue('A' . $rowPeserta, $peserta->siswa->nama);
            $activeSheet->setCellValue('B' . $rowPeserta, $peserta->siswa->jenjang);
            $activeSheet->setCellValue('C' . $rowPeserta, $peserta->siswa->kelas);
            $activeSheet->setCellValue('D' . $rowPeserta, $peserta->siswa->asal_sekolah);
            $activeSheet->setCellValue('E' . $rowPeserta, $peserta->siswa->telepon);
            $activeSheet->setCellValue('F' . $rowPeserta, $peserta->siswa->alamat);
            $activeSheet->setCellValue('G' . $rowPeserta, $peserta->siswa->nama_orang_tua);
            $activeSheet->setCellValue('H' . $rowPeserta, $peserta->siswa->telp_orang_tua);
            $rowPeserta++;
        }
        $writer = new Xlsx($spreadsheet);

        $activeSheet->getStyle('A' . $rowPesertaTitle . ':H' . ($rowPeserta - 1))->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN);
        $activeSheet->getStyle('A' . $rowPesertaTitle . ':H' . ($rowPeserta - 1))->getBorders()->getAllBorders()->setColor(new \PhpOffice\PhpSpreadsheet\Style\Color('FF000000')); // Warna hitam


        $dirPath = 'app/public/exports/';
        $filePath = storage_path($dirPath . 'Data Peserta tryout ' . $tryout->tryout_judul . '.xlsx');
        if (!file_exists(storage_path($dirPath))) {
            Storage::disk('public')->makeDirectory('exports');
        }
        $writer->save($filePath);

        return response()->download($filePath)->deleteFileAfterSend(true);
    }

    public function deletePeserta($id)
    {
        TryoutPeserta::where('tryout_peserta_id', $id)->delete();

        return redirect()->back()
            ->withSuccess(('Peserta Berhasil dihapus.'));
    }
}
