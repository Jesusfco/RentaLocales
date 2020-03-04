@extends('blades.app')

@section('title', 'Negocios - Crear Negocio')

@section('css')
@endsection

@section('content')
<h5><a href="{{ url('app/negocios') }}">Negocios </a> >> Crear Negocio</h5>


<form class="row" role="form" method="POST" enctype="multipart/form-data" >
    {{ csrf_field() }}

    <div class="form-group col l6 s12">
      <label for="exampleInputEmail1">Nombre de Negocio: </label>
      <input type="text" name="name" class="form-control" value="{{ old('name') }}"  placeholder="Tienda Pancho" required>
    </div>

    <div class="form-group col l6 s12">
      <label for="exampleInputEmail1">Tipo de Negocio: </label>
      <input type="text" name="type" class="form-control" value="{{ old('type') }}"  placeholder="Comida - Abarrotes - Ropa - Servicios">
    </div>

    <div class="form-group col l12">
      <label for="exampleInputEmail1">Descripción: </label>
      <textarea type="text" name="description"  class="materialize-textarea" placeholder="Descripción del local">{{ old('description') }}</textarea>
    </div>  

    <div class="form-group col l6">
      <label for="exampleInputEmail1">Monto: </label>
      <input type="number" name="amount" value="{{old('amount')}}" class="materialize-textarea" placeholder="Descripción del local" required>
    </div>  

    <div class="form-group col l6">
      <label for="exampleInputEmail1">Día de pago: </label>
    <input type="number" value="@if(old('date_to_pay')) {{old('date_to_pay')}}@else 15 @endif" name="date_to_pay"  class="materialize-textarea" placeholder="Descripción del local" max="28" min="1" required>
    </div>  
         
    <div class="col l12"><br>
      <button type="submit" class="btn blue">Crear Nuevo Negocio</button>
    </div>

  </form>

@endsection

@section('scripts')

@endsection