@extends('blades.app')

@section('title', 'Patologías')

@section('css')
<link rel="stylesheet" type="text/css" href="https://code.jquery.com/ui/1.9.1/themes/smoothness/jquery-ui.css">
@endsection

@section('content')
    <h5>Tratamientos Relacionados >> {{ $obj->name}}</h5>

    <div id="app2">
        <input type="search" id="searchThreathment" placeholder="Busque un tratamiento para enlazar">
        {{ csrf_field() }}
        
      <table>
        <thead>
          <tr>
              <th>Nombre de Tratamiento</th>
              <th>Opciones</th>
              
          </tr>
        </thead>

        <tbody>
          <tr v-for="obj in threaments">
            <td>@{{ obj.name }}</td>
            <td>
                <button class="red btn" v-on:click="deleteThreatment(obj)">Eliminar</button>
            </td>            
          </tr>
        </tbody>
    </table>

    </div>
    
@endsection

@section('scripts')
<script src="https://code.jquery.com/ui/1.9.1/jquery-ui.min.js" ></script>  
<script>

var app2 = new Vue({
        el: '#app2',

        data: {
            pathology: {
                id: {{ $obj->id }},                               
                name: "{{ $obj->name }}",  
            },                        
            threaments: [],            
        },
        methods: {
            deleteThreatment: function(obj) {
                
                swal({
                    title: 'Eliminación de Relacion',
                    text: "¿Estas seguro de eliminar esta relación con " + obj.name + " ? " ,
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#b60909",
                    confirmButtonText: "Eliminar",
                    closeOnConfirm: false,
                    showLoaderOnConfirm: true,
                    allowEscapeKey: true,
                    allowOutsideClick: true
                },
                () => {

                    let actualUrl = window.location.href;

                    $.ajax({
                        type: "GET",
                        url: actualUrl + "/delete/" + obj.id,
                        async: true,

                        success: (data) =>{
                            
                            setTimeout(function() {
                                swal({
                                    title: "Registro Eliminado",
                                    text: "El Registro ha sido eliminado",
                                    timer: 1500,
                                    type: 'success',
                                    showConfirmButton: false,
                                    allowEscapeKey: true,
                                    allowOutsideClick: true
                                });
                            });
                                                        
                            for(let x = 0; x < app2.threaments.length; x++) {
                                if(obj.id == app2.threaments[x].id) {                                    
                                    app2.threaments.splice(x,1);
                                    break;
                                }
                            }
                        },
                        error: function(xhr, ajaxOptions, thrownError) {
                                //                                alert(xhr.status);
                                //                                alert(thrownError);
                                setTimeout(function() {
                                    swal({
                                        title: "Error: " + thrownError,
                                        text: "No se ha podido eliminar el registro",
                                        timer: 3000,
                                        type: 'error',
                                        showConfirmButton: false,
                                        allowEscapeKey: true,
                                        allowOutsideClick: true
                                    });
                                });
                            } //Error
                    }); //AJAX
                }); //swal

            }
        }
    })

$(document).ready(function() {     
    
    $.ajax({
        method: 'GET',
        url: actualUrl + "/getTratamientos",
        dataType: "json",
        // data: {term: request.term },
        success: function(data) {                                                                        
            console.log(data);
            for(let d of data) {
                app2.threaments.push(d.threatment)
            }
        }

    });
    
    $('#searchThreathment').autocomplete({

    source: function(request, response) {
        $.ajax({
        method: 'GET',
        url: actualUrl + "/sugestThreatments",
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

        for(let d of app2.threaments) {
            if(d.id == x.id){
                alert('Este tratamiento ya se encuentra relacionado');
                return;
            }
        }

        $.ajax({
            type: "POST",
            url: actualUrl + "/new",
            async: true,
            data: {
                id: x.id,
                _token: $('input[name=_token]').val()
            },
            success: function(data) { 

                $("#searchThreathment").val('');
                app2.threaments.push(x)
                swal({
                    title: 'Tratamiento Relacionado',
                    text: "El tratamiento " + x.name + " se ha enlazado correctamente " ,
                    type: "success",
                    timer: 3000,
                    // type: 'error',
                    showConfirmButton: false,
                    allowEscapeKey: true,
                    allowOutsideClick: true
                });

            }
        });
        

    }

});
})
</script>
@endsection