<?php

namespace App\Http\Controllers\Panel\Referensi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AsalSekolah;

class AsalSekolahController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $load['asal_sekolah'] = AsalSekolah::when($request->keyword, function ($query) use ($request) {
            return $query->where('nama_sekolah', 'like', "%{$request->keyword}%");
        })
            ->paginate(10);
 


        $load['keyword'] = $request->keyword; 

        return view('pages.panel.ref_asal_sekolah.index', ($load));
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
            'nama_sekolah' => 'required|string|max:255', 
        ]);

        $user = AsalSekolah::create([
            'nama_sekolah' => $request->nama_sekolah, 
        ]);

        return redirect()->route('panel.asal_sekolah.index')
            ->withSuccess(('Asal Sekolah berhasil ditambahkan.'));
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
            'nama_sekolah' => 'required|string|max:255', 
        ]);

        $user = AsalSekolah::where('nama_sekolah', $id)->update([
            'nama_sekolah' => $request->nama_sekolah, 
        ]);

        return redirect()->route('panel.asal_sekolah.index')
            ->withSuccess(('Asal Sekolah berhasil diupdate.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        AsalSekolah::where('nama_sekolah', $id)->delete();

        return redirect()->route('panel.asal_sekolah.index')
            ->withSuccess(('Asal Sekolah Berhasil dihapus.'));
    }
}
