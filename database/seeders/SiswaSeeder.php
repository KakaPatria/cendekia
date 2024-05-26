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
        $siswaRole = Role::firstOrCreate(['name' => 'Siswa']);

        $faker = Faker::create();

        for ($i = 0; $i < 20; $i++) {
            $user = User::create([
                'name' => $faker->name,
                'email' => $faker->unique()->safeEmail,
                'telepon' => $faker->phoneNumber,
                'asal_sekolah' => $faker->company,
                'jenjang' => $faker->randomElement(['SD', 'SMP', 'SMA']),
                'kelas' => $faker->numberBetween(1, 12),
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
