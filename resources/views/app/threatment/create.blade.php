@extends('blades.app')

@section('title', 'Crear Trabajo')

@section('css')
@endsection

@section('content')
<h5><a href="{{ url('app/tratamientos') }}">Tratamientos </a> >> Crear Tratamiento</h5>


<form role="form" method="POST" enctype="multipart/form-data" onsubmit="return submitForm()">
    {{ csrf_field() }}

    <div class="form-group">
      <label for="exampleInputEmail1">Nombre</label>
    <input type="text" name="name" class="form-control" value="{{ old('name') }}"  placeholder="Nombre del Tratamiento" required>
    </div>

    <div class="form-group">
      <label>Resumen</label>
      <input type="text" minlength="100" maxlength="190" name="resume" class="form-control" id="inputResume" value="{{ old('resume') }}" placeholder="Escribe brevemente en que consiste el tratamiento" required>
      <span class="helper-text" data-error="wrong" data-success="right" id="counterInputResume">100-190 caracterest: 0</span>
    </div>

    <div class="form-group">
      <label>Estado</label>
      <div class="switch">
        <label>
          Desactivado
          <input type="checkbox" checked name="active">
          <span class="lever"></span>
          Activo
        </label>
      </div>
      <span class="helper-text">Cuando se encuentra en estado activo, este sera mostrado a los visitantes</span>
    </div>
               
    <div class="file-field input-field">
      <img id="imgForm" width="200px"><br>
      <div class="btn blue">
        <span>Imagen</span>
        <input type="file" name="img" id="imagenInput"  accept="image/x-png,image/gif,image/jpeg" required>
      </div>
      <div class="file-path-wrapper">
        <input class="file-path validate" type="text">
      </div>
    </div>              
            
    <label>Redacta tu Tratamiento</label>
    <textarea name="editor1" id="editor1" rows="10" cols="80">{{old('description')}}</textarea>
    <input type="hidden" class="contenidoNota" name="description" required>            
    <br>
    <button type="submit" class="btn blue">Crear Nuevo Tratamiento</button>
  </form>

@endsection

@section('scripts')
<script src="//cdn.ckeditor.com/4.7.3/standard/ckeditor.js"></script>
<script>
    
    $('#inputResume').keyup(function(){

      $('#counterInputResume').html("100-190 caracteres: " + $('#inputResume').val().trim().length)
    })

    $('#imagenInput').change(()=> {
      var input = document.getElementById('imagenInput').files[0];
      let reader = new FileReader();
        reader.onload = function(e) {
          //  e.target.result;
          $('#imgForm').attr('src',e.target.result);
        };

        reader.readAsDataURL(input);
    })

    CKEDITOR.replace( 'editor1' );
    function submitForm() {
      var data = CKEDITOR.instances.editor1.getData();
      $('.contenidoNota').val(data);

      if(data.length < 100) {
        M.toast({html: 'Se quiere de 100 caracteres minimo en la descripción del tratamiento', classes: 'red', displayLength: 6500})        
        return false;
      }
      // return false;
    }
</script>
@endsection