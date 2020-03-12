@extends('blades.app')

@section('title', 'Editar Trabajo')

@section('css')
@endsection

@section('content')

<h5><a href="{{ url('app/usuarios') }}">Usuarios </a> >> Ver usuario</h5>

<div>
  <a class="btn" href="{{ url('app/usuarios/edit', $obj->id) }}">Editar</a>
  <a class="btn" href="{{ url()->current() }}/negocios">Negocios</a>
  <a class="btn" href="{{ url()->current() }}/recibos">Recibos</a>
  <a class="btn" href="{{ url()->current() }}/direcciones">Direcciones</a>
</div>

<div class="row ">
    
    <div class="col l12 s12">

        <div class="form-group col l6">
            <label for="exampleInputEmail1">Nombre</label>
            <input type="text" name="name" class="form-control" value="{{ $obj->name }}"  placeholder="Nombre" disabled>
          </div>
          <div class="form-group col l6">
            <label for="exampleInputEmail1">A. Paterno</label>
            <input type="text" name="patern" class="form-control" value="{{ $obj->patern }}"  placeholder="Apellido Paterno" disabled>
          </div>
          <div class="form-group col l6">
            <label for="exampleInputEmail1">A. Materno</label>
            <input type="text" name="matern" class="form-control" value="{{ $obj->matern }}"  placeholder="Apellido Materno" disabled>
          </div>
          <div class="form-group col l6">
            <label for="exampleInputEmail1">Correo</label>
            <input type="email" name="email" class="form-control" value="{{ $obj->email }}"  placeholder="Nombre" disabled>
          </div>
          <div class="form-group col l6">
            <label for="exampleInputEmail1">Teléfono 1</label>
            <input type="tel" name="phone" class="form-control" value="{{ $obj->phone1 }}"  placeholder="123 - 122 - 1222" disabled>
          </div>
          <div class="form-group col l6">
            <label for="exampleInputEmail1">Teléfono 2</label>
            <input type="tel" name="phone" class="form-control" value="{{ $obj->phone2 }}"  placeholder="123 - 122 - 1222" disabled>
          </div>

         
          <div class="form-group col l6">
            <label for="exampleInputEmail1">Tipo usuario</label>
            <input type="tel" name="phone" class="form-control" value="{{ $obj->type() }}"  placeholder="123 - 122 - 1222" disabled>
          </div>

    </div>
</div>

    

   
@endsection

@section('scripts')