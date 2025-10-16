<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\TryoutNilai;
use App\Models\TryoutPeserta;

class SiswaController extends Controller
{
    // ✅ Halaman list semua siswa (kalau di luar dashboard)
    public function index(Request $request)
    {
        $query = User::where('roles_id', 1);
        $jenjang = $request->input('jenjang');
        if ($jenjang) {
            $query->whereRaw('LOWER(jenjang) = ?', [strtolower($jenjang)]);
        }
        $siswa = $query->paginate(10)->appends($request->except('page'));

        return view('pages.siswa.index', compact('siswa', 'jenjang'));
    }

    // ✅ DETAIL SISWA DI DASHBOARD ADMIN
    public function detail($id)
    {
        // ambil data user (siswa)
        $user = User::findOrFail($id);

        // ambil nilai tryout siswa (kalau ada)
        $nilaiTryout = TryoutNilai::where('user_id', $user->id)
            ->with(['masterTryout', 'tryoutMateri'])
            ->get();

        // ambil data tryout yang diikuti siswa
        $tryoutPeserta = TryoutPeserta::where('user_id', $user->id)
            ->with('tryout')
            ->get();

        // hitung rata-rata nilai (kalau ada kolom nilai)
        $rataRataNilai = $nilaiTryout->count() > 0
            ? round($nilaiTryout->avg('nilai'), 2)
            : 0;

        // kirim ke view
        return view('pages.panel.user.detail', compact(
            'user',
            'nilaiTryout',
            'tryoutPeserta',
            'rataRataNilai'
        ));
    }
}
