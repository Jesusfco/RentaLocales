@extends('blades.app')

@section('title', 'Editar Trabajo')

@section('css')
@endsection

@section('content')

<h5><a href="{{ url('app/usuarios') }}">Usuarios </a> >> Editar usuario</h5>


<form class="row" role="form" method="POST" enctype="multipart/form-data" onsubmit="return submitForm()">
    {{ csrf_field() }}

    <div class="form-group col l6">
      <label for="exampleInputEmail1">Nombre</label>
      <input type="text" name="name" class="form-control" value="{{ $obj->name }}"  placeholder="Nombre" required>
    </div>
    <div class="form-group col l6">
      <label for="exampleInputEmail1">A. Paterno</label>
      <input type="text" name="patern" class="form-control" value="{{ $obj->patern }}"  placeholder="Apellido Paterno">
    </div>
    <div class="form-group col l6">
      <label for="exampleInputEmail1">A. Materno</label>
      <input type="text" name="matern" class="form-control" value="{{ $obj->matern }}"  placeholder="Apellido Materno">
    </div>
    <div class="form-group col l6">
      <label for="exampleInputEmail1">Correo</label>
      <input type="email" name="email" class="form-control" value="{{ $obj->email }}"  placeholder="Nombre">
    </div>
    <div class="form-group col l6">
      <label for="exampleInputEmail1">Teléfono 1</label>
      <input type="tel" name="phone1" class="form-control" value="{{ $obj->phone1 }}"  placeholder="123 - 122 - 1222">
    </div>
    <div class="form-group col l6">
      <label for="exampleInputEmail1">Teléfono 2</label>
      <input type="tel" name="phone2" class="form-control" value="{{ $obj->phone2 }}"  placeholder="123 - 122 - 1222">
    </div>

    <div class="form-group col l6">
      <label for="exampleInputEmail1">Contraseña</label>
      <input type="password" name="password" class="form-control" value=""  placeholder="**********">
    </div>

    

    <div class="form-group col l6">
      <label>Tipo de Usuario</label>
      <select name="user_type" class="browser-default">        
         
        <option value="1" @if($obj->user_type == 1) selected @endif>Arrendatario</option>        
        <option value="9" @if($obj->user_type == 9) selected @endif>Arrendador</option>        
      </select>
    </div>
    
         
    <div class="col l12"><br>
      <button type="submit" class="btn blue">Actualizar Usuario</button>
    </div>
  </form>

@endsection

@section('scripts')
<script src="//cdn.ckeditor.com/4.7.3/standard/ckeditor.js"></script>
<script>    

    $('#imagenInput').change(()=> {
      var input = document.getElementById('imagenInput').files[0];
      $('#imgForm').attr('src',"algo");
      let reader = new FileReader();
        reader.onload = function(e) {
          //  e.target.result;
          
          $('#imgForm').attr('src',e.target.result);
          console.log(e.target.result)
        };

        reader.readAsDataURL(input);
    })

    
</script>
@endsection