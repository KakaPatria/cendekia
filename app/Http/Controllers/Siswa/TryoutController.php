<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Models\Tryout;
use App\Models\TryoutPeserta;

use Illuminate\Http\Request;

class TryoutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = auth()->user();
        $tryout = Tryout::whereHas('peserta', function ($q) use ($user) {
            return $q->where('user_id', $user->id);
        })
            ->paginate(10);
        $load['tryout'] = $tryout;
        //dd($load);
        return view('pages.siswa.tryout.index', $load);
    }

    /**
     * Daftar untuk tryout.
     *
     * @return \Illuminate\Http\Response
     */
    public function daftar($id)
    {
        $user = auth()->user();
        $registered = TryoutPeserta::where('user_id', $user->id)
            ->where('tryout_id', $id)
            ->first();
        if ($registered) {
            return redirect()->route('siswa.tryout.show', $id)->withSuccess(__('Anda sudah terdaftar di tryout ini.'));
        }

        $load['tryout'] = Tryout::where('tryout_id', $id)->first();
        $load['user'] = $user;
        //dd($load);
        return view('pages.siswa.tryout.daftar', $load);
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
        $tryout = Tryout::where('tryout_id', $id)->first()->load('materi.refMateri');
        $load['tryout'] = $tryout;
        //dd($tryout->getAverageNilai());

        return view('pages.siswa.tryout.show', $load);
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
        //
    }
}
