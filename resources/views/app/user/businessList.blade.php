@extends('blades.app')

@section('title', 'Negocios de '. $user->fullname() . ' - Lista')

@section('css')
@endsection

@section('content')

<h5><a href="{{ url('app/usuarios') }}">Usuarios </a> / <a href="./">{{$user->fullname() }}</a> / Negocios</h5>

<a href="./enlazar-negocio"><button class="btn">Enlazar Negocio</button></a>
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
            {{-- <th>Tipo</th>             --}}
            <th>Acciones</th>
        </thead>
        <tbody>
        @foreach($objects as $n)
        
        <tr id="id{{$n->id}}">            
            <td><a href="{{ url('app/negocios/ver', $n->id) }}">{{ $n->name }}</a></td>
            <td>{{ $n->type }}</td>
            <td>{{ "" }}</td>            
            
            
            <td>                                
                <a  onclick="eliminar({{ $n->id }}, '{{ $n->name }}')" class="btn red"> Eliminar Relación</a>                
            </td>
        </tr>
        
        @endforeach
    </tbody>
    </table>

    {{ $objects->links() }}
@endsection

@section('scripts')

@endsection