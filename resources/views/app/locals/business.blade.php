@extends('blades.app')

@section('title', 'Negocios Enlazados Historial - Local #' . $obj->number)

@section('css')
@endsection

@section('content')

<h5><a href="{{ url('app/locales') }}">Locales </a> / 
    <a href="./">Local {{ $obj->number }}</a> /
    Historial Negocios Enlazados
</h5>


{{-- <form method="GET" class="navbar-form">
    <div class="input-field">
        <i class="material-icons prefix">search</i>
        <input name="term" type="search" value="{{ request('term')}}" class="form-control" autofocus>
        <label>Buscar Negocio</label>
    </div>
</form>  --}}

<table class="striped responsive-table">
    <thead>
       
        <th>Nombre</th>            
        <th>Tipo</th>            
        <th>Periodo</th>       
        <th>Acciones</th>
    </thead>
    <tbody>
    @foreach($objects as $n)
    
    <tr id="id{{$n->business_id}}">            
        <td><a href=" {{url('app/negocios/ver', $n->business_id) }}">
            {{ $n->business->name }}</a></td>
        <td>{{ $n->business->type }}</td>
        <td>{{ $n->periodo() }}</td>            
        <td>
            <a onclick="eliminar({{ $n->business_id }}, '{{ $n->business->name }}')" class="btn red"> Eliminar Historial</a>            
        </td>
    </tr>
    
    @endforeach
</tbody>
</table>

@endsection