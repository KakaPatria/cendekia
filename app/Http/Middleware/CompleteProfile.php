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

        // LOGIKA BARU YANG LEBIH KETAT
        // Kita anggap profil lengkap jika 'alamat' DAN 'asal_sekolah' sudah diisi.
        // Anda bisa menambahkan field lain jika perlu.
        $isProfileComplete = $user->profilSiswa && 
                             $user->profilSiswa->alamat && 
                             $user->profilSiswa->asal_sekolah;

        // Jika user ADA, TAPI profilnya TIDAK LENGKAP
        if ($user && !$isProfileComplete) {
            // Arahkan ke halaman untuk melengkapi profil.
            return redirect()->route('siswa.profile.complete');
        }
        
        // Jika profil sudah lengkap, izinkan user untuk melanjutkan ke halaman berikutnya (dashboard).
        return $next($request);
    }
}