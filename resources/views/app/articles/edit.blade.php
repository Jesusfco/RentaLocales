@extends('blades.app')

@section('title', 'Editar Noticia')

@section('css')
@endsection

@section('content')

<h5><a href="{{ url('app/articles') }}">Noticias</a> >> Editar >> {{ $obj->name}} </h5>

<form role="form" method="POST" enctype="multipart/form-data" onsubmit="return crearNoticia()">
    {{ csrf_field() }}

    <div class="form-group">
      <label for="exampleInputEmail1">Titulo</label>
      <input type="text" name="name" class="form-control" value="{{ $obj->name }}"  placeholder="Titulo de la noticia" required maxlength="90">
    </div>

    <div class="form-group">
      <label for="exampleInputPassword1">Resumen</label>
      <input type="text" name="resume" value="{{ $obj->resume }}" class="form-control" minlength="80"  placeholder="Escribe brevemente de que se trara la noticia" required maxlength="180">
    </div>

    <div class="form-group">
      <label>Imagen</label>
      <input type="file" name="img" id="imagen" accept="image/x-png,image/gif,image/jpeg">
      <p class="help-block">Cargue una fotografía de la noticia</p>
    </div>            
        
    <div class="form-group">
      <label>Fecha</label>
      <input type="date" value="{{ $obj->date }}" name="date" class="form-control" required>
    </div>
    
    {{-- <div class="input-field col l12 s12">
        <select name="article_type_id" required>            
            @foreach($types as $n)
            <option value="{{$n->id}}" >{{$n->name}}</option>
            @endforeach
        </select>
        <label>Tipo de articulo</label>
    </div>
    <br> --}}
                    
            
    <label>Redacta tu trabajo</label>
    <textarea name="editor1" id="editor1" rows="10" cols="80">
    {{ $obj->text }}
    </textarea>
    <input type="hidden" class="contenidoNota" name="text" required>
    
    <div class="form-group">
      <label>Iframe de Youtube</label>
      <input type="text" value="{{ $obj->youtube }}" name="youtube" class="form-control" name="youtube">
    </div>
    
    
    <button type="submit" class="btn btn-default">Actualizar Trabajo</button>
  </form>

@endsection

@section('scripts')
    <script src="//cdn.ckeditor.com/4.7.3/standard/ckeditor.js"></script>
    <script>
        
        CKEDITOR.replace('editor1');

        function crearNoticia(){
            var data = CKEDITOR.instances.editor1.getData();
            $('.contenidoNota').val(data);

            if(data.length == 0) return false;

//            return false;
        }
    </script>
@endsection