<div class="modal fade" id="mantenimientoModal" tabindex="-1" role="dialog" aria-labelledby="mantenimientoModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="{{ route('tecnico.mantenimiento.store') }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="mantenimientoModalLabel">Registrar Actividades Correctivas</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <label>Nombre del Diagnóstico:</label>
                    <span id="diagnosticoDetail"></span>
                    <input type="hidden" name="id_diag" id="id_diag">
                    <div class="form-group">
                        <label for="descripcion_mantenimiento">Descripción de la Actividad de Mantenimiento:</label>
                        <textarea id="descripcion_mantenimiento" name="actividades" class="form-control" required></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Registrar Mantenimiento</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                </div>
            </form>
        </div>
    </div>
</div>