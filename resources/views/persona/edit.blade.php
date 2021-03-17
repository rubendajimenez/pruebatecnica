@extends('layouts.plantillabase')

@section('contenido')
<h2>Editar persona</h2>
<form action="/persona/{{$persona->idpersona}}" method="POST">

@csrf
@method('PUT')
        <div class="mb-3">
           <label for="" class="form-label">Nombre</label>
           <input type="text" class="form-control" id="nombre" name="nombre" value="{{$persona->nombre}}">
        </div>
        <div class="mb-3">
           <label for="" class="form-label">Apellido paterno</label>
           <input type="text" class="form-control" id="apellidopaterno" name="apellidopaterno" value="{{$persona->apellidopaterno}}">
        </div>
        <div class="mb-3">
           <label for="" class="form-label">Apellido materno</label>
           <input type="text" class="form-control" id="apellidomaterno" name="apellidomaterno" value="{{$persona->apellidomaterno}}">
        </div>
        <div class="mb-3">
           <label for="" class="form-label">Ci</label>
           <input type="text" class="form-control" id="ci" name="ci" value="{{$persona->ci}}">
        </div>
        <div class="mb-3">
           <label for="" class="form-label">Direccion</label>
           <input type="text" class="form-control" id="direccion" name="direccion" value="{{$persona->direccion}}">
        </div>
   
       <a href="/persona" class="btn btn-secondary" tabindex="5">Cancelar</a>
       <button type="submit" class="btn btn-primary" tabindex="4">Actualizar</button>

</form>
@endsection