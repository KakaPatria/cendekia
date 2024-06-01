<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;

class SiswaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $faker = Faker::create('id_ID');

        $sekolahSD = [
            'SD NEGERI VIDYA QASANA',
            'SD NEGERI BUMIJO',
            'SD NEGERI JETIS 1',
            'SD NEGERI JETIS 2',
            'SD NEGERI GONDOLAYU',
            'SD NEGERI JETISHARJO',
            'SD NEGERI COKROKUSUMAN',
            'SD NEGERI BADRAN',
            'SD NEGERI KYAI MOJO',
            'SD TARAKANITA 1',
            'SD KANISIUS GOWONGAN',
            'SD BUDYA WACANA 1',
            'SD BOPKRI GONDOLAYU',
            'SD BHINNEKA TUNGGAL IKA',
            'SD TAMANSISWA JETIS',
            'SD NEGERI LEMPUYANGAN 1',
            'SD NEGERI TEGALPANGGUNG',
            'SD NEGERI LEMPUYANGWANGI',
            'SD NEGERI WIDORO',
            'SD MUHAMMADIYAH BAUSASRAN 1',
            'SD MUHAMMADIYAH BAUSASRAN 2',
            'SD NEGERI BACIRO',
            'SD NEGERI SERAYU',
            'SD NEGERI UNGARAN 1',
            'SD NEGERI BHAYANGKARA',
            'SD NEGERI DEMANGAN',
            'SD NEGERI KLITREN',
            'SD NEGERI SAGAN',
            'SD NEGERI TERBANSARI 1',
            'SD KANISIUS GAYAM 1',
            'SD JOANNES BOSCO YOGYAKARTA',
        ];

        $sekolahSMP = [
            'SMP NEGERI 1 Yogyakarta',
            'SMP NEGERI 2 Yogyakarta',
            'SMP NEGERI 3 Yogyakarta',
            'SMP NEGERI 4 Yogyakarta',
            'SMP NEGERI 5 Yogyakarta',
            'SMP NEGERI 6 Yogyakarta',
            'SMP NEGERI 7 Yogyakarta',
            'SMP NEGERI 8 Yogyakarta',
            'SMP NEGERI 9 Yogyakarta',
            'SMP NEGERI 10 Yogyakarta',
            'SMP NEGERI 1 Sleman',
            'SMP NEGERI 2 Sleman',
            'SMP NEGERI 3 Sleman',
            'SMP NEGERI 4 Sleman',
            'SMP NEGERI 5 Sleman',
            'SMP NEGERI 6 Sleman',
            'SMP NEGERI 7 Sleman',
            'SMP NEGERI 8 Sleman',
            'SMP NEGERI 9 Sleman',
            'SMP NEGERI 10 Sleman',
        ];
        for ($i = 0; $i < 30; $i++) {
            $user = User::create([
                'name' => $faker->name,
                'email' => $faker->unique()->safeEmail,
                'telepon' => $faker->phoneNumber,
                'asal_sekolah' => $faker->randomElement($sekolahSD),
                //'jenjang' => $faker->randomElement(['SD', 'SMP', 'SMA']),
                'jenjang' => 'SMP',
                'kelas' => $faker->numberBetween(7, 9),
                'email_verified_at' => now(),
                'password' => Hash::make('password'), // Use a static password for simplicity
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            $user->assignRole('Siswa');
        }
    }
}
