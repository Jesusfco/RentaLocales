@extends('blades.app')

@section('title', $receipt->description())

@section('css')
@endsection

@section('content')

<h5><a href="{{ url('app/recibos') }}">Recibos </a> / {{ $receipt->description() }}</h5>

<div class="row ">
    
    <div class="col l12 s12">

        <div class="form-group col l6 s12">            
            <p disabled>Folio: #{{ $receipt->id }}</p>
          </div>
        <div class="form-group col l6 s12">            
            <p disabled>Creador: <a href="{{ url('app/usuarios/ver', $receipt->creator_id) }}">
              {{ $receipt->creator->fullname() }}</a>
            </p>
          </div>
          <div class="form-group col l6 s12">            
            <p disabled>Negocio: 
              <a href="{{ url('app/negocios/ver', $receipt->business_id) }}">
                {{ $receipt->business->name }}</a>
              </p>
          </div>
          <div class="form-group col l6 s12">            
            <p>Fecha y Hora de creación: {!! $receipt->created_at !!}</p>
          </div>
          <div class="form-group col l12 s12">            
            <p>Descripción: {{ $receipt->description() }}</p>
          </div>
          
          

    </div>
</div>

    

   
@endsection

@section('scripts')