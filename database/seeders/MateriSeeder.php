<?php

namespace Database\Seeders;

use App\Models\Materi;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class MateriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();


        $dataMateri = [
            [
                'ref_materi_judul' => 'IPA',
                'ref_materi_jenjang' => 'SD',
                'ref_materi_kelas' => '1',
            ],
            [
                'ref_materi_judul' => 'IPA',
                'ref_materi_jenjang' => 'SD',
                'ref_materi_kelas' => '2',
            ],
            [
                'ref_materi_judul' => 'IPA',
                'ref_materi_jenjang' => 'SD',
                'ref_materi_kelas' => '3',
            ],
            [
                'ref_materi_judul' => 'IPA',
                'ref_materi_jenjang' => 'SD',
                'ref_materi_kelas' => '4',
            ],
            [
                'ref_materi_judul' => 'IPA',
                'ref_materi_jenjang' => 'SD',
                'ref_materi_kelas' => '5',
            ],
            [
                'ref_materi_judul' => 'IPA',
                'ref_materi_jenjang' => 'SD',
                'ref_materi_kelas' => '6',
            ],
            [
                'ref_materi_judul' => 'IPA',
                'ref_materi_jenjang' => 'SMP',
                'ref_materi_kelas' => '7',
            ],
            [
                'ref_materi_judul' => 'IPA',
                'ref_materi_jenjang' => 'SMP',
                'ref_materi_kelas' => '8',
            ],
            [
                'ref_materi_judul' => 'IPA',
                'ref_materi_jenjang' => 'SMP',
                'ref_materi_kelas' => '9',
            ],
        ];



        foreach ($dataMateri as $key => $value) {
            $exist =   Materi::where([
                'ref_materi_judul' => $value['ref_materi_judul'],
                'ref_materi_jenjang' => $value['ref_materi_jenjang'],
                'ref_materi_kelas' => $value['ref_materi_kelas'],
            ])->first();
            if (!$exist) {
                Materi::insert(
                    [
                        'ref_materi_judul' => $value['ref_materi_judul'],
                        'ref_materi_jenjang' => $value['ref_materi_jenjang'],
                        'ref_materi_kelas' => $value['ref_materi_kelas'],
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]
                );
            }
        }
    }
}
