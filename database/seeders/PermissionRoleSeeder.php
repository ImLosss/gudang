<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::create(['name' => 'admin']);
        Role::create(['name' => 'karyawan']);

        Permission::create(['name' => 'adminAccess'])->assignRole('admin');
        Permission::create(['name' => 'karyawanAccess'])->assignRole('karyawan');
    }
}
