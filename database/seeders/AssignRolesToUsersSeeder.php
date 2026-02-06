<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;

class AssignRolesToUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Pastikan roles sudah dibuat
        $adminRole = Role::firstOrCreate(['name' => 'Admin']);
        $pengajarRole = Role::firstOrCreate(['name' => 'Pengajar']);
        $siswaRole = Role::firstOrCreate(['name' => 'Siswa']);

        // Assign role berdasarkan roles_id yang sudah ada
        // roles_id 2 = Admin, 3 = Pengajar, 4 = Siswa

        // Assign Admin role
        $admins = User::where('roles_id', 2)->get();
        foreach ($admins as $admin) {
            if (!$admin->hasRole('Admin')) {
                $admin->assignRole('Admin');
            }
        }

        // Assign Pengajar role
        $pengajars = User::where('roles_id', 3)->get();
        foreach ($pengajars as $pengajar) {
            if (!$pengajar->hasRole('Pengajar')) {
                $pengajar->assignRole('Pengajar');
            }
        }

        // Assign Siswa role
        $siswas = User::where('roles_id', 4)->get();
        foreach ($siswas as $siswa) {
            if (!$siswa->hasRole('Siswa')) {
                $siswa->assignRole('Siswa');
            }
        }

        $this->command->info('Roles assigned successfully!');
        $this->command->info('Admin: ' . $admins->count());
        $this->command->info('Pengajar: ' . $pengajars->count());
        $this->command->info('Siswa: ' . $siswas->count());
    }
}
