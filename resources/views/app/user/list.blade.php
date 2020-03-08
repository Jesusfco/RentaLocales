@extends('blades.app')

@section('title', 'Usuarios')

@section('css')
@endsection

@section('content')

<h5>Usuarios >> Lista</h5>
<a href="{{ url('app/usuarios/create') }}"><button class="btn">Crear Usuario</button></a>

<form method="GET" class="navbar-form">
        <div class="input-field">
            <i class="material-icons prefix">search</i>
            <input name="term" type="search" value="{{ request('term')}}" class="form-control" autofocus>
            <label>Buscar Usuario</label>
        </div>
   </form> 

   <table class="striped responsive-table">
        <thead>
            {{-- <th>ID</th> --}}
            <th>Nombre</th>            
            <th>Correo</th>            
            <th>Teléfono 1</th>
            <th>Tipo</th>            
            <th>Acciones</th>
        </thead>
        <tbody>
        @foreach($objects as $n)
        
        <tr id="id{{$n->id}}">            
            <td>{{ $n->fullname() }}</td>
            <td>{{ $n->email }}</td>
            <td>{{ $n->phone1 }}</td>            
            <td>{{ $n->type() }}</td>            
            
            <td>
                
                <a href="{{ url('app/usuarios/edit/'.$n->id.'') }}" class="btn yellow">Editar </a>
                <a  onclick="eliminar({{ $n->id }}, '{{ $n->name }}')" class="btn red"> Eliminar</a>
                <a href="{{ url('app/usuarios/ver', $n->id) }}" class="btn green">Ver</a>
            </td>
        </tr>
        
        @endforeach
    </tbody>
    </table>

    {{ $objects->links() }}
@endsection

@section('scripts')

@endsection