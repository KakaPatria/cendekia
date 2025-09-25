<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User; // Pastikan ini mengarah ke lokasi model User yang benar
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class LoginGoogleController extends Controller
{
    /**
     * Redirect the user to the Google authentication page.
     *
     * @return \Illuminate\Http\Response
     */
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Obtain the user information from Google.
     *
     * @return \Illuminate\Http\Response
     */
    public function handleGoogleCallback()
    {
        try {
            // Dapatkan data user dari Google
            $googleUser = Socialite::driver('google')->user();

            // Cari user di database berdasarkan email dari Google
            $user = User::where('email', $googleUser->getEmail())->first();

            // Cek apakah user sudah terdaftar di database
            if ($user) {
                // Jika user sudah ada, lakukan login dan arahkan ke dashboard
                Auth::login($user);
                return redirect()->intended('/panel/dashboard');
            } else {
                // Jika user belum terdaftar, arahkan ke halaman pendaftaran
                // dan kirim data nama & email sebagai data sesi sementara
                return redirect()->route('register')->with([
                    'name' => $googleUser->getName(),
                    'email' => $googleUser->getEmail(),
                ]);
            }
        } catch (\Exception $e) {
            // Tangani error jika ada masalah saat login Google
            return redirect('/login')->with('error', 'Login dengan Google gagal. Silakan coba lagi.');
        }
    }
}
