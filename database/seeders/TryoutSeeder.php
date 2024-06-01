<?php

namespace Database\Seeders;

use App\Models\Tryout;
use App\Models\TryoutMateri;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Faker\Factory as Faker;

class TryoutSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        $jenjangs = ['SD'];
        $kelas = range(2, 6);

        foreach (range(1, 10) as $index) {
            $jenis = $faker->randomElement(['Gratis', 'Berbayar']);
            $data = [
                'tryout_judul' => 'TRYOUT ' . $jenjangs[0] . ' Paket ' . $index,
                'tryout_deskripsi' => $faker->sentence(),
                'tryout_jenjang' => $faker->randomElement($jenjangs),
                'tryout_kelas' => $faker->randomElement($kelas),
                'tryout_register_due' => $faker->randomElement([1, 30]) . date('-M-Y'),
                'tryout_status' => 'Aktif',
                'tryout_jenis' => $jenis,
                'tryout_nominal' => $jenis == 'Gratis' ? 0 : $faker->randomNumber(6, true),
            ];
            //print_r($data);die;
            $tryout = Tryout::create($data);
            $itemLenght = $faker->numberBetween(1, 4);
            foreach (range(1, $itemLenght) as $key => $value) {
                TryoutMateri::create([
                    'tryout_materi_id' => Str::random(10),
                    'tryout_id' => $tryout->tryout_id,
                    'materi_id' =>  $faker->randomElement([1, 10]),
                    'pengajar_id' =>  $faker->randomElement([82, 91]),
                    'tryout_materi_deskripsi' =>  $faker->sentence(),
                ]);
            }
        }
    }
}
