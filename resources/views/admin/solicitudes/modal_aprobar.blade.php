<div class="modal fade" id="modalAprobar" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Formulario para Asignación de Técnico</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="formUsuario" action="{{ route('institucion.solicitud.update', $solicitud->id_soli) }}" method="POST" onsubmit="return confirm('¿Desea aprobar esta solicitud?');">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="tecnico">Seleccionar Técnico:</label>
                        <input type="text" id="tecnico" class="form-control" placeholder="Escribe el nombre del técnico" required>
                        <input type="hidden" id="id_tecnico" name="id_tecnico">
                        <ul id="sugerencias" class="list-group"></ul>
                    </div>
                    {{-- <div class="form-group">
                        <label for="fecha_visita">Fecha y Hora de Visita:</label>
                        <input type="datetime-local" id="fecha_visita"  class="form-control" required>
                    </div> --}}
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Aprobar</button>
                        <button type="button" class="btn btn-primary" data-dismiss="modal">Cerrar</button>
                    </div>
                </form>
            </div>
            
        </div>
    </div>
</div>