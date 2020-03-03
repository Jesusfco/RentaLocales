<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>@yield('title') || Administración || Visión-Real</title>
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="{{ asset('assets/materialize/materialize.css') }}" type="text/css" rel="stylesheet" media="screen,projection"/>
    <link href="{{ asset('css/admin/style.css') }}" type="text/css" rel="stylesheet" media="screen,projection"/>
    <link href="{{ asset('assets/sweet/sweetalert.css')}}" rel="stylesheet">
    @yield('css')
</head>
<body>

    @yield('content')
             

    <footer class="page-footer blue darken-3">
            <div class="container">
              <div class="row">
                {{-- <div class="col l6 s12"> --}}
                  {{-- <h5 class="white-text">Manten esto presente </h5>
                  <p class="grey-text text-lighten-4">Recuerda cada día cual es tu sueño, el honor y la humildad son raices de tu caracter. El guerrero es el espirito que alberga en tu alma</p> --}}
        
        
                {{-- </div> --}}
                {{-- <div class="col l3 s12">
                  <h5 class="white-text">Settings</h5>
                  <ul>
                    <li><a class="white-text" href="#!">Link 1</a></li>
                    <li><a class="white-text" href="#!">Link 2</a></li>
                    <li><a class="white-text" href="#!">Link 3</a></li>
                    <li><a class="white-text" href="#!">Link 4</a></li>
                  </ul>
                </div>
                <div class="col l3 s12">
                  <h5 class="white-text">Connect</h5>
                  <ul>
                    <li><a class="white-text" href="#!">Link 1</a></li>
                    <li><a class="white-text" href="#!">Link 2</a></li>
                    <li><a class="white-text" href="#!">Link 3</a></li>
                    <li><a class="white-text" href="#!">Link 4</a></li>
                  </ul>
                </div> --}}
              </div>
            </div>
            <div class="footer-copyright">
              <div class="container">
              Creado por <a class="blue-text text-lighten-3" href="https://www.instagram.com/roguez_a7/">Jesus Roguez</a>
              </div>
            </div>
          </footer>

    <script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
    {{-- OPTIMIZADO VUE --}}
    {{-- <script src="https://cdn.jsdelivr.net/npm/vue"></script> --}}
    <script src="{{ asset('assets/materialize/materialize.js') }}"></script>
    <script src="{{ asset('js/init.js') }}"></script>
    <script src="{{ asset('assets/sweet/sweetalert.min.js')}}"></script>
    <script src="{{ asset('js/delete.js')}}"></script>
    <script>

      const actualUrl = "{{ url()->current() }}"

            $(document).ready(function(){
               $('select').formSelect();
               $('.fixed-action-btn').floatingActionButton();
               $('.tooltipped').tooltip();
           })
           
           @if(session('msj'))    
               M.toast({html: '{{session('msj')}}', displayLength: 5000})        
           @endif

           @if(session('error'))    
               M.toast({html: '{{session('error')}}', classes: 'red', displayLength: 6500})        
           @endif
           @if(session('success'))    
               M.toast({html: '{{session('success')}}', classes: 'green', displayLength: 6500})        
           @endif
    </script>
    @yield('scripts')
    

</body>
</html>
