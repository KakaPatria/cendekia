<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;


class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'id' => 1,
            'roles_id' => 2,
            'name' => 'Super Admin',
            'email' => 'admin@cendekia.com',
            'telepon' =>'085600200913',
            'asal_sekolah' =>'-',
            'jenjang' => '',
            'kelas' => '',
            'email_verified_at' => now(),
            'password' => Hash::make('password'), // Use a static password for simplicity
            'remember_token' => Str::random(10),
            'created_at' => now(),
            'updated_at' => now(),
            'avatar' => 'default.png',
        ]);

        $user->assignRole('Admin');
    }
}
