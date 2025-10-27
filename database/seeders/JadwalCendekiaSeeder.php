<?php

namespace Database\Seeders;

use App\Models\JadwalCendekia;
use App\Models\KelasCendekia;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Materi;
use App\Models\User;

class JadwalCendekiaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $listJadwal = [
            ['9 - 1', '9', 'Matematika', 'Pak Rofiq',    'Senin', '16:15', '17:45'],
            ['9 - 1', '9', 'IPA',    'Pak Rischa', 'Senin', '16:30', '17:45'],
            ['9 - 1', '9', 'Bahasa Indonesia', 'Bu Devi', 'Senin', '16:15', '17:45'],
            ['9 - 1', '9', 'Bahasa Inggris', 'Uncle', 'Senin', '16:30', '18:00'],
            ['9 - 3', '9', 'Matematika', 'Pak Wodo',    'Senin', '16:15', '17:45'],
            ['9 - 3', '9', 'IPA', 'Pak Andang',    'Senin', '16:15', '17:45'],
            ['9 - 3', '9', 'Bahasa Indonesia', 'Bu Devi',    'Senin', '16:30', '18:00'],
            ['9 - 4', '9', 'Matematika', 'Pak Wodo', 'Senin', '18:30', '20:00'],
            ['9 - 4', '9', 'IPA', 'Pak Andang',    'Senin', '18:30', '20:00'],
            ['9 - 4', '9', 'Bahasa Indonesia', 'Bu Devi',    'Senin', '18:30', '20:00'],
            ['9 - 4', '9', 'Bahasa Inggris',    'Uncle',    'Senin', '18:30', '20:00'],
            ['6 - 1', '6', 'Matematika', 'Pak Agus', 'Senin', '16:15', '17:45'],
            ['6 - 1', '6', 'Bahasa Indonesia',    'P Handoko',    'Senin', '15:30', '17:00'],
            ['5 - 1', '5', 'Matematika',    'Atika',    'Senin', '17:00', '18:30'],
            ['5 - 1', '5', 'IPA', 'Atika',    'Senin', '15:30', '17:00'],
            ['5 - 1', '5', 'Bahasa Indonesia', 'Atika',    'Senin', '17:00', '18:30']
        ];

        foreach ($listJadwal as $key => $value) {
            $kelas = KelasCendekia::where('kelas_cendekia_nama', $value[0])
                ->first();

            $materi = Materi::where('ref_materi_judul', 'like', '%' . $value[2] . '%')
                ->where('ref_materi_kelas', $value[1])
                ->first();
            $guru = User::where('name', 'like', '%' . $value[3] . '%')
                ->where('roles_id', 3)
                ->first();

            $dataJadwal = [
                'kelas_cendekia_id' => $kelas->kelas_cendekia_id ?? 0,
                'ref_materi_id' => $materi->ref_materi_id ?? 0,
                'guru_id' => $guru->id ?? 0,
                'jadwal_cendekia_hari' => $value[4],
                'jadwal_mulai' => $value[5],
                'jadwal_selesai' => $value[6],
            ];
            JadwalCendekia::create($dataJadwal);
        }
    }
}
