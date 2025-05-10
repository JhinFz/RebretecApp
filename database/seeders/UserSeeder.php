<?php

namespace Database\Seeders;

use App\Models\PerfilTecnico;
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
            'tipo_usuario' => 'admin'
        ])->assignRole('Administrador');

        PerfilTecnico::create([
            'user_id' => 1,
            'telefono' => '0123456789'
        ]);

        User::create([
            'name' => 'tecnico1',
            'email' => 'tecnico@tecnico.com',
            'password' => bcrypt('tecnico1234'),
            'is_approved' => false,
            'tipo_usuario' => 'tecnico'
        ])->assignRole('Tecnico');

        PerfilTecnico::create([
            'user_id' => 2,
            'telefono' => '0987654321'
        ]);

        User::factory(28)->create();
    }
}
