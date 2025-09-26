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

    // Langkah 2: Simpan data ke database (tidak ada perubahan di bagian ini)
    DB::transaction(function () use ($request) {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'telepon' => $request->telepon,
            'password' => Hash::make($request->password),
            'status' => 'Aktif',
        ]);

        $user->assignRole('Siswa');

        $user->profilSiswa()->create([
            'asal_sekolah' => $request->asal_sekolah,
            'jenjang' => $request->jenjang,
            'kelas' => $request->kelas,
            'alamat' => $request->alamat,
            'nama_orang_tua' => $request->nama_orang_tua,
            'telp_orang_tua' => $request->telp_orang_tua,
            'kode_referal' => $request->kode_referal,
        ]);
    });

    // Langkah 3: Arahkan ke halaman login
    return redirect()->route('login')->with('success', 'Pendaftaran berhasil! Silakan masuk dengan akun baru Anda.');
}

    // --- LOGIKA UNTUK MENYIMPAN DATA PENGAJAR ---
    public function registerPengajar(Request $request)
    {
        // Langkah 1: Validasi semua data yang masuk dari form
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'telepon' => 'required|string|max:15',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Langkah 2: Simpan data ke database dalam satu transaksi
        DB::transaction(function () use ($request) {
            // Buat user baru di tabel 'users'
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'telepon' => $request->telepon,
                'password' => Hash::make($request->password),
                'status' => 'Aktif',
            ]);

            // Beri peran 'Pengajar'
            $user->assignRole('Pengajar');

            // Simpan data spesifik pengajar ke tabel 'profil_pengajar'
            $user->profilPengajar()->create([
                'lulusan_universitas' => $request->lulusan_universitas,
                'jurusan' => $request->jurusan,
                'nomor_rekening' => $request->nomor_rekening,
            ]);
        });

        // Langkah 3: Arahkan ke halaman login dengan pesan sukses
        return redirect()->route('login')->with('success', 'Pendaftaran sebagai pengajar berhasil! Silakan masuk.');
    }
}