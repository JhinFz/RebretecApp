<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/contactStyle.css') }}">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!------ Include the above in your HEAD tag ---------->
@csrf
<div class="container contact-form">
    @csrf
            <div class="contact-image">
                <img src="https://cdn-icons-png.flaticon.com/512/9840/9840606.png" alt="rocket_contact"/>
            </div>
            <form action="{{route('contactanos.store')}}" method="POST">
                @csrf
                <h3>Dejanos un Mensaje !</h3>
                @if(session("correcto"))
                    <div class="alert alert-success">{{session("correcto")}}</div>
                @endif
                @if(session("incorrecto"))
                    <div class="alert alert-danger">{{session("incorrecto")}}</div>
                @endif
               <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <input type="text" name="instname" class="form-control" placeholder="Nombre de la Institución Educativa*" value="" />
                            @error('instname')
                                <p><strong>{{$message}}</strong></p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <input type="text" name="name" class="form-control" placeholder="Nombre y apellido del Representante*" value="" />
                            @error('name')
                                <p><strong>{{$message}}</strong></p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <input type="text" name="correo" class="form-control" placeholder="Correo electrónico *" value="" />
                            @error('correo')
                                <p><strong>{{$message}}</strong></p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <input type="text" name="telefono" class="form-control" placeholder="Número de teléfono *" value="" />
                            @error('telefono')
                                <p><strong>{{$message}}</strong></p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <input type="text" name="direccion" class="form-control" placeholder="Dirección *" value="" />
                            @error('direccion')
                                <p><strong>{{$message}}</strong></p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <a href="{{route("bienvenida")}}" class="btn btn-secondary btnBack float-right">Volver</a>
                        </div>
                        
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <textarea name="mensaje" class="form-control" placeholder="Detalles (opcional) *" style="width: 100%; height: 83%;"></textarea>
                        </div>
                        @error('mensaje')
                            <p><strong>{{$message}}</strong></p>
                        @enderror
                        <div class="form-group">
                            <input type="submit" name="" class="btnContact" value="Enviar mensaje" />
                        </div>
                    </div>
                </div>
            </form>
</div>