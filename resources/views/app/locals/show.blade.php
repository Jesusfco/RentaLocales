@extends('blades.app')

@section('title', 'Editar Trabajo')

@section('css')
@endsection

@section('content')

<h5><a href="{{ url('app/locales') }}">Locales </a> / Ver Local {{ $obj->number }}</h5>

<div>
  <a class="btn" href="{{ url('app/locales/edit', $obj->number)}}">Editar</a>    
  <a class="btn" href="{{ url()->current() . "/historial-negocios" }}">Historial Negocios</a>    
  <a class="btn" href="{{ url()->current() . "/asignar-negocio" }}">Asignar Negocio</a>    
</div>

<div class="row ">
    
    <div class="col l12 s12">

        <div class="form-group col l6 s12">            
            <p disabled>Numero de Local: #{{ $obj->number }}</p>
          </div>
          <div class="form-group col l6 s12">            
            <p>Descripción: {{ $obj->description }}</p>
          </div>
          <div class="form-group col l6 s12">            
            <p>Estatus: {!! $obj->statusView() !!}</p>
          </div>
          

    </div>
</div>

    

   
@endsection

@section('scripts')