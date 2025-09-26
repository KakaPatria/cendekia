<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CompleteProfile
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
   public function handle(Request $request, Closure $next)
    {
        // Ambil data user yang sedang login
        $user = $request->user();

        // LOGIKA BARU: Cek langsung ke tabel profil_siswa
        // Cek apakah user punya profil DAN apakah kolom alamat di profil itu sudah diisi.
        // Kita anggap jika alamat sudah ada, maka profilnya lengkap.
        if ($user && (!$user->profilSiswa || !$user->profilSiswa->alamat)) {

            // Jika profil tidak ada, atau alamatnya kosong,
            // arahkan ke halaman untuk melengkapi profil.
            return redirect()->route('siswa.profile.complete');
        }

        // Jika profil sudah lengkap, izinkan user untuk melanjutkan ke halaman berikutnya (dashboard).
        return $next($request);
    }
}