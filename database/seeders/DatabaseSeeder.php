<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            RolePermissionSeeder::class,
            AsalSekolahSeeder::class,
            AdminSeeder::class,
            PrefixNumberSeeder::class,
            // GuruSeeder::class,
            // SiswaSeeder::class,
            MateriSeeder::class,
            KelasCendekiaSeeder::class,
            // JadwalCendekiaSeeder::class,
            // KelasSiswaCendekiaSeeder::class,
            // TryoutSeeder::class,
            // PesertaTryoutSeeder::class,
            // TryoutNilaiSeeder::class,
            // SimulasiNilaiKelasCendekia::class,
        ]);
    }
}
