@extends('layouts.plantillabase')

@section('contenido')

<a href="persona/create" type="button" class=" btn btn-dark">Crear persona</a>

<table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">nombre</th>
      <th scope="col">apellidopaterno</th>
      <th scope="col">apellidomaterno</th>
      <th scope="col">CI</th>
      <th scope="col">Direccion</th>
    </tr>
  </thead>
  <tbody>
  
    @foreach ($persona as $perso)
 
    <tr>
      <th scope="row">{{$perso->idpersona}}</th>
      <td>{{$perso->nombre}}</td>
      <td>{{$perso->apellidopaterno}}</td>
      <td>{{$perso->apellidomaterno}}</td>
      <td>{{$perso->ci}}</td>
      <td>{{$perso->direccion}}</td>
      <td>
       
        <form action="{{route('persona.destroy',$perso->idpersona)}}" method="POST">
            
            <a href="/persona/{{$perso->idpersona}}/edit" class="btn btn-info">Editar</a>
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Eliminar</button>
            
        </form>
  
      
      </td>
    </tr>
    @endforeach
  </tbody>
</table>

@endsection