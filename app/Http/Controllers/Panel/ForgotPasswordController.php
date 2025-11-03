<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Mail\ForgotPasswordOtpMail;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class ForgotPasswordController extends Controller
{
    public function forgotPassword()
    {
        return view('pages.panel.forgot');
    }

    public function doForgotPassword(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $user = User::where('email', $request->email)->first();
        if (!$user) {
            return redirect()->back()->with('error', 'Akun tidak ditemukan');
        }

        // Prevent siswa accounts from using panel reset
        if ($user->hasRole('Siswa')) {
            return redirect()->back()->with('error', 'Akun siswa tidak dapat direset melalui panel.');
        }

        $otp = mt_rand(100000, 999999);
        $expiresAt = Carbon::now()->addMinutes(10);

        $user->password_otp = (string) $otp;
        $user->password_otp_expires_at = $expiresAt;
        $user->save();

        try {
            Mail::to($user->email)->send(new ForgotPasswordOtpMail($otp, $user));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal mengirim email. Periksa konfigurasi SMTP: ' . $e->getMessage());
        }

        return view('pages.panel.enter_otp', ['email' => $user->email]);
    }

    public function enterOtp(Request $request)
    {
        $email = $request->email ?? null;
        return view('pages.panel.enter_otp', compact('email'));
    }

    public function verifyOtp(Request $request)
    {
        $request->validate(['email' => 'required|email', 'otp' => 'required|digits:6']);

        $user = User::where('email', $request->email)->first();
        if (!$user) return redirect()->back()->with('error', 'Akun tidak ditemukan');

        if (!$user->password_otp || !$user->password_otp_expires_at) {
            return redirect()->back()->with('error', 'OTP tidak ditemukan, silakan minta ulang.');
        }

        if (Carbon::now()->greaterThan(Carbon::parse($user->password_otp_expires_at))) {
            return redirect()->back()->with('error', 'OTP telah kadaluarsa, silakan minta ulang.');
        }

        if ($user->password_otp !== $request->otp) {
            return redirect()->back()->with('error', 'Kode OTP salah.');
        }

        // valid — create one-time token
        $token = Str::random(60);
        $user->remember_token = $token;
        $user->password_otp = null;
        $user->password_otp_expires_at = null;
        $user->save();

        return redirect()->route('panel.password.reset', ['token' => $token, 'email' => $user->email]);
    }

    public function passwordReset(Request $request)
    {
        $token = $request->query('token') ?? $request->token;
        $email = $request->query('email') ?? $request->email;

        return view('pages.panel.reset')->with(['token' => $token, 'email' => $email]);
    }

    public function doPasswordReset(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::where('email', $request->email)->first();
        if (!$user || $user->remember_token !== $request->token) {
            return redirect()->route('panel.password.reset')->with('error', 'Invalid reset password, mohon ulangi.');
        }

        $user->password = Hash::make($request->password);
        $user->setRememberToken(Str::random(60));
        $user->save();

        return redirect()->route('panel.login')->with('success', 'Password anda sudah direset, silahkan login.');
    }
}
