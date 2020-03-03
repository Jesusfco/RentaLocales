@extends('blades.app')

@section('title', 'Actualizar Perfil')

@section('css')
@endsection

@section('content')
<h5><a href="../perfil">Mi Perfil</a> >> Editar</h5>

<center>
    <img class="circle" src="{{Auth::user()->getPhoto()}}" width="150px">
</center>

<form class="row" method="POST" enctype="multipart/form-data" >
    {{ csrf_field() }}
    <div class="form-group col l6">
      <label>Nombre Completo</label>
      <input name="name" value="{{ Auth::user()->name }}" required>
    </div>

    <div class="form-group col l6">
        <label>A. Paterno</label>
        <input name="patern" value="{{ Auth::user()->patern }}">
    </div>


    <div class="form-group col l6">
        <label>A. Materno</label>
        <input name="matern" value="{{ Auth::user()->matern }}">
    </div>

    <div class="form-group col l6 s12">
        <label>Correo</label>
        <input name="email" value="{{ Auth::user()->email }}" required>
        @if(session('email'))
            <span>{{session('email')}}</span>
        @endif
    </div>

    <div class="form-group col l6 s12">
        <label>Teléfono</label>
        <input name="phone" value="{{ Auth::user()->phone }}">
    </div>

    <div class="form-group col l6 s12">                
        <label>Tipo de usuario</label>
        <input value="{{ Auth::user()->userTypeView() }}" disabled>                    
    </div>

    <div class="form-group col l6 s12">
            <label>Sexo</label>  
        <select name="gender" required>                        
            <option value="{{ Auth::user()->gender }}">{{ Auth::user()->genderView() }}</option>
            <option value="1" >Masculino</option>
            <option value="2" >Femenino</option>            
        </select>        
              
    </div>

    <div class="form-group col l6 s12">
      <label>Foto de perfil</label>
      <input type="file" name="img" id="imagen" accept="image/x-png,image/gif,image/jpeg">      
    </div>

    <div class="col l12">
    <br><br>
    
    </div>
    <button type="submit" class="btn btn-default col l12">Actualizar Perfil</button>

</form>


<div class="fixed-action-btn">
        <a class="btn-floating btn-large red">
          <i class="large material-icons">build</i>
        </a>
        <ul>
        {{-- <li><a class="btn-floating yellow darken-1"><i class="material-icons">format_quote</i></a></li>
          <li><a class="btn-floating green"><i class="material-icons">publish</i></a></li> --}}
          <li ><a class="btn-floating red" href="{{ url('app/perfil/password')}}"><i class="material-icons">vpn_key</i></a></li>          
        <li><a class="btn-floating blue" href="{{ url('app/perfil/edit')}}"><i class="material-icons">mode_edit</i></a></li>
        </ul>
      </div>

@endsection

@section('scripts')

@endsection