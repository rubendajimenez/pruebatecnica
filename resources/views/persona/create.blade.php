@extends('layouts.plantillabase')

@section('contenido')
<form action="/persona" method="POST">

@csrf
        <div class="mb-3">
           <label for="" class="form-label">Nombre</label>
           <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre">
        </div>
        <div class="mb-3">
           <label for="" class="form-label">Apellido paterno</label>
           <input type="text" class="form-control" id="apellidopaterno" name="apellidopaterno" placeholder="Apellido paterno">
        </div>
        <div class="mb-3">
           <label for="" class="form-label">Apellido materno</label>
           <input type="text" class="form-control" id="apellidomaterno" name="apellidomaterno" placeholder="Apellido materno">
        </div>
        <div class="mb-3">
           <label for="" class="form-label">Ci</label>
           <input type="text" class="form-control" id="ci" name="ci" placeholder="CI">
        </div>
        <div class="mb-3">
           <label for="" class="form-label">Direccion</label>
           <input type="text" class="form-control" id="direccion" name="direccion" placeholder="Direccion">
        </div>
   
       <a href="/persona" class="btn btn-secondary" tabindex="5">Cancelar</a>
       <button type="submit" class="btn btn-primary" tabindex="4">Guardar</button>

</form>
@endsection