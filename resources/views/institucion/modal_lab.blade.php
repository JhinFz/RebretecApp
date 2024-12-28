<div class="modal fade" id="modalLaboratorio" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Registrar Laboratorio</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="formLaboratorio" action="{{ route('institucion.lab.store') }}" method="POST" onsubmit="return confirm('Confirmar envío, una vez registrados los datos, no pueden modificarse');">
                    @csrf
                    <div class="form-group">
                        <label>Nombre del Laboratorio</label>
                        <input type="text" class="form-control" name="name_lab" required>
                    </div>
                    <div class="form-group">
                        <label>Ubicación</label>
                        <input type="text" class="form-control" name="ubicacion_lab" required>
                    </div>
                    <div class="form-group">
                        <label>Cantidad de PC</label>
                        <input type="number" class="form-control" name="cant_pc" required>
                    </div>
                    <div class="form-group">
                        <label>¿El laboratorio dispone de Internet?</label>
                        <select class="form-control" name="d_internet" required>
                            <option value="" disabled selected>Seleccionar...</option>
                            <option value="Si">Sí</option>
                            <option value="No">No</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Detalles Adicionales</label>
                        <textarea class="form-control" name="mensaje" required></textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary" id="guardarLaboratorio">Guardar</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    </div>
                </form>
            </div>
            
        </div>
    </div>
</div>