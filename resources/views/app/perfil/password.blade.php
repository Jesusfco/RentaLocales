@extends('blades.app')

@section('title', 'Actualizar Contraseña')

@section('css')
@endsection

@section('content')
<h5><a href="../perfil">Mi Perfil</a> >> Actualizar Contraseña</h5>

<center>
<img class="circle" src="{{Auth::user()->getPhoto()}}" width="150px">
<p>{{ Auth::user()->fullname()}}</p>
</center>

<form class="row" method="POST" enctype="multipart/form-data" >
    {{ csrf_field() }}
    <div class="form-group col l6">
      <label>Contraseña</label>
      <input name="password" required type="password" id="password">
    </div>

    <div class="form-group col l6">
        <label>Confirma tu Contraseña</label>
        <input name="password" required type="password" id="confirm_password">
    </div>

    <div class="col l12">
    <br><br>
            
    </div>
    <button type="submit" class="btn btn-default col l12">Actualizar Contraseña</button>

</form>

@endsection

@section('scripts')
<script>
var password = document.getElementById("password")
  , confirm_password = document.getElementById("confirm_password");

function validatePassword(){
  if(password.value != confirm_password.value) {
    confirm_password.setCustomValidity("Las contraseñas no coinciden");
  } else {
    confirm_password.setCustomValidity('');
  }
}

password.onchange = validatePassword;
confirm_password.onkeyup = validatePassword;
</script>
@endsection