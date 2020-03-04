@extends('blades.app')

@section('title', 'Negocios - Ver Negocio ' . $obj->name )

@section('css')
@endsection

@section('content')

<h5><a href="{{ url('app/negocios') }}">Negocios </a> / Ver Negocio {{ $obj->name }}</h5>

<div>
  <a class="btn" href="{{ url()->current() . "/historial-recibos" }}">Historial recibos</a>    
  <a class="btn" href="{{ url()->current() . "/mensualidades" }}">Historial Pagos Mensuales</a>    
  <a class="btn" href="{{ url()->current() . "/nueva-mensualidad" }}">Establecer Nuevo Pago Mensual</a>    
</div>

<div class="row ">
    
    <div class="col l12 s12">

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
          

          

    </div>
</div>

    

   
@endsection

@section('scripts')