<div class="modal fade" id="modalUsuario" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Información del Usuario</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="formUsuario" action="{{ route('institucion.perfil.update', $perfil->id_perfil) }}" method="POST" onsubmit="return confirm('Confirmar envío, ¿son todos los campos correctos?');">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="instname">Nombre de la Institución Educativa</label>
                        <input type="text" class="form-control" name="instname" value="{{ $perfil->instname }}" required>
                    </div>
                    <div class="form-group">
                        <label for="telefono">Número de Teléfono</label>
                        <input type="text" class="form-control" name="telefono" value="{{ $perfil->telefono }}" required>
                    </div>
                    <div class="form-group">
                        <label for="cod_amie">Código AMIE</label>
                        <input type="text" class="form-control" name="cod_amie" value="{{ $perfil->cod_amie }}" required>
                    </div>
                    <div class="form-group">
                        <label for="direccion">Dirección del Establecimiento</label>
                        <input type="text" class="form-control" name="direccion" value="{{ $perfil->direccion }}" required>
                    </div>
                    <div class="form-group">
                        <label for="name">Nombre del Representante</label>
                        <input class="form-control" value="{{ Auth::user()->name }}" readonly>
                    </div>           
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary" id="guardarUsuario">Guardar</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    </div>      
                </form>
            </div>
            
        </div>
    </div>
</div>