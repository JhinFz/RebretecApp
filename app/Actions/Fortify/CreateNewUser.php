<?php

namespace App\Actions\Fortify;

use App\Models\User;
use App\Models\PerfilInstitucion;
use App\Models\PerfilTecnico;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array<string, string>  $input
     */
    public function create(array $input): User
    {
        Validator::make($input, [
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => $this->passwordRules(),
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',
            'opcion' => ['required', 'string'],
        ])->validate();

        if ($input['opcion'] === 'institucion' ) {
            Validator::make($input, [
                'instname' => ['required', 'string', 'max:255'],
                'cod_amie' => ['required', 'string', 'max:8'],
                'direccion' => ['required', 'string', 'max:255'],
                'rep-telefono' => ['required', 'string', 'max:10', 'regex:/^\d+$/'],
            ], [
                'instname.required' => 'El nombre de la institución es obligatorio.',
                'instname.string' => 'El nombre de la institución debe ser una cadena de texto.',
                'instname.max' => 'El nombre de la institución no puede tener más de 255 caracteres.',
            
                'cod_amie.required' => 'El código AMIE es obligatorio.',
                'cod_amie.string' => 'El código AMIE debe ser una cadena de texto.',
                'cod_amie.max' => 'El código AMIE no puede tener más de 8 caracteres.',
            
                'direccion.required' => 'La dirección es obligatoria.',
                'direccion.string' => 'La dirección debe ser una cadena de texto.',
                'direccion.max' => 'La dirección no puede tener más de 255 caracteres.',
            
                'rep-telefono.required' => 'El número de teléfono es obligatorio.',
                'rep-telefono.max' => 'El número de teléfono no puede tener más de 10 caracteres.',
                'rep-telefono.regex' => 'El número de teléfono solo puede contener dígitos.',

            ])->validate();
        }

        if ($input['opcion'] === 'tecnico' ) {
            Validator::make($input, [
                'tec-telefono' => ['required', 'string', 'max:10','regex:/^\d+$/'],
            ], [     
                'rep-telefono.required' => 'El número de teléfono es obligatorio.',
                'rep-telefono.max' => 'El número de teléfono no puede tener más de 10 caracteres.',
                'rep-telefono.regex' => 'El número de teléfono solo puede contener dígitos.',
                
            ])->validate();
        }

        $user = User::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
            'tipo_usuario'=>$input['opcion'],
        ]);

        // Crear el detalle solo si se seleccionó "institucion"
        if ($user) {
            if ($user->tipo_usuario === 'institucion') {
            
                PerfilInstitucion::create([
                    'user_id' => $user->id,
                    'instname' => $input['instname'],
                    'cod_amie' => $input['cod_amie'],
                    'direccion' => $input['direccion'],
                    'telefono' => $input['rep-telefono']
                ]);
            }
    
            if ($user->tipo_usuario === 'tecnico') {
                
                PerfilTecnico::create([
                    'user_id' => $user->id,
                    'telefono' => $input['tec-telefono']
                ]);
            }
        }
        return $user;
    }
}
