<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\User;

class UsuariosIndex extends Component
{

    public function render()
    {
        $usuarios = User::all();
        return view('livewire.admin.usuarios-index', compact('usuarios'));
    }
}
