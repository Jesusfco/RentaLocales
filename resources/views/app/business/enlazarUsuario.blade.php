@extends('blades.app')

@section('title', 'Enlazar Local-Negocio')

@section('css')
    <link rel="stylesheet" type="text/css" href="https://code.jquery.com/ui/1.9.1/themes/smoothness/jquery-ui.css">
@endsection

@section('content')

    <h5><a href="{{ url('app/negocios') }}">Negocios </a> / 
        <a href="./">{{$obj->name }}</a> / 
        <a href="./usuarios">Usuarios</a> /
        Enlazar Usuario
    </h5>

    <form class="row" role="form" method="POST" onsubmit="return checkForm()">
        {{ csrf_field() }}
    
        <div class="form-group col l6 s12">
          <label for="exampleInputEmail1">Nombre de Usuario: </label>
          <input id="search" type="text" name="name" class="form-control" value="{{ old('name') }}"  placeholder="Nombre de usuario" required autofocus>

          <input id="targetId" type="hidden" name="targetId" >
        </div>
                     
        <div class="col l12"><br>
          <button type="submit" class="btn blue">Enlazar Con Usuario</button>
        </div>

      </form>
    
@endsection

@section('scripts')
<script src="https://code.jquery.com/ui/1.9.1/jquery-ui.min.js" ></script>  
<script>

function checkForm() {
    if(($("#targetId").val() + "").length > 0) return true;
    alert('Porfavor selecciones una sugerencia de los usuarios')
    return false
}
$(document).ready(function() {          
    
    $('#search').autocomplete({

    source: function(request, response) {
        $.ajax({
        method: 'GET',
        url: window.location.origin + "/app/sugest/locals",
        dataType: "json",
        data: {term: request.term },
        success: function(data) {                                                                        
            response(data);
        }

        });                               
    },               
    select: function(event, ui) {                      
        
        var x = {
            id: ui.item.data,
            name: ui.item.value,
        }

        $("#targetId").val(x.id)
        $("#search").val(x.name)

    }

});
})
</script>
@endsection