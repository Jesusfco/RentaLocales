@extends('blades.visitor')

@section('title', 'Restaurar contraseña')

@section('css')

    
    
    <link href="{{ asset('css/visitor/login.css') }}" type="text/css" rel="stylesheet" media="screen,projection"/>
@endsection

@section('scripts')
    
@endsection

@section('content')

<div class="spaceLogin">

    <div class="container2 loginCard">  

        <h3 class="text-center">Resetea tu contraseña</h3>    
        <form class="form-horizontal" method="POST" action="">
            {{ csrf_field() }}
            
            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                <label for="email" class="col-md-4 control-label">Correo</label>

                <div class="col-md-12">
                    {{-- <input id="email" type="email" class="form-control" name="email" value="{{ $email or old('email') }}" disabled>                     --}}
                    <input id="email" type="email" class="form-control" name="email" value="{{ $email  }}" disabled>                    
                </div>
            </div>

            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                <label for="password" class="col-md-4 control-label">Nueva contraseña</label>

                <div class="col-md-12">
                    <input id="password" type="password" class="form-control" name="password" pattern=".{5,}"   required title="5 caracteres minimo" focus>

                    @if ($errors->has('password'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            
            <div class="form-group">
                <div class="col-md-12 ">
                    <button type="submit" class="btn btn-primary">
                        Resetear contraseña
                    </button>
                </div>
            </div>
        </form>
    </div>          
    </div>          
@endsection
