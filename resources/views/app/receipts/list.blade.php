@extends('blades.app')

@section('title', 'Locales - Lista')

@section('css')
@endsection

@section('content')

<h5>Recibos / Lista</h5>
<a href="{{ url('app/recibos/create') }}"><button class="btn blue">Crear Recibo</button></a>

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
            <th>Negocio</th>            
            <th>Monto</th>            
            <th>Descripción</th>                        
            <th>Acciones</th>
        </thead>
        <tbody>
        @foreach($receipts as $n)
        
        <tr id="id{{$n->id}}">            
            <td><a href="{{ url('app/negocios/ver/', $n->business_id) }}"> {{ $n->business->name }}</a></td>
            <td>${{ $n->amount }}</td>
            <td>{{ $n->description() }}</td>            
            <td>
                
                {{-- <a href="{{ url('app/recibos/edit', $n->id) }}" class="btn yellow">Editar </a> --}}
                <a  onclick="eliminar({{ $n->id }}, '{{ $n->description() }}')" class="btn red"> Eliminar</a>
                <a href="{{ url('app/recibos/ver', $n->id) }}" class="btn green">Ver</a>
            </td>
        </tr>
        
        @endforeach
    </tbody>
    </table>

    {{ $receipts->links() }}
@endsection

@section('scripts')

@endsection