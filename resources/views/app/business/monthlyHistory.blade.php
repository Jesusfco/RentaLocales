@extends('blades.app')

@section('title', 'Historial Mensualidades - ' . $business->name)

@section('css')
@endsection

@section('content')

<h5><a href="{{ url('app/negocios') }}">Negocios </a> / 
    <a href="./">Negocio {{ $business->name }}</a> / Historial Mensualidades</h5>

<a href="./nueva-mensualidad"><button class="btn">Actualizar Mensualidad</button></a>



   <table class="striped responsive-table">
        <thead>
            {{-- <th>ID</th> --}}
            <th>Monto</th>            
            <th>Día de pago</th>                        
            {{-- <th>Tipo</th>             --}}
            <th>Acciones</th>
        </thead>
        <tbody>
        @foreach($objects as $n)
        
        <tr id="id{{$n->id}}">            
            <td>${{ $n->amount }}</td>
            <td>{{ $n->date_to_pay }}</td>                     
            <td>                                
                <a  onclick="eliminar({{ $n->id }}, '{{ $n->name }}')" class="btn red"> Eliminar</a>                
            </td>
        </tr>
        
        @endforeach
    </tbody>
    </table>

    {{ $objects->links() }}
@endsection

@section('scripts')

@endsection