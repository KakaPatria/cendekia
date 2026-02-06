<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Mail\WelcomeMail;
use App\Models\AsalSekolah;
use App\Models\User;
use App\Models\ReferalCode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Laravel\Socialite\Facades\Socialite;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\URL;
use App\Mail\ForgotPasswordOtpMail;
use Carbon\Carbon;

class UserController extends Controller
{

    public function login()
    {
        if (Auth::check()) {
            // Check if user is NOT Siswa (roles_id != 1)
            if (Auth::user()->roles_id != 1) {
                Auth::logout();
                return redirect(route('login'))->with('error', 'Anda tidak memiliki akses.');
            }
            return redirect()->route('siswa.dashboard')->with('info', 'Anda sudah logged in.');
        }

        return view('pages.siswa.login');
    }

    public function doLogin(Request $request)
    {
        // Dekripsi data dari encrypted_data
        $decrypted = $this->decryptData($request->encrypted_data);
        
        if (!$decrypted) {
            return redirect()->back()->with('error', 'Data tidak valid. Silakan coba lagi.')->withInput();
        }
        
        // Validasi timestamp (maksimal 5 menit)
        if (isset($decrypted['timestamp'])) {
            $timestampDiff = time() - ($decrypted['timestamp'] / 1000);
            if ($timestampDiff > 300) { // 5 menit
                return redirect()->back()->with('error', 'Sesi login telah kadaluarsa. Silakan coba lagi.')->withInput();
            }
        }
        
        $email = $decrypted['email'] ?? null;
        $password = $decrypted['password'] ?? null;
        
        if (!$email || !$password) {
            return redirect()->back()->with('error', 'Email dan password harus diisi.')->withInput();
        }
        
        // Validasi format email dan password
        $messages = [
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
        
            'password.required' => 'Kata sandi wajib diisi.',
            'password.string' => 'Kata sandi harus berupa teks.',
            'password.min' => 'Kata sandi minimal harus 8 karakter.',
        ];
        
        $validator = Validator::make([
            'email' => $email,
            'password' => $password
        ], [
            'email' => 'required|email',
            'password' => 'required|string|min:8',
        ], $messages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput(['email' => $email]);
        }

        // Attempt to log the user in
        if (Auth::attempt(['email' => $email, 'password' => $password], $request->remember)) {
            // Check if the logged in user is a Siswa (roles_id == 1)
            if (Auth::user()->roles_id != 1) {
                Auth::logout();
                return redirect()->back()->with('error', 'Login gagal. Akses hanya untuk siswa.')->withInput(['email' => $email]);
            }
            
            // Authentication passed...
            return redirect()->intended(route('siswa.dashboard'))->with('success', 'Login berhasil!');
        }

        // If the login attempt was unsuccessful
        return redirect()->back()->with('error', 'Login gagal periksa kembali username dan password.')->withInput(['email' => $email]);
    }
    
    /**
     * Dekripsi data yang dienkripsi dari client-side
     */
    private function decryptData($encryptedData)
    {
        try {
            if (!$encryptedData) {
                return null;
            }
            
            // Hapus 6 karakter prefix dan suffix (random string)
            $withoutPrefixSuffix = substr($encryptedData, 6, -6);
            
            // Reverse string
            $reversed = strrev($withoutPrefixSuffix);
            
            // Base64 decode
            $decoded = base64_decode($reversed);
            
            if (!$decoded) {
                return null;
            }
            
            // Parse JSON
            $data = json_decode($decoded, true);
            
            return $data;
        } catch (\Exception $e) {
            return null;
        }
    }

    public function logout()
    {
        // Hapus recent tryouts dari session agar dashboard bersih setelah logout
        try {
            session()->forget('recent_tryouts');
            // optional: invalidate the whole session to be safe
            session()->invalidate();
            session()->regenerateToken();
        } catch (\Exception $e) {
            // ignore session errors
        }
        Auth::logout();
        return redirect('/')->with('success', 'anda berhasil logout.');
    }



    public function forgotPassword()
    {

        return view('pages.siswa.forgot');
    }

    public function doForgotPassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|',
        ]);

        $user = User::where('email', $request->email)
            ->orWhere('telepon', $request->email)
            ->first();

        if (!$user) {
            return redirect()->back()->with('error', 'Akun tidak ditemukan');
        }

        // Generate numeric 6-digit OTP
        $otp = mt_rand(100000, 999999);
        $expiresAt = Carbon::now()->addMinutes(10);

        $user->password_otp = (string) $otp;
        $user->password_otp_expires_at = $expiresAt;
        $user->save();

        // Send OTP via email
        try {
            Mail::to($user->email)->send(new ForgotPasswordOtpMail($otp, $user));
        } catch (\Exception $e) {
            // Mail failed — return error with message for debugging
            return redirect()->back()->with('error', 'Gagal mengirim email. Periksa konfigurasi SMTP: ' . $e->getMessage());
        }

        // Redirect to OTP entry page
        return view('pages.siswa.enter_otp', ['email' => $user->email]);
    }

    public function enterOtp(Request $request)
    {
        $email = $request->email ?? null;
        return view('pages.siswa.enter_otp', compact('email'));
    }

    public function verifyOtp(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'otp' => 'required|digits:6',
        ]);

        $user = User::where('email', $request->email)->first();
        if (!$user) {
            return redirect()->back()->with('error', 'Akun tidak ditemukan');
        }

        if (!$user->password_otp || !$user->password_otp_expires_at) {
            return redirect()->back()->with('error', 'OTP tidak ditemukan, silakan minta ulang.');
        }

        if (Carbon::now()->greaterThan(Carbon::parse($user->password_otp_expires_at))) {
            return redirect()->back()->with('error', 'OTP telah kadaluarsa, silakan minta ulang.');
        }

        if ($user->password_otp !== $request->otp) {
            return redirect()->back()->with('error', 'Kode OTP salah.');
        }

        // OTP valid — generate a one-time token for the reset form and clear OTP
        $token = Str::random(60);
        $user->remember_token = $token;
        $user->password_otp = null;
        $user->password_otp_expires_at = null;
        $user->save();

        // Redirect to reset password form with token and email
        return redirect()->route('siswa.password.reset', ['token' => $token, 'email' => $user->email]);
    }

    public function passwordReset(Request $request, $token = null)
    {

        // Support token passed either as route parameter or as query parameter
        $token = $token ?? $request->query('token') ?? $request->token;
        $email = $request->query('email') ?? $request->email;

        return view('pages.siswa.reset')->with([
            'token' => $token,
            'email' => $email
        ]);
    }

    public function doPasswordReset(Request $request)
    {
        $messages = [
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'password.required' => 'Kata sandi wajib diisi.',
            'password.string' => 'Kata sandi harus berupa teks.',
            'password.min' => 'Kata sandi minimal harus 8 karakter.',
            'password.confirmed' => 'Konfirmasi kata sandi tidak cocok.',
        ];
        
        $validator = Validator::make($request->all(), [
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|string|min:8|confirmed',
        ],$messages);

        $user = User::where('email', $request->email)->first();

        if (!$user || $user->remember_token !== $request->token) {
            return redirect()->route('siswa.password.reset')->with('error', 'Invalid reset password, mohon ulangi.');
        }

        // Reset the user's password
        $user->password = Hash::make($request->password);
        $user->setRememberToken(Str::random(60));
        $user->save();

        return redirect()->route('login')->with('success', 'Password anda sudah direset, silahkan login.');
    }

    public function register()
    {

        return view('pages.siswa.register');
    }

    public function doRegister(Request $request)
    {

        $messages = [
            'name.required' => 'Nama wajib diisi.',
            'name.string' => 'Nama harus berupa teks.',
            'name.max' => 'Nama maksimal 255 karakter.',
            
            'email.required' => 'Email wajib diisi.',
            'email.string' => 'Email harus berupa teks.',
            'email.email' => 'Format email tidak valid.',
            'email.max' => 'Email maksimal 255 karakter.',
            'email.unique' => 'Email sudah terdaftar.',
        
            'telepon.required' => 'Nomor telepon wajib diisi.',
            'telepon.numeric' => 'Nomor telepon harus berupa angka.',
        
            'nama_orang_tua.required' => 'Nama orang tua wajib diisi.',
            'nama_orang_tua.string' => 'Nama orang tua harus berupa teks.',
        
            'telp_orang_tua.required' => 'Nomor telepon orang tua wajib diisi.',
            'telp_orang_tua.numeric' => 'Nomor telepon orang tua harus berupa angka.',
        
            'alamat.required' => 'Alamat wajib diisi.',
            'alamat.string' => 'Alamat harus berupa teks.',
            'alamat.max' => 'Alamat maksimal 255 karakter.',
        
            'asal_sekolah.required' => 'Asal sekolah wajib diisi.',
            'asal_sekolah.string' => 'Asal sekolah harus berupa teks.',
            'asal_sekolah.max' => 'Asal sekolah maksimal 255 karakter.',
        
            'jenjang.required' => 'Jenjang wajib diisi.',
            'jenjang.string' => 'Jenjang harus berupa teks.',
            'jenjang.in' => 'Jenjang harus salah satu dari SD, SMP, atau SMA.',
        
            'kelas.required' => 'Kelas wajib diisi.',
            'kelas.integer' => 'Kelas harus berupa angka.',
            'kelas.min' => 'Kelas minimal harus 1.',
            'kelas.max' => 'Kelas maksimal harus 12.',
        
            'password.required' => 'Kata sandi wajib diisi.',
            'password.string' => 'Kata sandi harus berupa teks.',
            'password.min' => 'Kata sandi minimal harus 8 karakter.',
            'password.confirmed' => 'Konfirmasi kata sandi tidak cocok.',
        ];
        //dd($request);
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'telepon' => 'required|numeric',
            'nama_orang_tua' => 'required|string',
            'telp_orang_tua' => 'required|numeric',
            'alamat' => 'required|string|max:255',
            'asal_sekolah' => 'required|string|max:255',
            'jenjang' => 'required|string|in:SD,SMP,SMA',
            'kelas' => 'required|integer|min:1|max:12',
            'password' => 'required|string|min:8|confirmed',
        ],$messages);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Normalize + ensure master asal_sekolah exists
        $asalSekolahValue = preg_replace('/\s+/', ' ', trim((string) $request->asal_sekolah));
        if ($asalSekolahValue !== '') {
            AsalSekolah::updateOrInsert(
                ['nama_sekolah' => $asalSekolahValue],
                ['nama_sekolah' => $asalSekolahValue],
            );
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'telepon' => $request->telepon,
            'alamat' => $request->alamat,
            'nama_orang_tua' => $request->nama_orang_tua,
            'telp_orang_tua' => $request->telp_orang_tua,
            'asal_sekolah' => $asalSekolahValue,
            'jenjang' => $request->jenjang,
            'kelas' => $request->kelas,
            'password' => Hash::make($request->password),
            'roles_id' => 1, // 👈 otomatis isi siswa
        ]);
 

        return redirect()->route('login')->with('success', 'Pendaftaran Berhasil Silahkan Login!');
    }

    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }


    public function handleGoogleCallback()
    {
    // Use session-based Socialite callback to preserve the state parameter
    // generated during redirect. Using stateless() here can cause
    // 'invalid_grant' when Google's returned state doesn't match.
    $googleUser = Socialite::driver('google')->user();
        $user = User::where('email', $googleUser->email)->first();
        if (!$user) {
            // Create new user with default siswa role (roles_id = 1)
            $user = User::create([
                'name' => $googleUser->name, 
                'email' => $googleUser->email, 
                'password' => Hash::make(rand(100000, 999999)),
                'roles_id' => 1 // Set as Siswa by default
            ]);
        }
        
        // Check if user is a Siswa (roles_id == 1)
        if ($user->roles_id != 1) {
            return redirect()->route('siswa.login')->with('error', 'Akun ini bukan akun siswa. Silakan login melalui panel admin.');
        }

        Auth::login($user);

        return redirect()->intended(route('siswa.dashboard'))->with('success', 'Login berhasil!');
    }



    public function profileComplete()
    {

        $user = Auth::user();
        return view('pages.siswa.profile.complete', compact('user'));
    }

    public function doProfileComplete(Request $request)
    {
        $messages = [
            'telepon.required' => 'Nomor telepon wajib diisi.',
            'telepon.numeric' => 'Nomor telepon harus berupa angka.',
        
            'asal_sekolah.required' => 'Asal sekolah wajib diisi.',
            'asal_sekolah.string' => 'Asal sekolah harus berupa teks.',
            'asal_sekolah.max' => 'Asal sekolah maksimal 255 karakter.',
        
            'alamat.required' => 'Alamat wajib diisi.',
            'alamat.string' => 'Alamat harus berupa teks.',
            'alamat.max' => 'Alamat maksimal 255 karakter.',
        
            'jenjang.required' => 'Jenjang wajib diisi.',
            'jenjang.string' => 'Jenjang harus berupa teks.',
            'jenjang.in' => 'Jenjang harus salah satu dari SD, SMP, atau SMA.',
        
            'kelas.required' => 'Kelas wajib diisi.',
            'kelas.integer' => 'Kelas harus berupa angka.',
            'kelas.min' => 'Kelas minimal harus 1.',
            'kelas.max' => 'Kelas maksimal harus 12.',
        
            'nama_orang_tua.required' => 'Nama orang tua wajib diisi.',
            'nama_orang_tua.string' => 'Nama orang tua harus berupa teks.',
        
            'telp_orang_tua.required' => 'Nomor telepon orang tua wajib diisi.',
            'telp_orang_tua.numeric' => 'Nomor telepon orang tua harus berupa angka.',
        ];

        
        $user = User::find(Auth::user()->id);
        $validator = Validator::make($request->all(), [
            'telepon' => 'required|numeric',
            'asal_sekolah' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'jenjang' => 'required|string|in:SD,SMP,SMA',
            'kelas' => 'required|integer|min:1|max:12',
            'nama_orang_tua' => 'required|string',
            'telp_orang_tua' => 'required|numeric',
        ],$messages);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Normalize + ensure master asal_sekolah exists
        $asalSekolahValue = preg_replace('/\s+/', ' ', trim((string) $request->asal_sekolah));
        if ($asalSekolahValue !== '') {
            AsalSekolah::updateOrInsert(
                ['nama_sekolah' => $asalSekolahValue],
                ['nama_sekolah' => $asalSekolahValue],
            );
        }

        $user = User::find($user->id)->update([
            'telepon' => $request->telepon,
            'alamat' => $request->alamat,
            'nama_orang_tua' => $request->nama_orang_tua,
            'telp_orang_tua' => $request->telp_orang_tua,
            'asal_sekolah' => $asalSekolahValue,
            'jenjang' => $request->jenjang,
            'kelas' => $request->kelas,
        ]);

        //Mail::to($user->email)->send(new WelcomeMail($user));

        return redirect()->route('siswa.dashboard')->with('success', 'Profile berhasil diupdate!');
    }



    public function profile()
    {

        return view('pages.siswa.profile.index');
    }

    public function edit()
    {

        $user = Auth::user();
        return view('pages.siswa.profile.edit', compact('user'));
    }

    public function update(Request $request)
    {

        $messages = [
            'name.required' => 'Nama wajib diisi.',
            'name.string' => 'Nama harus berupa teks.',
            'name.max' => 'Nama maksimal 255 karakter.',
            
            'email.required' => 'Email wajib diisi.',
            'email.unique' => 'Email sudah terdaftar, gunakan email yang berbeda.',
        
            'telepon.required' => 'Nomor telepon wajib diisi.',
            'telepon.numeric' => 'Nomor telepon harus berupa angka.',
        
            'asal_sekolah.required' => 'Asal sekolah wajib diisi.',
            'asal_sekolah.string' => 'Asal sekolah harus berupa teks.',
            'asal_sekolah.max' => 'Asal sekolah maksimal 255 karakter.',
        
            'alamat.required' => 'Alamat wajib diisi.',
            'alamat.string' => 'Alamat harus berupa teks.',
            'alamat.max' => 'Alamat maksimal 255 karakter.',
        
            'jenjang.required' => 'Jenjang wajib diisi.',
            'jenjang.string' => 'Jenjang harus berupa teks.',
            'jenjang.in' => 'Jenjang harus salah satu dari SD, SMP, atau SMA.',
        
            'kelas.required' => 'Kelas wajib diisi.',
            'kelas.integer' => 'Kelas harus berupa angka.',
            'kelas.min' => 'Kelas minimal harus 1.',
            'kelas.max' => 'Kelas maksimal harus 12.',
        
            'image.image' => 'File yang diunggah harus berupa gambar.',
            'image.mimes' => 'Gambar harus memiliki format jpeg, png, jpg, gif, atau svg.',
            'image.max' => 'Gambar maksimal 2MB.',
        ];
        
        $user = User::find(Auth::user()->id);
        $validator = Validator::make($request->all(), [

            'name' => 'required|string|max:255',
            'email' => 'required|unique:users,email,' . $user->id,
            'telepon' => 'required|numeric',
            'asal_sekolah' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'nama_orang_tua' => 'required|string',
            'telp_orang_tua' => 'required|numeric',
            'jenjang' => 'required|string|in:SD,SMP,SMA',
            'kelas' => 'required|integer|min:1|max:12',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ],$messages);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Normalize + ensure master asal_sekolah exists
        $asalSekolahValue = preg_replace('/\s+/', ' ', trim((string) $request->asal_sekolah));
        if ($asalSekolahValue !== '') {
            AsalSekolah::updateOrInsert(
                ['nama_sekolah' => $asalSekolahValue],
                ['nama_sekolah' => $asalSekolahValue],
            );
        }
 
        User::find($user->id)->update([
            'name' => $request->name,
            'email' => $request->email,
            'telepon' => $request->telepon,
            'alamat' => $request->alamat,
            'nama_orang_tua' => $request->nama_orang_tua,
            'telp_orang_tua' => $request->telp_orang_tua,
            'asal_sekolah' => $asalSekolahValue,
            'jenjang' => $request->jenjang,
            'kelas' => $request->kelas,
        ]);

        if ($request->password) {
            $user = User::find($user->id);
            $user->password =  Hash::make($request->password);
            $user->update();
        }
        if ($request->hasFile('avatar')) {
            $file = $request->file('avatar');

            // Buat direktori jika belum ada
            $directory = 'public/uploads/avatar';
            if (!Storage::exists($directory)) {
                Storage::makeDirectory($directory);
            }

            // Rename file
            $fileName = time() . '_' . $file->getClientOriginalName();

            // Simpan file
            $file->storeAs($directory, $fileName);

            $file = $directory . '/' . $fileName;

            $user = User::find($user->id);
            $user->avatar =  $file;
            $user->update();
        }

        //Mail::to($user->email)->send(new WelcomeMail($user));

        return redirect()->route('siswa.dashboard')->with('success', 'Profile berhasil diupdate!');
    }
}