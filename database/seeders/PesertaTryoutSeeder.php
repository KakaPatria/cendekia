<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\TryoutPeserta;



class PesertaTryoutSeeder extends Seeder
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
            TryoutPeserta::create([
                'user_id' => $index,
                'tryout_id' => '12',
                'tryout_peserta_status' => $faker->randomElement([1,0]),
            ]);
        }
    }
}
