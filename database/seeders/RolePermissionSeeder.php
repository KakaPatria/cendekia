<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;


class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            'panel.dashboard',
            'panel.logout',

            'siswa.dashboard',
            'siswa.logout',

        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        // Create roles and assign permissions
        $roles = [
            'Siswa' => ['siswa.dashboard', 'siswa.logout'],
            'Admin' => ['panel.dashboard', 'panel.logout'],
            'Pengajar' =>  ['panel.dashboard', 'panel.logout'],
        ];

        foreach ($roles as $role => $rolePermissions) {
            $role = Role::firstOrCreate(['name' => $role]);
            $role->givePermissionTo($rolePermissions);
        }
    }
}
