<?php

namespace App\Http\Controllers;

use App\Mail\SendKonfirmasiTryoutMail;
use Illuminate\Http\Request;
use App\Models\Tryout;
use App\Models\TryoutOpenPendaftaran;
use App\Models\AsalSekolah;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Mail;

class HomeController extends Controller
{
    public function index()
    {
        $tryout =  Tryout::where('tryout_status', 'Aktif')
            ->where('is_open', 'Ya');
        $tryout = $tryout->limit(3)->orderByDesc('tryout_register_due');
        $load['tryout'] = $tryout->get();


        return view('pages.index', $load);
    }

    public function daftarTryout($tryoutId)
    {

        $load['tryout'] = Tryout::find($tryoutId);


        return view('pages.daftar_tryout', $load);
    }

    public function daftarTryoutStore($tryoutId, Request $request)
    {

        $validated = $request->validate(
            [
                'top_email' => 'required|email|max:255',
                'top_nama_siswa' => 'required|string|max:100',
                'top_asal_sekolah' => 'required|string|max:100',
                'top_telpon_siswa' => 'required|digits_between:10,15',
                'top_nama_orang_tua' => 'required|string|max:100',
                'top_telpon_orang_tua' => 'required|digits_between:10,15',
                'top_tanggal_bayar' => 'required|date',
                'top_jenis_bayar' => 'required|string',
                'top_bukti_bayar' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
                'top_nama_bayar' => 'required|string|max:100',
            ],
            [
                'top_email.required' => 'Email harus diisi.',
                'top_email.email' => 'Format email tidak valid.',
                'top_email.max' => 'Email maksimal 255 karakter.',

                'top_nama_siswa.required' => 'Nama siswa harus diisi.',
                'top_nama_siswa.string' => 'Nama siswa harus berupa teks.',
                'top_nama_siswa.max' => 'Nama siswa maksimal 100 karakter.',

                'top_asal_sekolah.string' => 'Asal sekolah harus berupa teks.',
                'top_asal_sekolah.max' => 'Asal sekolah maksimal 100 karakter.',

                'top_telpon_siswa.required' => 'Nomor telepon siswa harus diisi.',
                'top_telpon_siswa.digits_between' => 'Nomor telepon siswa harus antara 10 hingga 15 digit.',

                'top_nama_orang_tua.required' => 'Nama orang tua harus diisi.',
                'top_nama_orang_tua.string' => 'Nama orang tua harus berupa teks.',
                'top_nama_orang_tua.max' => 'Nama orang tua maksimal 100 karakter.',

                'top_telpon_orang_tua.required' => 'Nomor telepon orang tua harus diisi.',
                'top_telpon_orang_tua.digits_between' => 'Nomor telepon orang tua harus antara 10 hingga 15 digit.',

                'top_tanggal_bayar.required' => 'Tanggal bayar harus diisi.',
                'top_tanggal_bayar.date' => 'Format tanggal bayar tidak valid.',

                'top_jenis_bayar.required' => 'Jenis pembayaran harus diisi.',
                'top_jenis_bayar.in' => 'Jenis pembayaran hanya boleh "cash" atau "transfer".',

                'top_bukti_bayar.file' => 'Bukti pembayaran harus berupa file.',
                'top_bukti_bayar.mimes' => 'Bukti pembayaran harus berupa file dengan format jpg, jpeg, png, atau pdf.',
                'top_bukti_bayar.max' => 'Bukti pembayaran maksimal 2MB.',

                'top_nama_bayar.required' => 'Nama pembayaran harus diisi.',
                'top_nama_bayar.string' => 'Nama pembayaran harus berupa teks.',
                'top_nama_bayar.max' => 'Nama pembayaran maksimal 100 karakter.',
            ]
        );

        $tryout = Tryout::find($tryoutId);


        if ($tryout) {
            $validated['tryout_id'] = $tryout->tryout_id;

            AsalSekolah::updateOrInsert(
                ['nama_sekolah' => $request->top_asal_sekolah],
                ['nama_sekolah' => $request->top_asal_sekolah],
            );

            if ($request->hasFile('top_bukti_bayar')) {
                $file = $request->file('top_bukti_bayar');
                // Buat direktori jika belum ada
                $directory = 'public/uploads/bukti_bayar';
                if (!Storage::exists($directory)) {
                    Storage::makeDirectory($directory);
                }

                // Rename file
                $fileName = time() . '_' . $file->getClientOriginalName();

                // Simpan file
                $upload = $file->storeAs($directory, $fileName);
                //dd($upload);
                //dd($upload);
                $validated['top_bukti_bayar'] = 'uploads/bukti_bayar/' . $fileName;
            }

            $insert = TryoutOpenPendaftaran::create($validated);

            if ($insert) {
                //Todo Email
                $pendaftaran = TryoutOpenPendaftaran::find($insert->top_id);
                //Mail::to($pendaftaran->top_email)->send(new SendKonfirmasiTryoutMail($pendaftaran));
                Mail::to('faris@lifemedia.id')->send(new SendKonfirmasiTryoutMail($pendaftaran));

                //redirect success page
                return redirect(route('daftar_tryout.success'));
            } else {
                return redirect(route('daftar_tryout', $tryout->tryout_id))->with('error', 'Daftar tryout gagal!');
            }
        } else {

            return redirect('/')->with('error', 'Daftar tryout gagal!');
        }
    }
}
