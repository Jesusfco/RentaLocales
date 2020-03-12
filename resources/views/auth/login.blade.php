@extends('blades.visitor')

@section('title', 'Accesar')

@section('css')

    
    
    <link href="{{ asset('css/login.css') }}" type="text/css" rel="stylesheet" media="screen,projection"/>
@endsection

@section('scripts')
    
@endsection

@section('content')

<div class="spaceLogin container">

    <div class="container2 loginCard  card">
        <div class="container"></div>
        <h3 class="title center-text">INICIAR SESIÓN</h3>       
    <form class="form-horizontal" method="POST" action="{{ url('/') }}">
        {{ csrf_field() }}

        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
            <label for="email" class="col-md-4 control-label">Correo</label>

            <div class="col-md-12">
                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>

                @if ($errors->has('email'))
                    <span class="help-block">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
            <label for="password" class="col-md-4 control-label">Contraseña</label>

            <div class="col-md-12">
                <input id="password" type="password" class="form-control" name="password" required>

                @if ($errors->has('password'))
                    <span class="help-block">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                @endif
            </div>
        </div>
                        
        <button type="submit" class="btn btn-primary blue l12">
            Acceder
        </button>
        <br>   
        <a class="forget-link" href="{{ url('recuperar') }}">
            ¿Olvidaste tu contraseña?
        </a>
            
        
    </form>
    </div>

</div>
@endsection