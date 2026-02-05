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
        $tryout = TryoutPeserta::with('masterTryout')
            ->where('user_id', $user->id)
            ->whereIn('tryout_peserta_status',[0,1])
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

    // ambil tryout sesuai jenjang dan kelas user
    $query = Tryout::where('tryout_status', 'Aktif')
        ->whereHas('materi')
        ->where('tryout_jenjang', $user->jenjang)
        ->where('tryout_kelas', $user->kelas);

    // Filter berdasarkan tipe siswa
    if ($user->tipe_siswa === 'Cendekia') {
        // Siswa Cendekia bisa lihat tryout Cendekia DAN Umum
        $query->whereIn('is_open', ['Cendekia', 'Umum']);
    } else {
        // Siswa Umum HANYA bisa lihat tryout Umum
        $query->where('is_open', 'Umum');
    }

    $dataTryout = $query->orderBy('updated_at', 'desc')
        ->get()
        ->filter(function ($tryout) {
            return $tryout->is_can_register;
        });

    $load['title'] = "Rekomendasi Tryout untuk Jenjang " . $user->jenjang;
    $load['data_tryout'] = $dataTryout;

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
        $tryout = Tryout::where('tryout_id', $id)->first();

        // Validasi tryout exists
        if (!$tryout) {
            return redirect()->route('siswa.tryout.library')
                ->with('error', 'Tryout tidak ditemukan.');
        }

        // Validasi akses berdasarkan tipe siswa
        if ($tryout->is_open === 'Cendekia' && $user->tipe_siswa !== 'Cendekia') {
            return redirect()->route('siswa.tryout.library')
                ->with('error', 'Tryout ini khusus untuk siswa Cendekia.');
        }

        // Cek pendaftaran aktif (status 0 = pending, 1 = terdaftar)
        // Status 2 (batal) tidak dianggap sebagai sudah terdaftar
        $registered = TryoutPeserta::where('user_id', $user->id)
            ->where('tryout_id', $id)
            ->whereIn('tryout_peserta_status', [0, 1])
            ->first();
        if ($registered) {
            return redirect()->route('siswa.tryout.show', $id)->withSuccess(__('Anda sudah terdaftar di tryout ini.'));
        }

        $load['tryout'] = $tryout;
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
        $user = auth()->user();
        $tryout = Tryout::where('tryout_id', $id)->first();

        // Jika tryout sudah dihapus/tidak ditemukan, jangan 500.
        if (!$tryout) {
            return redirect()->route('siswa.dashboard')
                ->with('error', 'Tryout tidak ditemukan atau sudah dihapus.');
        }

        // Validasi akses berdasarkan tipe siswa
        if ($tryout->is_open === 'Cendekia' && $user->tipe_siswa !== 'Cendekia') {
            return redirect()->route('siswa.tryout.library')
                ->with('error', 'Tryout ini khusus untuk siswa Cendekia.');
        }

        $tryout->load('materi.refMateri');

        if ($tryout->tryout_status != 'Aktif') {
            return redirect(route('siswa.tryout.library'))->with('error', "Tryout tidak dapat diakses");
        }

        $load['tryout'] = $tryout;
        // Cek apakah user sudah terdaftar di tryout ini (hanya status aktif)
        $load['tryout_peserta'] = TryoutPeserta::where('user_id', $user->id)
            ->where('tryout_id', $tryout->tryout_id)
            ->whereIn('tryout_peserta_status', [0, 1])
            ->first();

        // Simpan ke session sebagai recent accesses (tanpa menambah kolom DB)
        try {
            $recent = session()->get('recent_tryouts', []);
            // Pastikan uniq dan terbaru di depan
            $recent = array_values(array_filter($recent));
            // Hapus jika sudah ada
            if (($key = array_search($id, $recent)) !== false) {
                unset($recent[$key]);
            }
            array_unshift($recent, $id);
            // Batasi ke 5
            $recent = array_slice($recent, 0, 5);
            session()->put('recent_tryouts', $recent);
        } catch (\Exception $e) {
            // kalau session bermasalah, lanjutkan tanpa menghentikan akses
        }

        return view('pages.siswa.tryout.detail', $load);
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

        $tryoutPeserta = TryoutPeserta::with('masterTryout')
            ->where('user_id', $user->id)
            ->where('tryout_peserta_id', $id)
            ->first();

        if (!$tryoutPeserta) {
            return redirect()->route('siswa.tryout.index')
                ->with('error', 'Data pendaftaran tryout tidak ditemukan.');
        }

        $tryout = Tryout::where('tryout_id', $tryoutPeserta->tryout_id)->first();

        if (!$tryout) {
            return redirect()->route('siswa.tryout.index')
                ->with('error', 'Tryout tidak ditemukan atau sudah dihapus.');
        }


        $tryout = $tryout->load('materi.refMateri');
        //dd($tryout->getAverageNilai());
        $load['tryout'] = $tryout;
        // Hanya ambil pendaftaran aktif (status 0 = pending, 1 = terdaftar)
        $load['tryout_peserta'] = TryoutPeserta::where('user_id', $user->id)
            ->where('tryout_id', $tryout->tryout_id)
            ->whereIn('tryout_peserta_status', [0, 1])
            ->first();
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
