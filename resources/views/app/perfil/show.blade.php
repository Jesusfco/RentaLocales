@extends('blades.app')

@section('title', 'Mi Perfil')

@section('css')
@endsection

@section('content')
<h5>Mi Perfil</h5>

<center>
    <img class="circle" src="{{Auth::user()->getPhoto()}}" width="150px">
</center>

<form class="row">
    
    <div class="form-group col l12">
      <label  >Nombre Completo</label>
      <input value="{{ Auth::user()->fullname() }}" disabled>
    </div>

    <div class="form-group col l6 s12">
        <label  >Correo</label>
        <input value="{{ Auth::user()->email }}" disabled>
    </div>

    <div class="form-group col l6 s12">
        <label  >Teléfono</label>
        <input value="{{ Auth::user()->phone }}" disabled>
    </div>

    <div class="form-group col l6 s12">
        <label  >Tipo de usuario</label>
        <input value="{{ Auth::user()->userTypeView() }}" disabled>
    </div>

    <div class="form-group col l6 s12">
        <label>Sexo</label>
        <input value="{{ Auth::user()->genderView() }}" disabled>
    </div>

    

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