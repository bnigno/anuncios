@extends('layouts.template')
@section('title')
  Acompanhantes em {{$city->nome}} - Vips Brasil
@endsection


@section('content')
@if ($names->count()>0)
  <div class="section-heading-page">
    <div class="container">
      <div class="row">
        <div class="col-sm-6">
          <h1 class="heading-page text-center-xs">Acompanhantes em {{$city->nome}}</h1>
        </div>
      </div>
    </div>
  </div>

  <div class="container">
    <div class="row">
      <div class="col-md-9">

        <div class="section section-xs section-bottom">
          <div class="container">
            @if ($featureds->count()>0)
              <div class="row">
                <div class="col-md-8">
                  <h3 class="title-xl hr-left text-uppercase">Gatas VIPS</h3>
                  <br>
                  <!-- SLIDER -->
                  <div class="wrapper-slider">
                    <div id="carousel-2" class="carousel slide" data-ride="carousel" data-interval="3500" data-pause="hover">
                      <!-- Wrapper for slides -->
                      <div class="carousel-inner">
                      <?php $i=1 ?>
                      @foreach ($featureds as $featured)
                        @if ($i === 1)
                          <div class="item active">
                            <a href="{{url('/anuncios/acompanhante/'.$featured->id)}}"><img class="img-slide" src="{{url('img/'.$featured->coverName).'?w=900&h=600&fit=stretch'}}" alt="{{'$featured->name'}}"></a>
                            <span class="title-slider"><a href="{{url('/anuncios/acompanhante/'.$featured->id)}}" style="color:white">{{$featured->name}}</a></span>
                          </div>
                          <?php $i++ ?>
                        @else
                          <div class="item">
                            <a href="{{url('/anuncios/acompanhante/'.$featured->id)}}"><img class="img-slide" src="{{url('img/'.$featured->coverName).'?w=900&h=600&fit=stretch'}}" alt="{{'$featured->name'}}"></a>
                            <span class="title-slider"><a href="{{url('/anuncios/acompanhante/'.$featured->id)}}" style="color:white">{{$featured->name}}</a></span>
                          </div>
                        @endif
                      @endforeach
                      </div>
                      <!-- Controls -->
                      <a href="#carousel-2" role="button" data-slide="prev">
                        <i class="fa fa-angle-left fa-2x btn-prev"></i>
                      </a>
                      <a href="#carousel-2" role="button" data-slide="next">
                        <i class="fa fa-angle-right fa-2x btn-next"></i>
                      </a>
                    </div>
                  </div>
                  <!-- SLIDER END-->
                </div>
              </div>
              <br>
            @endif
            
              <div class="row">
                <div class="col-md-8">
                  <h3 class="title-xl hr-left text-uppercase">Novidades</h3>
                    <div id="container-mixitup">
                      <div class="row">
                        @foreach ($times as $time)
                        <div class="mix photography all col-sm-4 col-xs-12" style="display: inline-block;">
                          <a href="{{url('/anuncios/acompanhante/'.$time->id)}}" class="img-wrapper rounded-top">
                            <img class="img-responsive" src="{{url('img/'.$time->coverName.'?w=900&h=600&fit=stretch')}}" alt="{{'$time->name'}}">
                          </a>
                          <div class="caption-portfolio text-center">
                            <h3 class="text-theme title-xs"><a href="{{url('/anuncios/acompanhante/'.$time->id)}}">{{$time->name}}</a></h3>
                            <!-- <p class="text-theme">Lorem ipsum dolor sit amet, consectetuer</p> -->
                          </div>
                        </div>
                        @endforeach
                      </div>
                    </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md-8">
                  <h3 class="title-xl hr-left text-uppercase">Catálogo</h3>
                  <div id="container-mixitup">
                    <div class="row">
                      @foreach ($names as $name)
                      <div class="mix photography all col-sm-4 col-xs-12" style="display: inline-block;">
                        <a href="{{url('/anuncios/acompanhante/'.$name->id)}}" class="img-wrapper rounded-top">
                          <img class="img-responsive" src="{{url('img/'.$name->coverName.'?w=900&h=600&fit=stretch')}}" alt="{{'$name->name'}}">
                        </a>
                        <div class="caption-portfolio text-center">
                          <h3 class="text-theme title-xs"><a href="{{url('/anuncios/acompanhante/'.$name->id)}}">{{$name->name}}</a></h3>
                          <!-- <p class="text-theme">Lorem ipsum dolor sit amet, consectetuer</p> -->
                        </div>
                      </div>
                      @endforeach
                    </div>
                  </div>
                </div>
              </div>
          </div>
        </div>
      </div>
      @include('visitor.sidebar')
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