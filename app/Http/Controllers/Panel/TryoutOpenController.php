<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tryout;
use App\Models\TryoutOpenPendaftaran;


class TryoutOpenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $pendaftar = TryoutOpenPendaftaran::when($request->keyword, function ($query) use ($request) {
            return $query->where('top_email', 'like', "%{$request->keyword}%")
                ->orWhere('top_nama_siswa', 'like', "%{$request->keyword}%");
        })
            ->when($request->tryout, function ($query) use ($request) {
                return $query->where('tryout_id', $request->tryout);
            });


        $pendaftar = $pendaftar->orderByRaw("CASE WHEN top_status = 'Pending' THEN 1 ELSE 2 END");
        $load['pendaftar'] = $pendaftar->paginate(10);

        $load['keyword'] = $request->keyword;
        $load['list_tryout'] =    Tryout::where('tryout_status', 'Aktif')
            ->where('is_open', 'Ya')->get();

        $load['filter_tryout'] = $request->jenjang;


        return view('pages.panel.tryout_open.index', ($load));
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
        $load['pendaftaran'] = TryoutOpenPendaftaran::find($id);

        return view('pages.panel.tryout_open.show', ($load));
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

        $pendaftaran = TryoutOpenPendaftaran::find($id);
        $pendaftaran->top_status = 'Terverifikasi';
        $pendaftaran->update();
        //dd($pendaftaran);

        return redirect()->route('panel.tryout_open.index')
            ->withSuccess(('Pendaftaran tryout berhsil di verfikasi.'));
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
}
