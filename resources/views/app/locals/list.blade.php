@extends('blades.app')

@section('title', 'Locales - Lista')

@section('css')
@endsection

@section('content')

<h5>Locales / Lista</h5>
<a href="{{ url('app/locales/create') }}"><button class="btn orange">Crear Local</button></a>

{{-- <form method="GET" class="navbar-form">
        <div class="input-field">
            <i class="material-icons prefix">search</i>
            <input name="term" type="search" value="{{ request('term')}}" class="form-control" autofocus>
            <label>Buscar Local</label>
        </div>
   </form>  --}}

   <table class="striped responsive-table">
        <thead>
            {{-- <th>ID</th> --}}
            <th>Numero de Local</th>            
            <th>Descripción</th>            
            <th>Estatus</th>
            {{-- <th>Tipo</th>             --}}
            <th>Acciones</th>
        </thead>
        <tbody>
        @foreach($objects as $n)
        
        <tr id="id{{$n->number}}">            
            <td>{{ $n->number }}</td>
            <td>{{ $n->description }}</td>
            <td>{!! $n->statusView() !!}</td>
            {{-- <td>{{ $n-> }}</td>            
            <td>{{ $n-> }}</td>             --}}
            
            <td>
                
                <a href="{{ url('app/locales/edit/'.$n->number.'') }}" class="btn blue">Editar </a>
                <a href="{{ url('app/locales/ver', $n->number) }}" class="btn green">Ver</a>
                <a  onclick="eliminar({{ $n->number }}, '{{ $n->description }}')" class="btn red"> Eliminar</a>
            </td>
        </tr>
        
        @endforeach
    </tbody>
    </table>

    {{-- {{ $objects->links() }} --}}
@endsection

@section('scripts')

@endsection