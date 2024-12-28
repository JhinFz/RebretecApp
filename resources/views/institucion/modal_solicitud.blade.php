<div class="container">

    <form action="{{ route('institucion.form.store') }}" method="POST">
        @csrf <!-- Protección contra CSRF -->
        
        <div class="form-group">
            <label for="asunto">Asunto:</label>
            <input type="text" class="form-control" id="asunto" name="asunto" :value="old('asunto')" required>
        </div>

        <div class="form-group">
            <label for="detalles">Detalles (Causas de Mantenimiento):</label>
            <textarea class="form-control" id="detalles" name="detalles" rows="5" :value="old('detalles')"required></textarea>
        </div>

        <button type="submit" class="btn btn-success" id="enviarSolicitud">Enviar Solicitud</button>
    </form>
</div>