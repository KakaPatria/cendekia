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

        $jenjangs = ['SMP'];
        $kelas = range(7, 9);

        foreach (range(1, 10) as $index) {
            Materi::create([
                'ref_materi_judul' => $faker->sentence,
                'ref_materi_jenjang' => $faker->randomElement($jenjangs),
                'ref_materi_kelas' => $faker->randomElement($kelas),
            ]);
        }
    }
}
