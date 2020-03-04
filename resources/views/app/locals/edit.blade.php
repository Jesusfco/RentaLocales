@extends('blades.app')

@section('title', 'Editar Trabajo')

@section('css')
@endsection

@section('content')

<h5><a href="{{ url('app/locales') }}">Locales </a> >> Editar local {{ $obj->number }}</h5>

<form class="row" role="form" method="POST" enctype="multipart/form-data" >
  {{ csrf_field() }}

  <div class="form-group col l4 s12">
    <label for="exampleInputEmail1">Numero de Local: </label>
    <input type="number" name="number" class="form-control" value="{{ $obj->number }}"  placeholder="" required>
  </div>

  <div class="form-group col l12">
    <label for="exampleInputEmail1">Descripción: </label>
    <textarea type="text" name="description"  class="materialize-textarea" placeholder="Descripción del local">{{ $obj->description }}</textarea>
  </div>
    <div class="col l12"><br>
      <button type="submit" class="btn blue">Actualizar Local</button>
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