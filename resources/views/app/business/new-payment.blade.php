@extends('blades.app')

@section('title', 'Nueva Mensualidad - Negocio ' . $obj->name )

@section('css')
@endsection

@section('content')

<h5><a href="{{ url('app/negocios') }}">Negocios </a> / <a href="../{{ $obj->id }}">Negocio {{ $obj->name }}</a> / Nueva Mensualidad</h5>

<form class="row" role="form" method="POST" enctype="multipart/form-data" >
    {{ csrf_field() }}

    <div class="form-group col l6">
        <label for="exampleInputEmail1">Monto: </label>
        <input type="number" name="amount" value="{{old('amount')}}" class="materialize-textarea" placeholder="Pago de mensualidad" required>
    </div>  
  
    <div class="form-group col l6">
        <label for="exampleInputEmail1">Día de pago: </label>
        <input type="number" value="@if(old('date_to_pay')) {{old('date_to_pay')}}@else 15 @endif" name="date_to_pay"  class="materialize-textarea" placeholder="Se establece el día del mes que se realizara el pago" max="28" min="1" required>
    </div>  

    <div class="col l12"><br>
        <button type="submit" class="btn blue">Nueva Mensualidad</button>
    </div>
</form>

 @endsection