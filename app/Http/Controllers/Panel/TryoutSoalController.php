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
        $tryoutSoal = TryoutSoal::find($id);

        if ($request->hasFile('soal')) {
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



                $result = $this->convertPdfToImage(($fileName));

                foreach ($result as $key => $value) {
                    $tryoutSoal->tryout_soal = $value['soal'];
                    $tryoutSoal->tryout_penyelesaian = $value['jawaban'];
                }
            }
        } else {
            $tryoutSoal->tryout_soal = $request->soal;
        }
         
        $tryoutSoal->tryout_kunci_jawaban = json_encode($request->opsi_jawaban);
        $tryoutSoal->point = $request->point ?? 1; 
        //dd($tryoutSoal);
        $tryoutSoal->update();

        $urutan = 1;
        foreach ($request->jawaban as $key => $value) {
            $tryouJawaban = TryoutJawaban::find($key);
            if ($tryouJawaban) {
                $tryouJawaban->tryout_jawaban_isi = $value;
                $tryouJawaban->update();
            }else{
                $susunJawaban = [
                    'tryout_materi_id' => $id,
                    'tryout_soal_id' => $key,
                    'tryout_jawaban_prefix' => $key,
                    'tryout_jawaban_urutan' => $urutan,
                    'tryout_jawaban_isi' => $value,
                ];
                $urutan++;
                TryoutJawaban::insert($susunJawaban);
            }
          
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
