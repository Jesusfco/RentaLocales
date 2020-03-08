@extends('blades.app')

@section('title', 'Recibos - ' . $obj->name )

@section('css')
@endsection

@section('content')

    <h5><a href="{{ url('app/negocios') }}">Negocios </a> / <a href="../{{ $obj->id }}">Negocio {{ $obj->name }}</a> / Recibos</h5>

    <table class="striped responsive-table">
        <thead>
            
            <th>Folio</th>            
            <th>Monto</th>            
            <th>Descripción</th>                        
            <th>Expedido</th>
        </thead>
        <tbody>

        {{-- recibos --}}
        @foreach($objects as $n)
        
            <tr id="id{{$n->id}}">                            
                <td><a href="{{ url('app/recibos/ver', $n->id) }}">
                    #{{ $n->id }}</a>
                </td>
                <td>${{ $n->amount }}</td>
                <td>{{ $n->description() }}</td>            
                <td>{{ $n->created_at }}</td>
                {{-- <td>
                    <a onclick="eliminar({{ $local->number }}, '{{ $local->number }}')" class="btn red"> Eliminar</a>                
                </td> --}}
            </tr>
            
        @endforeach

        </tbody>
        
    </table>

    {{ $objects->links() }}
@endsection