<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * 
     */
    public function run()
    {
        User::create([
            'name' => 'administrador1',
            'email' => 'admin@admin.com',
            'password' => bcrypt('admin1234'),
            'is_approved' => true,
            'tipo_usuario' => 'tecnico'
        ])->assignRole('Administrador');

        User::create([
            'name' => 'tecnico1',
            'email' => 'tecnico@tecnico.com',
            'password' => bcrypt('tecnico1234'),
            'is_approved' => false,
            'tipo_usuario' => 'tecnico'
        ])->assignRole('Tecnico');

        User::factory(28)->create();
    }
}
