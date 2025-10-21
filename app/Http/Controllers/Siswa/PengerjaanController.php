<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Models\Tryout;
use App\Models\TryoutMateri;
use App\Models\TryoutNilai;
use App\Models\TryoutPengerjaan;
use App\Models\TryoutSoal;
use Illuminate\Http\Request;
use Carbon\Carbon;

class PengerjaanController extends Controller
{
    public function create($id, $tryout_peserta_id)
    {

        $tryoutMateri = TryoutMateri::with('tryoutMaster', 'soal.jawaban', 'soal.pengerjaan')->find($id);

        if (!$tryoutMateri->tryoutMaster->is_registered) {
            return redirect()->route('siswa.tryout.detail', $tryout_peserta_id)
                ->withError(('Maaf Anda tidak terdaftar dalam tryout ini'));
        }
        if ($tryoutMateri->tryoutMaster->tryout_status != 'Aktif') {
            return redirect()->route('siswa.tryout.detail', $tryout_peserta_id)
                ->withError(('Maaf Tryout sudah tidak aktif'));
        }

        /*if (!$tryoutMateri->in_periode) {
            return redirect()->route('siswa.tryout.show', $tryoutMateri->tryout_id)
                ->withError(('Maaf Tryout sedang tidak dalam periode pengerjaan'));
        }*/

        if ($tryoutMateri->soal->count() == 0) {
            return redirect()->route('siswa.tryout.detail', $tryout_peserta_id)
                ->withError(('Maaf Tryout belum bisa dikerjakan'));
        }

        $nilai = TryoutNilai::where('tryout_materi_id', $id)
            ->where('user_id', auth()->user()->id)
            ->first();

        if ($nilai) {
            if ($nilai->status  == 'Selesai') {
                return redirect()->route('siswa.tryout.show', $tryoutMateri->tryout_id)
                    ->withSuccess(('Teyout sudah selesai di kerjakan'));
            }
        } else {
            $nilai = new TryoutNilai();
            $nilai->tryout_id = $tryoutMateri->tryout_id;
            $nilai->tryout_materi_id = $id;
            $nilai->user_id = auth()->user()->id;
            $nilai->soal_total = $tryoutMateri->jumlah_soal;
            $nilai->soal_dijekerjakan = 0;
            $nilai->status = 'Proses';
            $nilai->mulai_pengerjaan = now();
            $nilai->save();
        }

        $nilai->lanjutkan_pengerjaan = now();
        $nilai->save();

        $load['tryout_materi'] = $tryoutMateri;
        $load['tryout_nilai'] = $nilai;

        $sisaWaktu = 0;
        if ($tryoutMateri->durasi) {
            $sisaWaktu = ($tryoutMateri->durasi * 60) - ($nilai->durasi_berjalan ?? 0);
        }
        //dd($sisaWaktu);
        $load['tryout_peserta_id'] = $tryout_peserta_id;
        $load['sisa_waktu'] = $sisaWaktu;

        return view('pages.siswa.pengerjaan.create', $load);
    }

    public function jawabOld(Request $request, $id)
    {

        $request->validate([
            'tryout_materi_id' => 'required',
            'tryout_soal_id' => 'required',
            'jawaban' => 'required',
        ]);
        $nilai = TryoutNilai::find($id);
        $nilai->soal_dijekerjakan = $request->soal_nomor;
        $nilai->last_soal_id = $request->tryout_soal_id;
        $nilai->save();

        $soal = TryoutSoal::find($request->tryout_soal_id);

        $pengerjaan  = TryoutPengerjaan::where('tryout_materi_id', $request->tryout_materi_id)
            ->where('tryout_soal_id', $request->tryout_soal_id)
            ->where('user_id', auth()->user()->id)
            ->first();

        if (!$pengerjaan) {
            $pengerjaan = new TryoutPengerjaan();
        }
        $pengerjaan->tryout_materi_id = $request->tryout_materi_id;
        $pengerjaan->tryout_soal_id = $request->tryout_soal_id;
        $pengerjaan->user_id = auth()->user()->id;
        $pengerjaan->tryout_jawaban = $request->jawaban;
        $pengerjaan->status = in_array($request->jawaban, json_decode($soal->tryout_kunci_jawaban)) ? 'Benar' : 'Salah';
        //dd($pengerjaan);
        $pengerjaan->save();
    }


    public function jawab(Request $request,$id)
    {
        $nilai = TryoutNilai::find($id);
        $nilai->soal_dijekerjakan = $request->soal_nomor;
        $nilai->last_soal_id = $request->tryout_soal_id;
        $nilai->save();

        $soal = TryoutSoal::find($request->tryout_soal_id);

        $jawabanSiswa = $request->jawaban;
        $kunci = json_decode($soal->tryout_kunci_jawaban, true);
        $nilai = 0;
        $status = 'Salah';
        $detail_status = [];


        $simpanJawaban = [];
        switch ($soal->tryout_soal_type) {
            case 'SC':
                if ($jawabanSiswa === $kunci[0]) {
                    $nilai = $soal->point;
                    $status = 'Benar';
                }
                $simpanJawaban = (array) $jawabanSiswa;

                break;

            case 'MC':
                $benar = count(array_intersect($jawabanSiswa, $kunci));
                $totalBenar = count($kunci);
                $salah = count(array_diff($jawabanSiswa, $kunci));
                $nilai = max(0, (($benar - $salah) / $totalBenar) * $soal->point);
                $status = ($benar == $totalBenar && $salah == 0)
                    ? 'Benar'
                    : (($benar > 0) ? 'Sebagian Benar' : 'Salah');

                $simpanJawaban = $jawabanSiswa;

                break;

            case 'MCMA':
                $benar = 0;
                $total = count($kunci);
                foreach ($kunci as $key => $val) {
                    if (isset($jawabanSiswa[$key]) && $jawabanSiswa[$key] == $val) {
                        $benar++;
                        $detail_status[$key] = 'Benar';
                    } else {
                        $detail_status[$key] = 'Salah';
                    }
                }
                $nilai = ($benar / $total) * $soal->point;
                $status = ($benar == $total)
                    ? 'Benar'
                    : (($benar > 0) ? 'Sebagian Benar' : 'Salah');

                $simpanJawaban = $jawabanSiswa;

                break;
        }
 
        // Simpan hasil ke DB
        TryoutPengerjaan::updateOrCreate(
            [
                'tryout_soal_id' => $soal->tryout_soal_id,
                'user_id' => auth()->id(),
                'tryout_materi_id' => $request->tryout_materi_id,
            ],
            [
                'tryout_jawaban' => json_encode($simpanJawaban),
                'point' => round($nilai, 2),
                'status' => $status,
            ]
        );

        return response()->json([
            'success' => true,
            //'nilai' => round($nilai, 2),
            //'status' => $status,
            //'detail_status' => $detail_status
        ]);
    }


    public function leave($id, $tryout_peserta_id, Request $request)
    {
        $now = now();
        $nilai = TryoutNilai::find($id);
        $nilai->stop_pengerjaan = $now;
        $start = Carbon::parse($nilai->mulai_pengerjaan);
        $durasi = $start->diffInSeconds($now);
        $nilai->durasi_berjalan = $durasi;

        $pengerjaan = TryoutPengerjaan::where('tryout_materi_id', $nilai->tryout_materi_id)
            ->where('user_id', auth()->user()->id);

        $soal = TryoutSoal::where('tryout_materi_id', $nilai->tryout_materi_id)
            ->count();
        if ($pengerjaan->count() == $soal || ($nilai->tryoutMateri->durasi > 0 && $durasi >= ($nilai->tryoutMateri->durasi * 60))) {

            $salah = $pengerjaan->where('status', 'Salah')->count();
            $pengerjaan = TryoutPengerjaan::with('soal')->where('tryout_materi_id', $nilai->tryout_materi_id)
                ->where('user_id', auth()->user()->id);
            $benar = $pengerjaan->where('status', 'Benar');

            $totalPoint = 0;
            foreach ($benar->get() as $key => $value) {
                $totalPoint += $value->soal->point;
            }
            $nilai->jumlah_salah = $salah;
            $nilai->jumlah_benar = $benar->count();
            $nilai->total_point = $totalPoint;
            $nilai->nilai = ($benar->count() / $nilai->soal_total) * 100;
            $nilai->status = 'Selesai';
            $nilai->selesai_pengerjaan = now();
        }
        $nilai->update();

        $message = 'Meninggalkan tryout';
        if ($request->type == 1) {
            $message = 'Meninggalkan tryout, Waktu Pengerjaan sudah habis!';
        }

        return redirect()->intended(route('siswa.tryout.detail', $tryout_peserta_id))->withSuccess($message);
    }

    public function selesai($id, $tryout_peserta_id)
    {
        $nilai = TryoutNilai::find($id);

        if ($nilai->status == 'Selesai') {
            return redirect()->intended(route('siswa.tryout.detail', $nilai->tryout_id))
                ->withSuccess('Tryout sudah selesaikan nilai tidak bisa diperbarui');
        }
        $pengerjaan = TryoutPengerjaan::where('tryout_materi_id', $nilai->tryout_materi_id)
            ->where('user_id', auth()->user()->id);

        $salah = $pengerjaan->where('status', 'Salah')->count();
        $pengerjaan = TryoutPengerjaan::with('soal')->where('tryout_materi_id', $nilai->tryout_materi_id)
            ->where('user_id', auth()->user()->id);
        $benar = $pengerjaan->whereIn('status', ['Benar','Sebagian Benar']);

        $totalPoint = 0;
        foreach ($benar->get() as $key => $value) {
            $totalPoint += $value->soal->point;
        }

        $nilai->jumlah_salah = $salah;
        $nilai->jumlah_benar = $benar->count();
        $nilai->total_point = $totalPoint;
        $nilai->nilai = ($benar->count() / $nilai->soal_total) * 100;
        $nilai->status = 'Selesai';
        $nilai->selesai_pengerjaan = now();
        //dd($nilai);
        $nilai->update();

        return redirect()->intended(route('siswa.tryout.detail', $tryout_peserta_id))->withSuccess('Tryout Selesai, Terimakasih sudah mengerjakan dengan penuh semangat');
    }

    public function analisa($id)
    {

        $pengerjaan = TryoutPengerjaan::with('soal')->find($id);
        $load['pengerjaan']  = $pengerjaan;

        return view('pages.siswa.pengerjaan.detail_analisa', $load);
    }
}
