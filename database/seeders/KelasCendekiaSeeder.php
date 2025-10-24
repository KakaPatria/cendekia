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
            ['kelas_cendekia_nama' => '9 - 1'],
            ['kelas_cendekia_nama' => '9 - 2'],
            ['kelas_cendekia_nama' => '9 - 3'],
            ['kelas_cendekia_nama' => '9 - 4'],
            ['kelas_cendekia_nama' => '9 - 5'],
            ['kelas_cendekia_nama' => '6 - 1'],
            ['kelas_cendekia_nama' => '6 - 2'],
            ['kelas_cendekia_nama' => '7 - 1'],
            ['kelas_cendekia_nama' => '7 - 2'],
            ['kelas_cendekia_nama' => '7 - 3'],
            ['kelas_cendekia_nama' => '8 - 2'],
            ['kelas_cendekia_nama' => '5 - 1'],
            ['kelas_cendekia_nama' => '5 ADI W'],

        ];

        foreach ($dataKelas as $key => $value) {
            KelasCendekia::create($value);
        }
    }
}
