<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\TryoutNilai;


class TryoutNilaiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();


        foreach (range(1, 10) as $index) {
            
            $jumlah_salah = rand(0,  50);
            $nilai = 100 - $jumlah_salah;
            $jumlah_benar = 100 - $jumlah_salah;


            TryoutNilai::create([
                'tryout_materi_id' => 'zrwvFOZiDas',
                'user_id' => $index,
                'tryout_id' => '12',
                'nilai' => $nilai,
                'jumlah_salah' => $jumlah_salah,
                'jumlah_benar' => $jumlah_benar,
            ]);
        }
    }
}
