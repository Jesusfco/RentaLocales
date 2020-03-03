@extends('blades.app')

@section('title', 'Crear Tipo de Articulo')

@section('css')
@endsection

@section('content')

<h5><a href="{{ url('app/articles/types') }}">Tipos de Articulos</a> >> Crear </h5>

<form role="form" method="POST" enctype="multipart/form-data" >
    {{ csrf_field() }}

    <div class="form-group">
      <label for="exampleInputEmail1">Titulo</label>
      <input type="text" name="name" class="form-control"  placeholder="Tipo de Articulo" required>
    </div>

    <div class="form-group">
      <label for="exampleInputPassword1">Descripción</label>
      <input type="text" name="description" class="form-control"  placeholder="Escribe brevemente de que se trara" required>
    </div>

    <div class="form-group">
        <label>Imagen</label>
        <input type="file" name="img" id="imagen" accept="image/x-png,image/gif,image/jpeg" required>

        <p class="help-block">Cargue una fotografía</p>
    </div>

    <button type="submit" class="btn btn-default">Crear </button>
</form>

@endsection

@section('scripts')
@endsection