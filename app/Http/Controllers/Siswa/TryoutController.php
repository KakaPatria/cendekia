<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Models\Tryout;
use App\Models\TryoutPeserta;
use Illuminate\Support\Facades\DB;
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function library(Request $request)
    {
        $user = auth()->user();

        $tryoutRekomendasi = Tryout::orderBy(DB::raw("CASE WHEN tryout_kelas = '" . $user->kelas . "' THEN 0 WHEN tryout_jenjang = '" . $user->jenjang . "' THEN 1 ELSE 2 END "))
            ->limit(3)
            ->get();
        $load['tryout_rekomendasi'] = $tryoutRekomendasi;

        $tryoutAll = Tryout::where('tryout_status', 'Aktif')
        ->get()
             ->groupBy('tryout_jenjang');

        $load['tryout_all'] = $tryoutAll;

        if ($request->jenjang == 'SD') {
            $tryoutSD = Tryout::where('tryout_status', 'Aktif')
                ->when($request->kelas, function ($q, $kelas) {
                    return $q->whereIn('tryout_kelas', $kelas);
                })->paginate(5);
            $load['tryout_sd'] = $tryoutSD;
        }
        if ($request->jenjang == 'SMP') {
            $tryoutSD = Tryout::where('tryout_status', 'Aktif')
                ->when($request->kelas, function ($q, $kelas) {
                    return $q->whereIn('tryout_kelas', $kelas);
                })->paginate(5);
            $load['tryout_smp'] = $tryoutSD;
        }
        if ($request->jenjang == 'SMA') {
            $tryoutSD = Tryout::where('tryout_status', 'Aktif')
                ->when($request->kelas, function ($q, $kelas) {
                    return $q->whereIn('tryout_kelas', $kelas);
                })->paginate(5);
            $load['tryout_sma'] = $tryoutSD;
        }

        return view('pages.siswa.tryout.library', $load);
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
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function detail($id)
    {
        $user = auth()->user();
        $tryout = Tryout::whereHas('peserta', function ($q) use ($user) {
            return $q->where('user_id', $user->id);
        })
            ->where('tryout_id', $id)->first();
        if (!$tryout) {
            return redirect()->back()
                ->withErrors(('Anda tidak memiliki akses di tryout ini'));
        }
        $tryout = $tryout->load('materi.refMateri');
        //dd($tryout->getAverageNilai());
        $load['tryout'] = $tryout;
        $load['tryout_peserta'] = TryoutPeserta::where('user_id', $user->id)
            ->where('tryout_id', $tryout->tryout_id)->first();
        //dd($load);

        return view('pages.siswa.tryout.detail', $load);
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
