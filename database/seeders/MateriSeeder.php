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

        $materiSd = ['Bahasa Indonesia','Matematika','Ilmu Pengetahuan Alam'];
        $materiSMP = ['Bahasa Indonesia','Matematika','Ilmu Pengetahuan Alam','Ilmu Pengetahuan Sosial'];
        //$jenjangs = ['SD'];
        //$kelas = range(2, 6);

        $jenjangs = ['SMP'];
        $kelas = range(7, 9);

        foreach (range(1, 10) as $index) {
            Materi::create([
                'ref_materi_judul' => $faker->randomElement($materiSMP),
                'ref_materi_jenjang' => $faker->randomElement($jenjangs),
                'ref_materi_kelas' => $faker->randomElement($kelas),
            ]);
        }
    }
}
