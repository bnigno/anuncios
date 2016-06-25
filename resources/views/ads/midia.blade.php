@extends('layouts.app')

@section('title')
    Enviar Mídia - Vips Brasil
@endsection

@section('header')
    <link rel="stylesheet" href="<?php echo asset('vendor/dropzoner/dropzone/dropzone.min.css'); ?>">

@endsection

@section('content')
<!-- <script src="{{url('js/dropzone.js')}}"></script>
<link href="{{url('css/dropzone.css')}}" rel="stylesheet"> -->
<script src="<?php echo asset('vendor/dropzoner/dropzone/dropzone.min.js'); ?>"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
<script src="<?php echo asset('vendor/dropzoner/dropzone/config.js'); ?>"></script>
@if (session('status'))
    <div class="alert alert-success" id="status">
        <ul>
                <li>{{ session('status') }}</li>
        </ul>
    </div>
@endif

<div class="row">
    <h1>Midia de {{$ad->name}}
        <small>
            <a href="{{url('/anuncios/acompanhante/'.$ad->id)}}" target="_blank" class="btn btn-default">
                <i class="fa fa-eye"></i> Ver Anúncio
            </a>
        </small> 
    </h1>
    <div class="clearfix col-md-12">
        <h3>Foto de Perfil</h3>
        @if ($perfil->perfilName != '')
            <div class="col-md-2" align="center">
                <a href="{{url('img/'.$perfil->perfilName)}}" target="_blank"><img src="{{url('img/thumb'.$perfil->perfilName)}}" class="img-thumbnail"></a>
                <p><a href="{{url('/upload/deleteperfil?filename='.$perfil->perfilName)}}"><i class="glyphicon glyphicon-trash" title="Remover"></i></a>
            </div>
        @else
            <p>Nenhuma imagem enviada. Utilize o espaço abaixo para enviar</p>
        @endif
    </div>
</div>

@if ($perfil->perfilName === '')
    <div class="row">
                <div class="col-md-12">
                    <h3>Enviar imagem de perfil para o anúncio (formato retrato):</h3>
                    <div class="container">
                        <div class="dropzone" id="perfil">
                        </div>
                    </div>
                </div>
    </div> 

    <script type="text/javascript">
            var baseUrl = "{{ url('/') }}";
            var token = "{{ Session::getToken() }}";
            Dropzone.autoDiscover = false;
            var myDropzone = new Dropzone("div#perfil", {
                url: baseUrl + "/upload/perfil",
                params: {
                    _token: token
                },
                dictDefaultMessage: 'Clique ou arraste e solte seus arquivos aqui',
                maxFiles: 1,
                maxFilesize: 5,
                acceptedFiles: 'image/*',
                dictInvalidFileType: 'Você não pode enviar arquivos neste formato',
                dictFileTooBig: 'Este arquivo é maior do que o permitido.',
                addRemoveLinks: true,
            });
        </script>    
@endif

<div class="row">
    <div class="clearfix col-md-12">
        <h3>Foto de Capa</h3>
        @if ($cover->coverName != '')
            <div class="col-md-2" align="center">
                <a href="{{url('img/'.$cover->coverName)}}" target="_blank"><img src="{{url('img/thumb'.$cover->coverName)}}" class="img-thumbnail"></a>
                <p><a href="{{url('/upload/deletecover?filename='.$cover->coverName)}}"><i class="glyphicon glyphicon-trash" title="Remover"></i></a>
            </div>
        @else
            <p>Nenhuma imagem enviada. Utilize o espaço abaixo para enviar</p>
        @endif
    </div>
</div>

@if ($cover->coverName === '')
    <div class="row">
                <div class="col-md-12">
                    <h3>Enviar imagem de capa para o anúncio (formato paisagem):</h3>
                    <div class="container">
                        <div class="dropzone" id="cover">
                        </div>
                    </div>
                </div>
    </div> 

    <script type="text/javascript">
            var baseUrl = "{{ url('/') }}";
            var token = "{{ Session::getToken() }}";
            Dropzone.autoDiscover = false;
            var myDropzone = new Dropzone("div#cover", {
                url: baseUrl + "/upload/cover",
                params: {
                    _token: token
                },
                dictDefaultMessage: 'Clique ou arraste e solte seus arquivos aqui',
                maxFiles: 1,
                maxFilesize: 5,
                acceptedFiles: 'image/*',
                dictInvalidFileType: 'Você não pode enviar arquivos neste formato',
                dictFileTooBig: 'Este arquivo é maior do que o permitido.',
                addRemoveLinks: true,
            });
        </script>    
@endif

<div class="row">
    <div class="clearfix col-md-12">
        <h3>Fotos do Anúncio</h3>
        @forelse ($photos as $photo)
            <div class="col-md-2" align="center">
                <a href="{{url('img/'.$photo->fileName)}}" target="_blank"><img src="{{url('img/thumb'.$photo->fileName)}}" class="img-thumbnail"></a>
                <p><a href="{{url('/upload/deleteimg?filename='.$photo->fileName)}}"><i class="glyphicon glyphicon-trash" title="Remover"></i></a>
            </div>
            @empty
            <p>Nenhuma imagem enviada. Utilize o espaço abaixo para enviar</p>
        @endforelse
    </div>
</div>

@if (sizeof($photos)<15)
    <div class="row">
                <div class="col-md-12">
                    <h3>Enviar imagens para o anúncio:</h3>
                    <div class="container">
                        <div class="dropzone" id="img">
                        </div>
                    </div>
                </div>
    </div> 

    <script type="text/javascript">
            var baseUrl = "{{ url('/') }}";
            var token = "{{ Session::getToken() }}";
            Dropzone.autoDiscover = false;
            var myDropzone = new Dropzone("div#img", {
                url: baseUrl + "/upload/img",
                params: {
                    _token: token
                },
                dictDefaultMessage: 'Clique ou arraste e solte seus arquivos aqui',
                maxFiles: {{15-sizeof($photos)}},
                maxFilesize: 5,
                acceptedFiles: 'image/*',
                dictInvalidFileType: 'Você não pode enviar arquivos neste formato',
                dictFileTooBig: 'Este arquivo é maior do que o permitido.',
                addRemoveLinks: true,
            });
        </script>    
@endif

<div class="row">
    <div class="col-md-12">
        <h3>Vídeo do Anúncio</h3>
        @forelse ($videos as $video)
            <!-- <div class="col-md-2">
                <video width="320" height="240" controls>
                  <source src="{{url('video/video/'.$video->fileName)}}" type="video/mp4">
                Seu navegador não suporta vídeos.
                </video>
                <p><a href="{{url('/upload/deletevid?filename='.$video->fileName)}}">Remover Vídeo</a>
            </div> -->
            <div ng-app="myApp" class="clearfix col-md-4">
                <div ng-controller="HomeCtrl as controller" class="videogular-container">
                    <videogular vg-theme="controller.config.theme">
                        <vg-media vg-src="controller.config.sources"
                                >
                        </vg-media>

                        <vg-controls>
                            <vg-play-pause-button></vg-play-pause-button>
                            <vg-time-display>@{{ currentTime | date:'mm:ss' }}</vg-time-display>
                            <vg-scrub-bar>
                                <vg-scrub-bar-current-time></vg-scrub-bar-current-time>
                            </vg-scrub-bar>
                            <vg-time-display>@{{ timeLeft | date:'mm:ss' }}</vg-time-display>
                            <vg-volume>
                                <vg-mute-button></vg-mute-button>
                                <vg-volume-bar></vg-volume-bar>
                            </vg-volume>
                            <vg-fullscreen-button></vg-fullscreen-button>
                        </vg-controls>

                        <vg-overlay-play></vg-overlay-play>
                        <vg-poster vg-url='controller.config.plugins.poster'></vg-poster>
                        <vg-buffering></vg-buffering>
                    </videogular>
                </div>
                <div align="center">
                    <p><a href="{{url('/upload/deletevid?filename='.$video->fileName)}}"><i class="glyphicon glyphicon-trash" title="Remover"></i></a></p>
                </div>
            </div>
            @empty
            <p>Nenhum vídeo enviado. Utilize o espaço abaixo para enviar</p>
        @endforelse
    </div>
</div>
@if (sizeof($videos)===0)
    <div class="row">
                <div class="col-md-12">
                    <h3>Enviar vídeo para o anúncio (formato mp4, tamanho máximo 300mb):</h3>
                    <div class="container">
                        <div class="dropzone" id="vid">
                        </div>
                    </div>
                </div>
    </div> 

    <script type="text/javascript">
            var baseUrl = "{{ url('/') }}";
            var token = "{{ Session::getToken() }}";
            Dropzone.autoDiscover = false;
            var myDropzone2 = new Dropzone("div#vid", {
                url: baseUrl + "/upload/vid",
                params: {
                    _token: token
                },
                dictDefaultMessage: 'Clique ou arraste e solte seus arquivos aqui',
                maxFiles: 1,
                maxFilesize: 300,
                acceptedFiles: 'video/mp4',
                dictInvalidFileType: 'Você não pode enviar arquivos neste formato',
                dictFileTooBig: 'Este arquivo é maior do que o permitido.',
                maxThumbnailFilesize: 700,
                addRemoveLinks: true,
            });
        </script>    
@endif
<script src="{{asset('vendor/angular/angular.min.js')}}"></script>
<script src="{{asset('vendor/angular-sanitize/angular-sanitize.min.js')}}"></script>
<script src="{{asset('vendor/videogular/videogular.min.js')}}"></script>
<script src="{{asset('vendor/videogular-buffering/vg-buffering.min.js')}}"></script>
<script src="{{asset('vendor/videogular-controls/vg-controls.min.js')}}"></script>
<script src="{{asset('vendor/videogular-overlay-play/vg-overlay-play.min.js')}}"></script>
<script type="text/javascript">'use strict';
angular.module('myApp',
        [
            "ngSanitize",
            "com.2fdevs.videogular",
            "com.2fdevs.videogular.plugins.controls",
            "com.2fdevs.videogular.plugins.overlayplay",
            "com.2fdevs.videogular.plugins.buffering"
        ]
    )
    .controller('HomeCtrl',
        ["$sce", function ($sce) {
            this.config = {
                sources: [
                    {src: $sce.trustAsResourceUrl("{{isset($video->fileName) ? url('video/video/'.$video->fileName) : ''}}"), type: "video/mp4"}
                ],
                theme: "/vendor/videogular-themes-default/videogular.min.css",
                plugins: {
                    "controls": {
                      "autohide": true,
                      "autohideTime": 3000
                    }
                }
            };
        }]
    );</script>

<br>
@endsection