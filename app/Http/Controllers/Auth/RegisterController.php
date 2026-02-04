<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\AsalSekolah;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;

class RegisterController extends Controller
{
    // --- Menampilkan Halaman ---
    public function showChoiceForm()
    {
        return view('pages.auth.pilihan-register');
    }
    public function showSiswaForm()
    {
        return view('pages.auth.register-siswa');
    }
    public function showPengajarForm()
    {
        return view('pages.auth.register-pengajar');
    }

    /**
     * Kirim OTP ke email untuk verifikasi
     */
    public function verifyEmailRealtime(Request $request)
    {
        $request->validate(['email' => 'required|email']);
        
        $email = strtolower(trim($request->email));
        
        // 1. Cek format email dasar
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return response()->json([
                'valid' => false,
                'message' => 'Format email tidak valid',
                'type' => 'format_error'
            ]);
        }
        
        // 2. Extract username dan domain
        $parts = explode('@', $email);
        if (count($parts) !== 2) {
            return response()->json([
                'valid' => false,
                'message' => 'Format email tidak valid',
                'type' => 'format_error'
            ]);
        }
        
        $username = $parts[0];
        $domain = $parts[1];
        
        // 3. Validasi username
        if (strlen($username) > 64 || strlen($username) < 3) {
            return response()->json([
                'valid' => false,
                'message' => 'Username email tidak valid (terlalu panjang atau pendek)',
                'type' => 'invalid_username'
            ]);
        }
        
        if (preg_match('/\d{10,}/', $username)) {
            return response()->json([
                'valid' => false,
                'message' => 'Email dengan terlalu banyak angka berurutan tidak diperbolehkan',
                'type' => 'suspicious_username'
            ]);
        }
        
        // 4. Cek apakah email sudah terdaftar
        if (User::where('email', $email)->exists()) {
            return response()->json([
                'valid' => false,
                'message' => 'Email sudah terdaftar di sistem',
                'type' => 'duplicate'
            ]);
        }
        
        // 5. Whitelist provider email resmi
        $allowedProviders = [
            'gmail.com', 'googlemail.com',
            'yahoo.com', 'yahoo.co.id', 'yahoo.co.uk', 'yahoo.fr', 'ymail.com', 'rocketmail.com',
            'outlook.com', 'outlook.co.id', 'hotmail.com', 'hotmail.co.id',
            'live.com', 'live.co.id', 'msn.com',
            'icloud.com', 'me.com', 'mac.com',
            'aol.com', 'protonmail.com', 'proton.me', 'pm.me',
            'zoho.com', 'zohomail.com',
        ];
        
        // 6. Cek typo domain
        $typoPatterns = [
            '/^gmai[^l]?\.com$/i', '/^g[^m]ail\.com$/i', '/^gm[^a]il\.com$/i',
            '/^gma[^i]l\.com$/i', '/^gmai[^l]\.com$/i',
            '/^ya[h]{2,}oo\.com$/i', '/^yah[o]{2,}\.com$/i',
            '/^out[l]{2,}ook\.com$/i', '/^outlo{2,}k\.com$/i',
            '/^hotmai[^l]\.com$/i',
        ];
        
        foreach ($typoPatterns as $pattern) {
            if (preg_match($pattern, $domain)) {
                return response()->json([
                    'valid' => false,
                    'message' => 'Domain email salah ketik. Periksa ejaan (gmail.com, yahoo.com, outlook.com)',
                    'type' => 'domain_typo'
                ]);
            }
        }
        
        // 7. Blacklist domain temporary
        $disposableDomains = [
            'tempmail.com', 'temp-mail.org', '10minutemail.com', 'guerrillamail.com',
            'mailinator.com', 'trashmail.com', 'yopmail.com', 'fakeinbox.com',
            'throwaway.email', 'maildrop.cc', 'getnada.com', 'spam4.me',
        ];
        
        // 8. Cek pattern mencurigakan
        if (preg_match('/(temp|fake|trash|spam|disposable|throwaway|test|example)/i', $domain)) {
            return response()->json([
                'valid' => false,
                'message' => 'Email temporary/fake tidak diperbolehkan',
                'type' => 'suspicious_pattern'
            ]);
        }
        
        if (in_array($domain, $disposableDomains)) {
            return response()->json([
                'valid' => false,
                'message' => 'Email temporary tidak diperbolehkan',
                'type' => 'disposable'
            ]);
        }
        
        // 9. Validasi domain - HARUS di whitelist atau institusi
        $isWhitelisted = in_array($domain, $allowedProviders);
        $isInstitutional = preg_match('/\.(ac\.id|edu|edu\.id|sch\.id|go\.id|gov)$/', $domain);
        
        if (!$isWhitelisted && !$isInstitutional) {
            return response()->json([
                'valid' => false,
                'message' => 'Gunakan email dari Gmail, Yahoo, Outlook, atau institusi pendidikan',
                'type' => 'unknown_domain'
            ]);
        }
        
        // 10. Verifikasi MX record
        if ($isWhitelisted && !@checkdnsrr($domain, 'MX')) {
            return response()->json([
                'valid' => false,
                'message' => 'Domain email tidak valid. Periksa kembali ejaan email',
                'type' => 'no_mx_record'
            ]);
        }
        
        if ($isInstitutional && !@checkdnsrr($domain, 'MX') && !@checkdnsrr($domain, 'A')) {
            return response()->json([
                'valid' => false,
                'message' => 'Domain institusi tidak dapat diverifikasi',
                'type' => 'no_mx_record'
            ]);
        }
        
        // 11. Email valid! Kirim OTP
        $otp = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);
        
        // Simpan OTP di session dengan expired 10 menit
        Session::put('email_otp_' . $email, [
            'otp' => $otp,
            'expires_at' => Carbon::now()->addMinutes(10)->timestamp,
            'verified' => false
        ]);
        
        try {
            // Kirim email OTP
            Mail::send('emails.otp-verification', ['otp' => $otp], function($message) use ($email) {
                $message->to($email)
                        ->subject('Kode Verifikasi Email - Cendekia LMS');
            });
            
            return response()->json([
                'valid' => true,
                'otp_sent' => true,
                'message' => 'Kode OTP telah dikirim ke email Anda. Cek inbox atau folder spam.',
                'type' => 'otp_sent',
                'provider' => $domain
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'valid' => false,
                'message' => 'Gagal mengirim email. Pastikan email Anda benar: ' . $e->getMessage(),
                'type' => 'send_error'
            ], 500);
        }
    }
    
    /**
     * Verifikasi OTP yang dimasukkan user
     */
    public function verifyOTP(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'otp' => 'required|string|size:6'
        ]);
        
        $email = strtolower(trim($request->email));
        $otp = $request->otp;
        
        // Ambil data OTP dari session
        $otpData = Session::get('email_otp_' . $email);
        
        if (!$otpData) {
            return response()->json([
                'valid' => false,
                'message' => 'Kode OTP tidak ditemukan. Silakan kirim ulang OTP.'
            ]);
        }
        
        // Cek expired
        if (Carbon::now()->timestamp > $otpData['expires_at']) {
            Session::forget('email_otp_' . $email);
            return response()->json([
                'valid' => false,
                'message' => 'Kode OTP sudah kadaluarsa. Silakan kirim ulang OTP.'
            ]);
        }
        
        // Cek OTP cocok
        if ($otpData['otp'] !== $otp) {
            return response()->json([
                'valid' => false,
                'message' => 'Kode OTP salah. Silakan periksa kembali.'
            ]);
        }
        
        // OTP benar! Mark as verified
        $otpData['verified'] = true;
        Session::put('email_otp_' . $email, $otpData);
        
        return response()->json([
            'valid' => true,
            'message' => 'Email berhasil diverifikasi!'
        ]);
    }

    // --- LOGIKA UNTUK MENYIMPAN DATA SISWA ---
    public function registerSiswa(Request $request)
    {
        // Langkah 1: Validasi data. Hanya name, email, dan password yang 'required'.
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',

            // Sisanya dibuat 'nullable' yang artinya BOLEH KOSONG
            'telepon' => 'nullable|string|max:15',
            'nama_orang_tua' => 'nullable|string|max:255',
            'telp_orang_tua' => 'nullable|string|max:15',
            'alamat' => 'nullable|string',
            'asal_sekolah' => 'nullable|string',
            'jenjang' => 'nullable|string',
            'kelas' => 'nullable|string',
        ]);

        // Langkah 2: Normalisasi 'kelas' sehingga menyimpan hanya angka (contoh: 'Kelas 9' -> '9')
        $kelasValue = null;
        if (!empty($request->kelas)) {
            if (preg_match('/\d+/', $request->kelas, $m)) {
                $kelasValue = $m[0];
            }
        }

        // Normalisasi asal sekolah (trim + reduce spaces). Jika diisi, pastikan juga masuk tabel master asal_sekolah.
        $asalSekolahValue = null;
        if ($request->filled('asal_sekolah')) {
            $normalized = preg_replace('/\s+/', ' ', trim((string) $request->asal_sekolah));
            if ($normalized !== '') {
                $asalSekolahValue = $normalized;
                AsalSekolah::updateOrInsert(
                    ['nama_sekolah' => $asalSekolahValue],
                    ['nama_sekolah' => $asalSekolahValue],
                );
            }
        }

        // Langkah 2: Simpan data ke tabel 'users' — simpan juga profil siswa ke kolom users (nullable)
        try {
            DB::transaction(function () use ($request, $kelasValue, $asalSekolahValue) {
                // compute next nomor_urut (max existing + 1) — allow null if table empty
                $nextNomor = (int) optional(DB::table('users')->selectRaw('MAX(nomor_urut) as max')->first())->max;
                $nextNomor = $nextNomor > 0 ? $nextNomor + 1 : 1;

                $user = User::create([
                    'name' => $request->name,
                    'email' => $request->email,
                    'telepon' => $request->telepon,
                    'password' => Hash::make($request->password),
                    'status' => 'Aktif',
                    'nomor_urut' => $nextNomor,
                    // siswa fields (nullable)
                    'asal_sekolah' => $asalSekolahValue,
                    'jenjang' => $request->jenjang,
                    'kelas' => $kelasValue,
                    'alamat' => $request->alamat,
                    'nama_orang_tua' => $request->nama_orang_tua,
                    'telp_orang_tua' => $request->telp_orang_tua,
                    'roles_id' => 1, // default role_id untuk Siswa
                ]);

                $user->assignRole('Siswa');
            });
        } catch (\Illuminate\Database\QueryException $ex) {
            // Handle common duplicate entry (e.g., email) gracefully
            $message = $ex->getMessage();
            if (str_contains(strtolower($message), 'duplicate') || str_contains(strtolower($message), 'unique')) {
                return back()->withInput()->withErrors(['email' => 'Data duplikat terdeteksi (mungkin email sudah terdaftar).']);
            }
            return back()->withInput()->withErrors(['db' => 'Terjadi kesalahan pada server. Silakan coba lagi.']);
        }

        // Langkah 3: Arahkan ke halaman login
        return redirect()->route('login')->with('success', 'Pendaftaran berhasil! Silakan masuk dengan akun baru Anda.');
    }

    // --- LOGIKA UNTUK MENYIMPAN DATA PENGAJAR ---
    public function registerPengajar(Request $request)
    {
        // Langkah 1: Validasi semua data yang masuk dari form
        $request->validate([
            'email' => 'required|string|email|max:255|unique:users',
            // telepon tidak wajib untuk pengajar — boleh null
            'telepon' => 'nullable|string|max:15',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Langkah 2: Simpan data ke database dalam satu transaksi
        try {
            DB::transaction(function () use ($request) {
                // compute next nomor_urut
                $nextNomor = (int) optional(DB::table('users')->selectRaw('MAX(nomor_urut) as max')->first())->max;
                $nextNomor = $nextNomor > 0 ? $nextNomor + 1 : 1;
                // determine automatic Pengajar name: "Pengajar {n}" where n is current count + 1
                $pengajarCount = DB::table('users')->where('name', 'like', 'Pengajar %')->count();
                $autoName = 'Pengajar ' . ($pengajarCount + 1);

                // Buat user baru di tabel 'users' — gunakan auto-generated name untuk pengajar
                $user = User::create([
                    'name' => $autoName,
                    'email' => $request->email,
                    'telepon' => $request->telepon,
                    'password' => Hash::make($request->password),
                    'status' => 'Aktif',
                    'nomor_urut' => $nextNomor,
                    'roles_id' => 3,
                ]);

                // Beri peran 'Pengajar'
                $user->assignRole('Pengajar');
            });
        } catch (\Illuminate\Database\QueryException $ex) {
            $message = $ex->getMessage();
            if (str_contains(strtolower($message), 'duplicate') || str_contains(strtolower($message), 'unique')) {
                return back()->withInput()->withErrors(['email' => 'email sudah terdaftar.']);
            }
            return back()->withInput()->withErrors(['db' => 'Terjadi kesalahan pada server. Silakan coba lagi.']);
        }

        // Langkah 3: Arahkan ke halaman login dengan pesan sukses
        return redirect()->route('login')->with('success', 'Pendaftaran sebagai pengajar berhasil! Silakan masuk.');
    }
}
