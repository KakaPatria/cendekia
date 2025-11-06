<?php

namespace Database\Seeders;

use App\Models\KelasCendekia;
use App\Models\KelasSiswaCendekia;
use App\Models\Tryout;
use App\Models\TryoutMateri;
use App\Models\TryoutNilai;
use App\Models\TryoutPeserta;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;


class SimulasiNilaiKelasCendekia extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $kelasCendekia = KelasCendekia::find(1); // Ganti dengan ID Kelas Cendekia yang sesuai

        $startDate = Carbon::now()->startOfWeek();

        for ($i = 1; $i <= 10; $i++) {

            $createdAt = $startDate->copy()->addWeeks($i - 1);
            $registerDue = $createdAt->copy()->addDays(6)->endOfDay();

            // === BUAT TRYOUT ===
            $tryout = Tryout::create([
                'kelas_cendekia_id'        => $kelasCendekia->kelas_cendekia_id,
                'tryout_judul'        => "Tryout Minggu ke-$i",
                'tryout_deskripsi'    => "Deskripsi untuk Tryout Minggu ke-$i. Latihan intensif sesuai jenjang dan kelas.",
                'tryout_jenjang'      => $kelasCendekia->jenjang,
                'tryout_kelas'        => $kelasCendekia->kelas,
                'tryout_register_due' => $registerDue->format('d-M-Y'),
                'tryout_banner'       => "public/uploads/banner_tryout/1760370043_banner1.png",
                'tryout_status'       => "Aktif",
                'tryout_jenis'        => "Gratis",
                'tryout_nominal'      => 0,
                'tryout_diskon'       => 0,
                'is_open'             => "Cendekia",
                'tampilkan_kunci'     => "Ya",
                'created_at'          => $createdAt,
                'updated_at'          => $createdAt,
            ]);

            // === PESERTA ===
            $peserta = KelasSiswaCendekia::where('kelas_cendekia_id', $kelasCendekia->kelas_cendekia_id)->get();
            $listPesertaData = [];

            foreach ($peserta as $key => $value) {
                $listPesertaData[$key]['tryout_id'] =  $tryout->tryout_id;
                $listPesertaData[$key]['user_id'] = $value->siswa_id;
                $listPesertaData[$key]['tryout_peserta_name'] = $value->siswa->name;
                $listPesertaData[$key]['tryout_peserta_telpon'] = $value->siswa->telepon;
                $listPesertaData[$key]['tryout_peserta_email'] = $value->siswa->email;
                $listPesertaData[$key]['tryout_peserta_alamat'] = $value->siswa->alamat ?? '';
                $listPesertaData[$key]['tryout_peserta_status'] = 1;
            }

            TryoutPeserta::insert($listPesertaData);

            // === MATERI ===
            foreach ($kelasCendekia->jadwal as $jadwal) {
                $materi = TryoutMateri::create([
                    'tryout_materi_id' => (string) Str::uuid(),
                    'tryout_id' => $tryout->tryout_id,
                    'materi_id' => $jadwal->ref_materi_id,
                    'pengajar_id' => $jadwal->guru_id,
                    'durasi' => '120',
                    'safe_mode' => 1,
                    'tryout_materi_deskripsi' => $jadwal->jadwal_cendekia_keterangan,
                ]);

                // === NILAI UNTUK SETIAP PESERTA DI MATERI INI ===
                foreach ($peserta as $p) {
                    // randomisasi realistis
                    $soal_total = rand(20, 50);
                    $jumlah_benar = rand(5, $soal_total);
                    $jumlah_salah = $soal_total - $jumlah_benar;
                    $total_point = $jumlah_benar * 5; // contoh 5 poin per soal benar
                    $nilai = round(($jumlah_benar / $soal_total) * 100, 2);

                    $mulai = $createdAt->copy()->addDays(rand(0, 5))->setTime(rand(8, 10), rand(0, 59));
                    $selesai = $mulai->copy()->addMinutes(rand(60, 120));

                    TryoutNilai::create([
                        'tryout_id'           => $tryout->tryout_id,
                        'tryout_materi_id'    => $materi->tryout_materi_id,
                        'user_id'             => $p->siswa_id,
                        'total_point'         => $total_point,
                        'nilai'               => $nilai,
                        'soal_dijekerjakan'   => $soal_total,
                        'soal_total'          => $soal_total,
                        'jumlah_salah'        => $jumlah_salah,
                        'jumlah_benar'        => $jumlah_benar,
                        'status'              => 'selesai',
                        'mulai_pengerjaan'    => $mulai,
                        'stop_pengerjaan'     => $selesai,
                        'lanjutkan_pengerjaan' => null,
                        'selesai_pengerjaan'  => $selesai,
                        'durasi_berjalan'     => $mulai->diffInMinutes($selesai),
                    ]);
                }
            }

            $this->command->info("✅ Tryout Minggu ke-$i dan nilai peserta berhasil dibuat");
        }
    }
}
