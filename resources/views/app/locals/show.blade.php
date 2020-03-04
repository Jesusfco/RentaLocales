@extends('blades.app')

@section('title', 'Editar Trabajo')

@section('css')
@endsection

@section('content')

<h5><a href="{{ url('app/locales') }}">Locales </a> / Ver Local {{ $obj->number }}</h5>

<div>
  <a class="btn" href="{{ url()->current() . "/historial-negocios" }}">Historial Negocios</a>    
</div>

<div class="row ">
    
    <div class="col l12 s12">

        <div class="form-group col l12">
            <label for="exampleInputEmail1">Numero de Local: </label>
            <h3 disabled>#{{ $obj->number }}</h3>
          </div>
          <div class="form-group col l12">
            <label for="exampleInputEmail1">Descripción: </label>
            <p>{{ $obj->description }}</p>
          </div>
          

    </div>
</div>

    

   
@endsection

@section('scripts')