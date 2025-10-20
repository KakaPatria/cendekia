<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TryoutSoal;
use App\Models\TryoutJawaban;
use Illuminate\Support\Facades\Storage;

class TryoutSoalController extends Controller
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $soal = TryoutSoal::find($id);

        $load['soal'] = $soal;
        $load['tryout_materi'] = $soal->materi;
        return view('pages.panel.tryout_materi.editSoal', ($load));
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
        $tryoutSoal = TryoutSoal::findOrFail($id);

        // Validasi dasar
        $request->validate([
            'soal' => 'required|string',
            'jenis_soal' => 'required|in:SC,MC,MCMA',
            'point' => 'nullable|numeric|min:0',
            'jawaban' => 'required|array|min:1',
        ]);

        // Jika ada upload file (opsional)
        if ($request->hasFile('soal')) {
            $request->validate([
                'soal' => 'required|mimes:pdf|max:10000',
            ]);

            $file = $request->file('soal');
            $directory = 'public/uploads/soal';
            if (!Storage::exists($directory)) {
                Storage::makeDirectory($directory);
            }

            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->storeAs($directory, $fileName);
            $tryoutSoal->tryout_soal = $directory . '/' . $fileName;
        } else {
            $tryoutSoal->tryout_soal = $request->soal;
        }

        // Simpan jenis soal
        $tryoutSoal->tryout_soal_type = $request->jenis_soal;
        $tryoutSoal->point = $request->point ?? 1;

        // Simpan kunci jawaban tergantung jenis soal
        if ($request->jenis_soal === 'MCMA') {
            // format notes seperti: ['A'=>'Benar', 'B'=>'Salah', ...]
            $tryoutSoal->tryout_kunci_jawaban = json_encode($request->opsi_jawaban_mcma ?? []);
            $tryoutSoal->notes = $request->notes;
            
        } else {
            // SC & MC → array pilihan benar, contoh: ['B'] atau ['A', 'C']
            $tryoutSoal->tryout_kunci_jawaban = json_encode($request->opsi_jawaban ?? []);
        }

        $tryoutSoal->save();

        // Update daftar jawaban
        $urutan = 1;
        foreach ($request->jawaban as $prefix => $isi) {
            $jawaban = TryoutJawaban::where('tryout_soal_id', $tryoutSoal->tryout_soal_id)
                ->where('tryout_jawaban_prefix', $prefix)
                ->first();

            if ($jawaban) {
                $jawaban->tryout_jawaban_isi = $isi;
                $jawaban->tryout_jawaban_urutan = $urutan;
                $jawaban->update();
            } else {
                TryoutJawaban::create([
                    'tryout_materi_id' => $tryoutSoal->tryout_materi_id,
                    'tryout_soal_id' => $tryoutSoal->tryout_soal_id,
                    'tryout_jawaban_prefix' => $prefix,
                    'tryout_jawaban_urutan' => $urutan,
                    'tryout_jawaban_isi' => $isi,
                ]);
            }

            $urutan++;
        }

        return redirect()->route('panel.tryout_materi.show', $tryoutSoal->tryout_materi_id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function convertPdfToImage($pdfFilePath)
    {
        $outputImagePath = 'public/uploads/soal/image';
        if (!Storage::exists($outputImagePath)) {
            Storage::makeDirectory($outputImagePath);
        }

        $pdf = new \Spatie\PdfToImage\Pdf(public_path('storage/uploads/soal/' . $pdfFilePath));

        $pageNumber =  $pdf->getNumberOfPages(); //returns an int

        $susunSoal = [];
        $susunJawaban = [];
        for ($i = 1; $i <= $pageNumber; $i++) {

            if ($i % 2 == 0) {
                $fileName = 'jawaban_' . $i . '_' . time() . '.jpg';
                $pdf->setPage($i)
                    ->saveImage(public_path('storage/uploads/soal/image/' . $fileName));
                $susunJawaban[] =  'public/uploads/soal/image/' . $fileName;
            } else {
                $fileName = 'soal_' . $i . '_' . time() . '.jpg';
                $pdf->setPage($i)
                    ->saveImage(public_path('storage/uploads/soal/image/' . $fileName));
                $susunSoal[] = 'public/uploads/soal/image/' . $fileName;
            }
        }
        $susunData = [];
        foreach ($susunSoal as $key => $value) {
            $susunData[$key]['soal'] = $value;
            $susunData[$key]['jawaban'] = isset($susunJawaban[$key]) ? $susunJawaban[$key] : '';
        }

        return $susunData;
    }
}
