<?php

namespace App\Http\Controllers\Panel\Referensi;

use App\Http\Controllers\Controller;
use App\Models\Materi;
use Illuminate\Http\Request;

class MateriController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $load['materi'] = Materi::when($request->keyword, function ($query) use ($request) {
            return $query->where('ref_materi_judul', 'like', "%{$request->keyword}%");
        })
            ->when($request->jenjang, function ($query) use ($request) {
                return $query->where('ref_materi_jenjang', $request->jenjang);
            })
            ->when($request->kelas, function ($query) use ($request) {
                return $query->where('ref_materi_kelas', $request->kelas);
            })->paginate(10);


        $load['keyword'] = $request->keyword;
        $load['filter_jenjang'] = $request->jenjang;
        $load['filter_kelas'] = $request->kelas;

        return view('pages.panel.ref_materi.index', ($load));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
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
            'ref_materi_judul' => 'required|string|max:255',
            'ref_materi_jenjang' => 'required|string|in:SD,SMP,SMA',
            'ref_materi_kelas' => 'required|integer|min:1|max:12',
        ]);

        $user = Materi::create([
            'ref_materi_judul' => $request->ref_materi_judul,
            'ref_materi_jenjang' => $request->ref_materi_jenjang,
            'ref_materi_kelas' => $request->ref_materi_kelas,
        ]);

        return redirect()->route('panel.materi.index')
            ->withSuccess(('Materi berhasil ditambahkan.'));
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
        $request->validate([
            'ref_materi_judul' => 'required|string|max:255',
            'ref_materi_jenjang' => 'required|string|in:SD,SMP,SMA',
            'ref_materi_kelas' => 'required|integer|min:1|max:12',
        ]);

        $user = Materi::where('ref_materi_id', $id)->update([
            'ref_materi_judul' => $request->ref_materi_judul,
            'ref_materi_jenjang' => $request->ref_materi_jenjang,
            'ref_materi_kelas' => $request->ref_materi_kelas,
        ]);

        return redirect()->back()
            ->withSuccess(('Materi beerhasil diupdate.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Materi::where('ref_materi_id', $id)->delete();

        return redirect()->route('panel.materi.index')
            ->withSuccess(('Materi Berhasil dihapus.'));
    }
}
