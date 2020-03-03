@extends('blades.app')

@section('title', 'Tratamientos')

@section('css')
@endsection

@section('content')

<h5>Tratamientos >> Lista</h5>
<a href="{{ url('app/tratamientos/create') }}"><button class="btn">Crear Tratamiento</button></a>

<form method="GET" class="navbar-form">
        <div class="input-field">
            <i class="material-icons prefix">search</i>
            <input name="term" type="search" value="{{ request('term')}}" class="form-control" autofocus>
            <label>Buscar Tratamiento</label>
        </div>
   </form> 

   <table class="striped responsive-table">
        <thead>
            {{-- <th>ID</th> --}}
            <th>Nombre</th>            
            <th>Resumen</th>            
            <th>Fecha-Creación</th>
            <th>Estado</th>
            <th>Acciones</th>
        </thead>
        <tbody>
        @foreach($objects as $n)
        
        <tr id="id{{$n->id}}">            
            <td>{{ $n->name }}</td>
            <td>{{ $n->resume }}</td>
            <td>{{ $n->created_at }}</td>
            <td>@if($n->active) Activo @else Suspendido @endif</td>
            <td>
                {{-- <a href="{{ url('app/articles/edit/'.$n->id.'/uploadPhotos') }}" class="btn purple">Administrar Fotos </a>                                 --}}
                <a href="{{ url('app/tratamientos/edit/'.$n->id.'') }}" class="btn yellow">Editar </a>
                <a  onclick="eliminar({{ $n->id }}, '{{ $n->name }}')" class="btn red"> Eliminar</a>
                <a href="{{ $n->getLink() }}" class="btn green">Ver</a>
            </td>
        </tr>
        
        @endforeach
    </tbody>
    </table>
@endsection

@section('scripts')

@endsection