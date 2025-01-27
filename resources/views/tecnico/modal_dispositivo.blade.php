<div class="modal fade" id="registrarDispositivoModal" tabindex="-1" role="dialog" aria-labelledby="registrarDispositivoModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="{{ route('tecnico.dispositivo.store') }}" method="POST"> <!-- Asegúrate de que la ruta sea la correcta -->
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="registrarDispositivoModalLabel">Registrar Nuevo Dispositivo</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="name_pc">Nombre del Dispositivo:</label>
                        <input type="text" id="name_pc" name="name_pc" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="id_lab">Seleccionar Laboratorio:</label>
                        <select id="id_lab" name="id_lab" class="form-control" required>
                            <option value="">Seleccione...</option>
                            @if ($laboratorios && !$laboratorios->isEmpty())
                                @foreach($laboratorios as $laboratorio)
                                    <option value="{{ $laboratorio->id_lab }}">
                                        {{ $laboratorio->name_lab }} - id:{{ $laboratorio->id_lab }}
                                    </option>
                                @endforeach
                            @else
                                <option value="" disabled>No hay laboratorios disponibles</option>
                            @endif
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="marca">Marca:</label>
                        <input type="text" id="marca" name="marca" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="modelo">Modelo:</label>
                        <input type="text" id="modelo" name="modelo" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="serie">Serie:</label>
                        <input type="text" id="serie" name="serie" class="form-control" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Registrar Dispositivo</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                </div>
            </form>
        </div>
    </div>
</div>