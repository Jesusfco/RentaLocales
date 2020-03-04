@extends('blades.app')

@section('title', 'Locales - Crear Local')

@section('css')
@endsection

@section('content')
<h5><a href="{{ url('app/locales') }}">Locales </a> >> Crear Local</h5>


<form class="row" role="form" method="POST" enctype="multipart/form-data" >
    {{ csrf_field() }}

    <div class="form-group col l4 s12">
      <label for="exampleInputEmail1">Numero de Local: </label>
      <input type="number" name="number" class="form-control" value="{{ old('number') }}"  placeholder="" required>
    </div>
    <div class="form-group col l12">
      <label for="exampleInputEmail1">Descripción: </label>
      <textarea type="text" name="description"  class="materialize-textarea" value="{{ old('description') }}"  placeholder="Descripción del local"></textarea>
    </div>
    
    
         
    <div class="col l12"><br>
      <button type="submit" class="btn blue">Crear Nuevo Local</button>
    </div>
  </form>

@endsection

@section('scripts')

@endsection