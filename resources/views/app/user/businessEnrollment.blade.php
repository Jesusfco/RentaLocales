@extends('blades.app')

@section('title', 'Enlazar Negocio-Usuario')

@section('css')
    <link rel="stylesheet" type="text/css" href="https://code.jquery.com/ui/1.9.1/themes/smoothness/jquery-ui.css">
@endsection

@section('content')

    <h5><a href="{{ url('app/usuarios') }}">Usuarios </a> / 
        <a href="./">{{$obj->fullname() }}</a> / 
        <a href="./negocios">Negocios</a> /
        Enlazar
    </h5>

    <form class="row" role="form" method="POST" onsubmit="return checkForm()">
        {{ csrf_field() }}
    
        <div class="form-group col l6 s12">
          <label for="exampleInputEmail1">Nombre de Negocio: </label>
          <input id="search" type="text" name="name" class="form-control" value="{{ old('name') }}"  placeholder="Nombre de negocio" required autofocus>

          <input id="business_id" type="hidden" name="business_id" >
        </div>
                     
        <div class="col l12"><br>
          <button type="submit" class="btn blue">Enlazar Negocio</button>
        </div>

      </form>
    
@endsection

@section('scripts')
<script src="https://code.jquery.com/ui/1.9.1/jquery-ui.min.js" ></script>  
<script>

function checkForm() {
    if(($("#business_id").val() + "").length > 0) return true;
    alert('Porfavor selecciones una sugerencia de los negocios')
    return false
}
$(document).ready(function() {          
    
    $('#search').autocomplete({

    source: function(request, response) {
        $.ajax({
        method: 'GET',
        url: window.location.origin + "/app/sugest/business",
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

        $("#business_id").val(x.id)
        $("#search").val(x.name)

    }

});
})
</script>
@endsection