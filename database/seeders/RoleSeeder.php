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
        $role3 = Role::create(['name'=>'Institucion']);

        // Permisos globales para admin y tecnico

        Permission::create(['name' => 'dashboard'])->syncRoles([$role1,$role2,$role3]);

        // Permisos de Administrador

       
        Permission::create(['name' => 'admin.solicitudes'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.users.index'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.users.edit'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.users.update'])->syncRoles([$role1]);

        // Permisos de tecnico

        Permission::create(['name' => 'tecnico.index'])->syncRoles([$role2]);
        Permission::create(['name' => 'tecnico.create'])->syncRoles([$role2]);
        Permission::create(['name' => 'tecnico.update'])->syncRoles([$role2]);
        Permission::create(['name' => 'tecnico.destroy'])->syncRoles([$role2]);

        // Permisos de Institucion

        Permission::create(['name' => 'institucion.formulario.index'])->syncRoles([$role3]);
        Permission::create(['name' => 'institucion.formulario.create'])->syncRoles([$role3]);
        Permission::create(['name' => 'institucion.formulario.update'])->syncRoles([$role3]);
        Permission::create(['name' => 'institucion.formulario.destroy'])->syncRoles([$role3]);
    }
}