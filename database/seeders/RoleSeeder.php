<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $role1 = Role::create(['name'=>'Administrador']);
        $role2 = Role::create(['name'=>'Tecnico']);

        Permission::create(['name' => 'dashboard'])->syncRoles([$role1,$role2]);
        Permission::create(['name' => 'contactos'])->syncRoles([$role1]);
    }
}