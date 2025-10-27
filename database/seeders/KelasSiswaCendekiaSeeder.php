<?php

namespace Database\Seeders;

use App\Models\KelasCendekia;
use App\Models\KelasSiswaCendekia;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KelasSiswaCendekiaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $dataKelasSIswa = [
            ['6 - 2', 'ZAHRAN HAFID AL KHALIFI'],
            ['9 - 1', 'RAMEYZA HAFID QURRATUAININ'],
            ['9 - 3', 'MUHAMMAD FATHURROHMAN'],
            ['9 - 4', 'NOUVELINE PRIMA SARI'],
            ['9 - 1', 'MADHYANA DIPTA KIRANAJATI'],
            ['5 ADI W', 'ATHIFA HATMAKINARTIKA'],
            ['9 - 1', 'MUHAMMAD ZURAR RAFIF'],
            ['8 - 2', 'NAYARA PUTRI ISNAINI'],
            ['9 - 2', 'FAKHRI ARBIA PRATAMA'],
            ['9 - 5', 'HADIAH NAFI RUSDIANA NINGSIH'],
            ['6 - 2', 'JANEETA NAIFA SILMI'],
            ['6 - 1', 'AHZA DANISH FAHREZA'],
            ['7 - 2', 'SOFIE ALEA NUR SYABAN PALUPI'],
            ['7 - 3', 'AKMAL KENZIE KURNIADI'],
            ['7 - 1', 'KAYLA RAISA NURADHARA'],
            ['5 - 1', 'ALIYYAH ZAHRA MAHESTRI'],
            ['5 -1', 'AYRAHASNA ABHIMASYAH'],
        ];

        foreach ($dataKelasSIswa as $key => $value) {
            $kelas =  KelasCendekia::where('kelas_cendekia_nama', $value[0])
                ->first();
            $siswa = User::where('name', $value[1])
                ->where('roles_id', 1)
                ->first();

            KelasSiswaCendekia::create([
                'kelas_cendekia_id' => $kelas->kelas_cendekia_id ?? 0,
                'siswa_id' => $siswa->id,
            ]);
        }
    }
}
