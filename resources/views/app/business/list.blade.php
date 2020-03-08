@extends('blades.app')

@section('title', 'Negocios - Lista')

@section('css')
@endsection

@section('content')

<h5>Negocios / Lista </h5>
<a href="{{ url('app/negocios/create') }}"><button class="btn">Crear Negocio</button></a>

<form method="GET" class="navbar-form">
        <div class="input-field">
            <i class="material-icons prefix">search</i>
            <input name="term" type="search" value="{{ request('term')}}" class="form-control" autofocus>
            <label>Buscar Negocio</label>
        </div>
   </form> 

   <table class="striped responsive-table">
        <thead>
            {{-- <th>ID</th> --}}
            <th>Nombre</th>            
            <th>Tipo</th>            
            <th>Dueño/s</th>
            <th>Local/es</th>
            {{-- <th>Tipo</th>             --}}
            <th>Acciones</th>
        </thead>
        <tbody>
        @foreach($objects as $n)
        
        <tr id="id{{$n->id}}">            
            <td>{{ $n->name }}</td>
            <td>{{ $n->type }}</td>
            <td>{{ "" }}</td>            
            <td>{{ "" }}</td>            
            
            
            <td>
                
                <a href="{{ url('app/negocios/edit/'.$n->id.'') }}" class="btn yellow">Editar </a>
                <a  onclick="eliminar({{ $n->id }}, '{{ $n->name }}')" class="btn red"> Eliminar</a>
                <a href="{{ url('app/negocios/ver', $n->id) }}" class="btn green">Ver</a>
            </td>
        </tr>
        
        @endforeach
    </tbody>
    </table>

    {{ $objects->links() }}
    
@endsection

@section('scripts')

@endsection