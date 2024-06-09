<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Models\Tryout;
use App\Models\TryoutJawaban;
use App\Models\TryoutMateri;
use App\Models\TryoutSoal;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
            'soal_jenis' => 'required',
            'tyout_materi_id' => 'required',
            'periode_mulai' => 'required',
            'periode_selesai' => 'required',
            'safe_mode' => 'required|integer',
        ]);

        $tryoutMateri = TryoutMateri::find($request->tyout_materi_id);
        $tryoutMateri->jenis_soal = $request->soal_jenis;
        $tryoutMateri->periode_mulai = $request->periode_mulai;
        $tryoutMateri->periode_selesai = $request->periode_selesai;
        $tryoutMateri->safe_mode = $request->safe_mode;
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

                TryoutSoal::insert($postSoal);
                //dd($result);
            }
        }
        //dd($request->all());
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
        $tryoutSaol->tryout_kunci_jawaban = $request->opsi_jawaban;
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

        $tryoutMateri = TryoutMateri::find($id);

        $susunJawaban = [];
        $urutan = 1;
        foreach ($request->jawaban as $key => $value) {
            foreach ($value as $prefix => $jawaban) {
                $susunJawaban[] = [
                    'tryout_materi_id' => $id,
                    'tryout_soal_id' => $key,
                    'tryout_jawaban_prefix' => $prefix,
                    'tryout_jawaban_urutan' => $urutan,
                    'tryout_jawaban_isi' => $jawaban,
                ];
                $urutan++;
            }
            $urutan = 1;
        }
        foreach ($request->opsi_jawaban as $key => $value) {
            $tryoutSaol = TryoutSoal::find($key);
            $tryoutSaol->tryout_kunci_jawaban = $value;
            $tryoutSaol->update();
        }
        //dd($request->all());
       
        TryoutJawaban::insert($susunJawaban);

        return redirect()->route('panel.tryout_materi.show', $id);
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
