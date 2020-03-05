@extends('blades.app')

@section('title', 'Negocios - Ver Negocio ' . $obj->name )

@section('css')
@endsection

@section('content')

<h5><a href="{{ url('app/negocios') }}">Negocios </a> / {{ $obj->name }}</h5>

<div>
  <a class="btn" href="{{ url()->current() . "/historial-recibos" }}">Historial recibos</a>    
  <a class="btn" href="{{ url()->current() . "/mensualidades" }}">Historial Pagos Mensuales</a>    
  <a class="btn" href="{{ url()->current() . "/nueva-mensualidad" }}">Establecer Nuevo Pago Mensual</a>    
</div>

<div class="row "> 

  <div class="form-group col l12 s12">
      <label for="exampleInputEmail1">Nombre de Negocio: </label>
      <h4>{{ $obj->name }}</h4>
    </div>
    <div class="form-group col l6 s12">
      <label for="exampleInputEmail1">Tipo: </label>
      <h5>{{ $obj->type }}</h5>
    </div>
    <div class="form-group col l6">
      <label for="exampleInputEmail1">Descripción: </label>
      <p>{{ $obj->description }}</p>
      <br><br>
    </div>

    <div class="form-group col l6">
      <label for="exampleInputEmail1">Mensualidad: </label>
      <p>${{ $obj->currentMonthly->amount }}</p>
    </div>

    <div class="form-group col l6">
      <label for="exampleInputEmail1">Día de pago: </label>
      <p>{{ $obj->currentMonthly->date_to_pay }}</p>
    </div>
          

    <div class="col l6">
      <h5>Usuario Enlazados</h5>
      
      <div class="collection">
        @foreach($obj->users as $user)
        <a href="{{ url('app/usuarios/ver/' . $user->id)}}" class="collection-item">{{ $user->fullname() }}</a>
        @endforeach
      </div>

      <a class="btn blue" href="{{url()->current()}}/enlazar-usuario">Enlazar con Usuario </a>

    </div>

    <div class="col l6">
      <h5>Locales Enlazados</h5>
      
      @if( count( $obj->locals ) > 0 )

      <div class="collection">
        @foreach($obj->locals as $local)
        <a href="{{ url('app/locales/ver/' . $local->id)}}" class="collection-item">{{ $local->number }}</a>
        @endforeach
      </div>

      @else 
      <p>No Tiene Locales Enlazados</p>
      @endif
      <a class="btn blue" href="{{url()->current()}}/enlazar-local">Enlazar con local </a>
    </div>
    
</div>

    

   
@endsection

@section('scripts')