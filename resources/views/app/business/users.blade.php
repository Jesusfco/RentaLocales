@extends('blades.app')

@section('title', 'Recibops - ' . $obj->name )

@section('css')
@endsection

@section('content')

    <h5><a href="{{ url('app/negocios') }}">Negocios </a> / <a href="../{{ $obj->id }}">Negocio {{ $obj->name }}</a> / Recibos</h5>

    <table class="striped responsive-table">
        <thead>
            {{-- <th>ID</th> --}}
            <th>Usuario</th>            
            <th>Télefono 1</th>                        
            <th>Télefono 2</th>                        
            <th>Correo</th>
            <th>Opciones</th>
        </thead>
        <tbody>

        {{-- recibos --}}
        @foreach($objects as $n)
        
            <tr id="id{{$n->id}}">                            
                <td><a href="{{ url('app/usuarios/ver', $n->user->id) }}">
                    #{{ $n->user->name }}</a>
                </td>
                <td>{{ $n->user->phone1 }}</td>
                <td>{{ $n->user->phone2 }}</td>            
                <td>{{ $n->user->email }}</td>
                <td>
                    <a onclick="eliminar({{ $n->user_id }}, '{{ $n->user->name }}')" class="btn red"> Eliminar</a>                
                </td>
            </tr>
            
        @endforeach

        </tbody>
        
    </table>

    {{ $objects->links() }}
@endsection