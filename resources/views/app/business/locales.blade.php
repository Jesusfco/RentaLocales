@extends('blades.app')

@section('title', 'Locales de ' . $obj->name)

@section('css')
    <link rel="stylesheet" type="text/css" href="https://code.jquery.com/ui/1.9.1/themes/smoothness/jquery-ui.css">
@endsection

@section('content')

    <h5><a href="{{ url('app/negocios') }}">Negocios </a> / 
        <a href="./">{{$obj->name }}</a> / 
         Locales   
    </h5>

    <table class="striped responsive-table">
        <thead>            
            <th>Numero</th>            
            <th>Descripción</th>                        
            <th>Acciones</th>
        </thead>
        <tbody>
            @foreach($obj->locals as $local)
            <tr id="id{{$local->number}}">            
                <td><a href="{{ url('app/locales/ver', $local->number) }}">#{{ $local->number }}</a></td>
                <td>{{ $local->description }}</td>            
                <td>
                    <a onclick="eliminar({{ $local->number }}, '{{ $local->number }}')" class="btn red"> Eliminar</a>                
                </td>
            </tr>
        
        @endforeach
    </tbody>
    </table>

    
    
@endsection