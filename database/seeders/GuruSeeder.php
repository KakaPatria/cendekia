<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;


class GuruSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('id_ID');

        $nameList = [
            'Pak Rofiq',
            'Pak Rischa',
            'Bu Devi',
            'Uncle',
            'P Arfan',
            'P Handoko',
            'Pak Wodo',
            'Pak Agus',
            'Pak Andang',
            'M. Alfian',
            'Dilla',
        ];

        $dataGuru = [];
        foreach ($nameList as $key => $value) {
            $clean_name = strtolower($value);
            // hapus tanda baca
            $clean_name = str_replace([".", "'", ","], "", $clean_name);
            // ganti spasi dengan titik
            $clean_name = str_replace(" ", ".", $clean_name);
            // hapus spasi/tanda di awal/akhir
            $clean_name = trim($clean_name);
            // gabungkan jadi email
            $email = $clean_name . "@cendekia.com";



            $dataGuru =
                [
                    'roles_id' => 3,
                    'name' => $value,
                    'email' => $email . PHP_EOL,
                    'telepon' => $faker->phoneNumber,
                    'asal_sekolah' => '-',
                    //'jenjang' => $faker->randomElement(['SD', 'SMP', 'SMA']),
                    'jenjang' => '-',
                    'kelas' => '0',
                    'email_verified_at' => now(),
                    'password' => Hash::make('12345678'), // Use a static password for simplicity
                    'remember_token' => Str::random(10),
                    'created_at' => now(),
                    'updated_at' => now(),

                ];
            $user = User::create($dataGuru);
        }
    }
}
