<?php

namespace Database\Seeders;

use App\Models\KelasCendekia;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KelasCendekiaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $dataKelas = [
            ['kelas_cendekia_nama' => '9 - 1', 'jenjang' => 'SMP', 'kelas' => 9],
            ['kelas_cendekia_nama' => '9 - 2', 'jenjang' => 'SMP', 'kelas' => 9],
            ['kelas_cendekia_nama' => '9 - 3', 'jenjang' => 'SMP', 'kelas' => 9],
            ['kelas_cendekia_nama' => '9 - 4', 'jenjang' => 'SMP', 'kelas' => 9],
            ['kelas_cendekia_nama' => '9 - 5', 'jenjang' => 'SMP', 'kelas' => 9],
            ['kelas_cendekia_nama' => '6 - 1', 'jenjang' => 'SD', 'kelas' => 6],
            ['kelas_cendekia_nama' => '6 - 2', 'jenjang' => 'SD', 'kelas' => 6],
            ['kelas_cendekia_nama' => '7 - 1', 'jenjang' => 'SMP', 'kelas' => 7],
            ['kelas_cendekia_nama' => '7 - 2', 'jenjang' => 'SMP', 'kelas' => 7],
            ['kelas_cendekia_nama' => '7 - 3', 'jenjang' => 'SMP', 'kelas' => 7],
            ['kelas_cendekia_nama' => '8 - 2', 'jenjang' => 'SMP', 'kelas' => 8],
            ['kelas_cendekia_nama' => '5 - 1', 'jenjang' => 'SD', 'kelas' => 5],
            ['kelas_cendekia_nama' => '5 ADI W', 'jenjang' => 'SD', 'kelas' => 5],

        ];

        foreach ($dataKelas as $key => $value) {
            KelasCendekia::create($value);
        }
    }
}
