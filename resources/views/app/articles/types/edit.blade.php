@extends('blades.app')

@section('title', 'Editar Tipo de Articulo')

@section('css')
@endsection

@section('content')

<h5><a href="{{ url('app/articles/types') }}">Tipos de Articulos</a> >> Editar >> {{ $obj->name}} </h5>

<img src="{{ $obj->getImgLink()}}" width="50%;" id="img">

<form role="form" method="POST" enctype="multipart/form-data" >
    {{ csrf_field() }}

    <div class="form-group">
      <label for="exampleInputEmail1">Titulo</label>
    <input type="text" name="name" class="form-control"  placeholder="Tipo de Articulo" value="{{ $obj->name }}" required>
    </div>

    <div class="form-group">
      <label for="exampleInputPassword1">Descripción</label>
      <input type="text" name="description" class="form-control" value="{{ $obj->description }}"  placeholder="Escribe brevemente de que se trara" required>
    </div>

    <div class="form-group">
        <label>Imagen</label>
        <input type="file" name="img" id="files" onchange="setImg()" accept="image/x-png,image/gif,image/jpeg" >

        <p class="help-block">Cargue una fotografía</p>
    </div>

    <button type="submit" class="btn btn-default">Actualizar </button>
</form>

@endsection

@section('scripts')
<script>

var imgFormats =  ['image/png', 'image/jpeg', 'image/jpg'];
function setImg() {
    var input = document.getElementById('files');
    var momentFiles = input.files;
    
    if (!this.validateImageFile(momentFiles[0].type)) return;
      

    let reader = new FileReader();
    reader.onload = function(e) {
        let imgShow = document.getElementById('img');
        imgShow.src = e.target.result;

    };

    reader.readAsDataURL(momentFiles[0]  );

}

function validateImageFile(type) {
    let validation = false;

    for (let i of imgFormats) {
        if (i == type) {
            validation = true;
            break;
        }
    }
    return validation;
}
</script>
@endsection