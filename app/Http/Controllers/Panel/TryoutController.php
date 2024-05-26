<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Models\Tryout;
use App\Models\TryoutMateri;
use Illuminate\Support\Str;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TryoutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $load['tryout'] = Tryout::when($request->keyword, function ($query) use ($request) {
            return $query->where('tryout_judul', 'like', "%{$request->keyword}%")
                ->where('tryout_deskripsi', 'like', "%{$request->keyword}%");
        })
            ->when($request->jenjang, function ($query) use ($request) {
                return $query->where('tryout_jenjang', $request->jenjang);
            })
            ->when($request->kelas, function ($query) use ($request) {
                return $query->where('tryout_kelas', $request->kelas);
            })->paginate(10);


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

        //dd($request->all());
        $request->validate([
            'tryout_judul' => 'required|string|max:255',
            'tryout_jenjang' => 'required|string|in:SD,SMP,SMA',
            'tryout_kelas' => 'required|integer|min:1|max:12',
            'tryout_register_due' => 'required|date',
            'tryout_status' => 'required',
            'tryout_jenis' => 'required',
            'tryout_nominal' => 'required',
        ]);

        $tryout = new Tryout();
        $tryout->tryout_judul = $request->tryout_judul;
        $tryout->tryout_deskripsi = $request->tryout_deskripsi ?? '';
        $tryout->tryout_jenjang = $request->tryout_jenjang;
        $tryout->tryout_kelas = $request->tryout_kelas;
        $tryout->tryout_register_due = $request->tryout_register_due;
        $tryout->tryout_status = $request->tryout_status;
        $tryout->tryout_jenis = $request->tryout_jenis;
        $tryout->tryout_nominal = $request->tryout_nominal;
        $tryout->save();

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


        $postMateri = [];
        foreach ($request->materi_data['materi_data'] as $key => $value) {
            if ($value['materi_id']) {
                $postMateri[] = [
                    'tryout_materi_id' => Str::random(10),
                    'tryout_id' => $tryout->tryout_id,
                    'materi_id' => $value['materi_id'],
                    'pengajar_id' => $value['pengajar_id'],
                    'tryout_materi_deskripsi' => $value['tryout_materi_deskripsi']
                ];
            }
        }

        TryoutMateri::insert($postMateri);

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
        Tryout::where('tryout_id', $id)->delete();

        return redirect()->route('panel.tryout.index')
            ->withSuccess(('Tryout Berhasil dihapus.'));
    }
}
