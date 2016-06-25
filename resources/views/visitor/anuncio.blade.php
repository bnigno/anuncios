@extends('layouts.template')
@section('title')
  {{ isset($ad->name) ? $ad->name . ' - Vips Brasil'  : 'Erro - Vips Brasil' }}
@endsection


@section('content')
@if (isset($ad->name))
  <div class="section-heading-page">
    <div class="container">
      <div class="row">
        <div class="col-sm-6">
          <h1 class="heading-page text-center-xs">Acompanhante em {{$city->nome}}</h1>
        </div>
      </div>
    </div>
  </div>

  <div class="container">
    <div class="row">
      <div class="col-md-9">



        <!--SECTION -->
        <!--===============================================================-->
        <div class="section">
          <div class="container">
            <div class="row" id="progress-bar-count">
              <div class="col-md-4" style="align:center">
                <img src="{{url('img/'.$ad->perfilName).'?w=600&h=900&fit=contain'}}" class="img-responsive img-rounded" alt="{{$ad->name}}" style="float:right;">
              </div>
              <div class="col-md-5">
                <div class="portfolio-item-description">
                  <h3 class="text-theme title-lg">{{$ad->name}}</h3>
                    <ul class="list-unstyled">
                      <li><b>Telefone:</b> <a href="tel:{{$ad->phone}}">{{$ad->phone}}</a></li>
                      <li><b>Cachê: </b>R$ {{$ad->price}}</li>
                      <li><b>Idade: </b>{{$ad->age}}</li>
                      <li><b>Atendimento: </b>{{$ad->service}}</li>
                      @if ($ad->bornCity != '')
                        <li><b>Naturalidade: </b>{{$ad->bornCity}}</li>
                      @endif
                      @if ($ad->weight != 0)
                        <li><b>Peso: </b>{{$ad->weight}} Kg</li>
                      @endif
                      @if ($ad->height != 0)
                        <li><b>Altura: </b>{{$ad->height}} m</li>
                      @endif
                      @if ($ad->hairColor != '')
                        <li><b>Cabelos: </b>{{$ad->hairColor}}</li>
                      @endif
                      @if ($ad->eyeColor != '')
                        <li><b>Olhos: </b>{{$ad->eyeColor}}</li>
                      @endif
                      @if ($ad->race != '')
                        <li><b>Cor: </b>{{$ad->race}}</li>
                      @endif
                      @if ($ad->size != 0)
                        <li><b>Manequim: </b>{{$ad->size}}</li>
                      @endif
                      @if ($ad->hip != 0)
                        <li><b>Quadril: </b>{{$ad->hip}}</li>
                      @endif
                    </ul>
                    <ul class="text-theme list-inline list-md">
                      @if ($ad->oral === 1)
                        <li><i class="fa fa-check colored"></i>Oral</li>
                      @endif
                      @if ($ad->anal === 1)
                        <li><i class="fa fa-check colored"></i>Anal</li>
                      @endif
                      @if ($ad->kiss === 1)
                        <li><i class="fa fa-check colored"></i>Beija</li>
                      @endif
                      @if ($ad->travel === 1)
                        <li><i class="fa fa-check colored"></i>Viaja</li>
                      @endif
                    </ul>
                    @if ($ad->description != '')
                      <p class="text-theme"><b>Descrição</b>
                        <br>{{$ad->description}}
                      </p>
                    @endif
                </div>
              </div>
            </div>
          </div>
        </div>

        @if ($video->count()>0)
        <!-- SECTION VIDEO -->
        <!--===============================================================-->
        <div class="section section-md section-both">
          <div class="container">
            <div class="row">
              <div class="col-sm-9 text-center">
                <h3 class="title-lg title-section hr text-uppercase">Vídeo</h3>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-9">
                <!-- VIDEO AQUI -->
                <div ng-app="myApp" class="col-md-6 clearfix">
                    <div ng-controller="HomeCtrl as controller" class="col-md-6 videogular-container">
                        <videogular vg-theme="controller.config.theme">
                            <vg-media vg-src="controller.config.sources">
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
                </div>
              </div>
            </div>
          </div>
        </div>
        @endif

        @if (isset($photos))
        <!-- SECTION PHOTOS -->
        <!--===============================================================-->
        <div class="section section-md section-both">
          <div class="container">
            <div class="row">
              <div class="col-sm-9 text-center">
                <h3 class="title-lg title-section hr text-uppercase">Fotos</h3>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-9">
                <div id="owl-our-work" class="owl-carousel owl-theme">
                      @foreach ($photos as $photo)
                          <div class="item">
                            <a href="{{url('img/'.$photo->fileName.'?w=1280&h=720&fit=contain')}}" class="img-wrapper rounded gallery-item'">
                              <img class="img-responsive" src="{{url('img/'.$photo->fileName.'?w=1280&h=720&fit=crop-top')}}" alt="Foto">
                            </a>
                          </div>
                      @endforeach
                </div>
              </div>
            </div>
          </div>
        </div>
        @endif
      </div>
      @include('visitor.sidebar')
    </div>
  </div>
</div>
@else
  <div class="section section-xs section-bottom">
    <div class="container">
      <div class="content-coming-soon" id="content" style="text-align:center">
        <br>
        <h1 style="color:white;"><i class="fa fa-exclamation-circle"></i></h1>
        <h3 class="title-xl text-theme">Nenhum anúncio cadastrado.</h3>
        <p class="lead text-theme">Quer anunciar? <a href="/contato">Entre em contato</a></p>
        <div id="coming-soon" class="text-theme"></div>
      </div>
    </div>
  </div>
@endif
@endsection

@section('footer')
  <script src="{{asset('vendor/angular/angular.min.js')}}"></script>
  <script src="{{asset('vendor/angular-sanitize/angular-sanitize.min.js')}}"></script>
  <script src="{{asset('vendor/videogular/videogular.min.js')}}"></script>
  <script src="{{asset('vendor/videogular-buffering/vg-buffering.min.js')}}"></script>
  <script src="{{asset('vendor/videogular-controls/vg-controls.min.js')}}"></script>
  <script src="{{asset('vendor/videogular-overlay-play/vg-overlay-play.min.js')}}"></script>
  <script src="{{asset('vendor/videogular-poster/vg-poster.min.js')}}"></script>
  <script type="text/javascript">'use strict';
    angular.module('myApp',
            [
                "ngSanitize",
                "com.2fdevs.videogular",
                "com.2fdevs.videogular.plugins.controls",
                "com.2fdevs.videogular.plugins.buffering",
                "com.2fdevs.videogular.plugins.overlayplay",
                "com.2fdevs.videogular.plugins.poster"
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
                        controls: {
                          "autohide": true,
                          "autohideTime": 3000
                        },
                        poster: "{{url('img/'.$ad->coverName.'?w=1280&h=720&fit=crop-top')}}"
                    }
                };
            }]
        );</script>
@endsection