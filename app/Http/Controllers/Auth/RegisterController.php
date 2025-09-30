<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    // --- Menampilkan Halaman ---
    public function showChoiceForm() { return view('pages.auth.pilihan-register'); }
    public function showSiswaForm() { return view('pages.auth.register-siswa'); }
    public function showPengajarForm() { return view('pages.auth.register-pengajar'); }

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

    // Langkah 2: Simpan data ke tabel 'users' — simpan juga profil siswa ke kolom users (nullable)
    try {
        DB::transaction(function () use ($request) {
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
            'asal_sekolah' => $request->asal_sekolah,
            'jenjang' => $request->jenjang,
            'kelas' => $request->kelas,
            'alamat' => $request->alamat,
            'nama_orang_tua' => $request->nama_orang_tua,
            'telp_orang_tua' => $request->telp_orang_tua,
            'referal_code' => $request->referal_code ?? null,
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