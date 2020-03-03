@extends('blades.app')
@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/admin/dropzone.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/gallery/css/blueimp-gallery.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/gallery/css/blueimp-gallery-indicator.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/gallery/css/blueimp-gallery-video.css') }}">
@stop
@section('scripts')

<script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
<!-- <script src="https://cdn.jsdelivr.net/npm/vue"></script> -->
<script src="https://unpkg.com/axios@0.12.0/dist/axios.min.js"></script>
<script src="https://unpkg.com/lodash@4.13.1/lodash.min.js"></script>
{{-- <script src="https://unpkg.com/packery@2/dist/packery.pkgd.min.js"></script> --}}
<script type="text/javascript" src="{{ asset('js/admin/myDropzone.js') }}"></script>
{{-- <script> $('.photoContainer').packery(); </script> --}}

<script src="{{ asset('assets/gallery/js/blueimp-helper.js') }}"></script>
<script src="{{ asset('assets/gallery/js/blueimp-gallery.js') }}"></script>
<script src="{{ asset('assets/gallery/js/blueimp-gallery-fullscreen.js') }}"></script>
<script src="{{ asset('assets/gallery/js/blueimp-gallery-indicator.js') }}"></script>
<script src="{{ asset('assets/gallery/js/jquery.blueimp-gallery.js') }}"></script>
<script>
    document.getElementById('links').onclick = function (event) {
        event = event || window.event;
        var target = event.target || event.srcElement,
            link = target.src ? target.parentNode : target,
            options = {index: link, event: event},
            links = this.getElementsByTagName('a');
        blueimp.Gallery(links, options);
    };
</script>
@endsection

@section('content')

    

<div class="panel panel-default" id="principal">
    <div class="panel-heading">
    <p> <a href="{{ url('app/articles') }}">Articulos</a> >> Cargar Fotos</p></div>
        <div class="panel-body">

            <h5>{{ $obj->name }}</h5>

            <div id="app">

                <p>Añada sus imágenes</p>

                <div class="opciones"> 
                    <button v-on:click="retryFiled" class="btn purple">Reintentar Carga</button>
                </div>


                <form id="drop" method="POST">
                    <div  class="dropInputContainer">
                        <input id="files" type="file" name="files" v-on:change="getFile" multiple>
                        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcR9hqdx156iXgfLI85FFfW6A2sUCRlueJE6eZ5WTpXt6Qu6qPEf">
                    </div>
                    
                    {{ csrf_field() }}

                    <div class="filePreviewContainer" v-if="files.length > 0" >
                        <div v-for="file in files" class="fileDiv" v-bind:class="{ activeDrop: file.status == 1, 
                        'errorUpload': file.status < 0 }">
                            <img :src=file.bits :id=file.id>
                            
                            <div v-if="file.status == 1" class="progress">
                                <div class="percent" id="percent"></div>
                            </div>
                            <div v-if="file.status == -1" class="alertDrop">
                                <p>Error en la carga</p>
                            </div>
                            <div v-if="file.status == -2" class="alertDrop">
                                <p>Nombre duplicada</p>
                            </div>
                        </div>
                    </div>    
                </form>

                <br>

                <input type="hidden" value="{{$obj->id}}" id="galleryId">
                <input type="hidden" value="{{url('/')}}" id="homePath">
                <input type="hidden" value="1" id="photoType">

                <div id="links" class="photoContainer">
                    <div v-for="photo in photos" class="photo">
                        <a v-bind:id="'pho-' + photo.id" class="backgroundPhoto" v-bind:href="photo.path" data-gallery="#blueimp-gallery-links"></a>
                        <i class="material-icons" v-on:click="deletePhoto(photo)">delete</i>
                    </div>
                </div>

                <div id="blueimp-gallery" class="blueimp-gallery">
                    <div class="slides"></div>
                    <h3 class="title"></h3>
                    <a class="prev">‹</a>
                    <a class="next">›</a>
                    <a class="close">×</a>
                    <a class="play-pause"></a>
                    <ol class="indicator"></ol>
                </div>

                <br>
            </div>

        </div>
            
    </div>
</div>

            

@endsection