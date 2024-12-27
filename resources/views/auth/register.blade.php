<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <x-authentication-card-logo />
        </x-slot>

        <x-validation-errors class="mb-4" />

        <script>
            function mostrarCamposAdicionales() {
                var seleccion = document.getElementById("opcion").value;
                var camposAdicionalesInstitucion = document.getElementById("camposAdicionalesInstitucion");
                var camposAdicionalesTecnico = document.getElementById("camposAdicionalesTecnico");

                // Mostrar u ocultar los campos adicionales
                camposAdicionalesInstitucion.style.display = seleccion === "institucion" ? "block" : "none";
                camposAdicionalesTecnico.style.display = seleccion === "tecnico" ? "block" : "none";

                // Cambiar el texto del label según la opción seleccionada
                if (seleccion === "institucion") {
                    nameLabel.innerText = "Nombre del Representante de la Institución Educativa";
                } else if (seleccion === "tecnico") {
                    nameLabel.innerText = "Nombre del Técnico";
                }
                
                // Selecciona todos los campos requeridos para 'tecnico'
                var tecnicoFields = document.querySelectorAll('.tecnico-required');
                // Selecciona todos los campos requeridos para 'institucion'
                var institucionFields = document.querySelectorAll('.institucion-required');

                if (seleccion === "institucion") {
                    // Marca los campos de 'tecnico' como requeridos
                    institucionFields.forEach(field => {
                        field.required = true;
                    });
                    // Asegúrate de que los campos de 'institucion' no sean requeridos
                    tecnicoFields.forEach(field => {
                        field.required = false;
                    });
                }
                if (seleccion === "tecnico") {
                    // Marca los campos de 'tecnico' como requeridos
                    tecnicoFields.forEach(field => {
                        field.required = true;
                    });
                    // Asegúrate de que los campos de 'institucion' no sean requeridos
                    institucionFields.forEach(field => {
                        field.required = false;
                    });
                }
            }
        </script>

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div>
                <x-label id="nameLabel" for="name" value="{{ __('Name') }}" />
                <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            </div>

            <div class="mt-4">
                <x-label for="email" value="{{ __('Email') }}" />
                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            </div>

            <div class="mt-4">
                <x-label for="password" value="{{ __('Password') }}" />
                <x-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
            </div>

            <div class="mt-4">
                <x-label for="password_confirmation" value="{{ __('Confirm Password') }}" />
                <x-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
            </div>

            <div class="mt-4">
                <x-label for="opcion" value="Elija el tipo de Usuario:" />
                <select id="opcion" name="opcion" onchange="mostrarCamposAdicionales()" required class="block mt-1 w-full">
                    <option value="">Seleccione...</option>
                    <option value="institucion">Institución Educativa</option>
                    <option value="tecnico">Técnico de Mantenimiento</option>
                </select>
            </div>
            
            <div class="mt-4" id="camposAdicionalesInstitucion" style="display:none;">

                <h3 class="mt-4 mb-3 text-center">Detalles de la Institución Educativa:</h3>
            
                <div class="mt-4">
                    <x-label value="* Nombre de la Institución Educativa:" />
                    <x-input name="instname" :value="old('instname')" class="institucion-required block mt-1 w-full" type="text" />
                </div>
                
                <div class="mt-4">
                    <x-label value="* Número de Teléfono:" />
                    <x-input name="rep-telefono" :value="old('rep-telefono')" class="institucion-required block mt-1 w-full" type="tel" />
                </div>
                
                <div class="mt-4">
                    <x-label value="* Código AMIE:" />
                    <x-input name="cod_amie" :value="old('cod_amie')" class="institucion-required block mt-1 w-full" type="text" />
                </div>

                <div class="mt-4">
                    <x-label value="* Dirección:" />
                    <x-input name="direccion" :value="old('direccion')" class="institucion-required block mt-1 w-full" type="text" />
                </div>
                
            </div>

            <div class="mt-4" id="camposAdicionalesTecnico" style="display:none;">

                <h3 class="mt-4 mb-3 text-center">Detalles del Técnico:</h3>
    
                <div class="mt-4">
                    <x-label value="* Número de Teléfono:" />
                    <x-input name="tec-telefono" :value="old('tec-telefono')" class="tecnico-required block mt-1 w-full" type="tel" />
                </div>
                
            </div>

            @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                <div class="mt-4">
                    <x-label for="terms">
                        <div class="flex items-center">
                            <x-checkbox name="terms" id="terms" required />

                            <div class="ml-2">
                                {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                        'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">'.__('Terms of Service').'</a>',
                                        'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">'.__('Privacy Policy').'</a>',
                                ]) !!}
                            </div>
                        </div>
                    </x-label>
                </div>
            @endif

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>

                <x-button class="ml-4">
                    {{ __('Register') }}
                </x-button>
            </div>
        </form>
    </x-authentication-card>
</x-guest-layout>