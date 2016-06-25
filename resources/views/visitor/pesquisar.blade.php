@extends('layouts.template')
@section('title')
  Pesquisar - Vips Brasil
@endsection


@section('content')
  <div class="section-heading-page">
    <div class="container">
      <div class="row">
        <div class="col-sm-6">
          <h1 class="heading-page text-center-xs">Pesquisar em {{$city->nome}}</h1>
        </div>
      </div>
    </div>
  </div>
  <div class="container">
    <div class="row">
      <div class="col-md-10">
        <h3 class="title-lg hr-left text-uppercase">Critérios</h3><br>
        <form class="form-inline" role="form" method="GET" action="/anuncios/pesquisar" style="text-align:center;">
            {!! csrf_field() !!}
            <div class="col-md-12">
              <div class="form-group">
                  <label for="name">Nome:</label>
                  <input name="name" id="name" class="form-control" autofocus="true" value="{{ isset($_REQUEST['name']) ? $_REQUEST['name']  : '' }}">
              </div>  
              <div class="form-group">
                  <label for="eyeColor">Cor dos Olhos:</label>
                  <input name="eyeColor" id="eyeColor" class="form-control" value="{{ isset($_REQUEST['eyeColor']) ? $_REQUEST['eyeColor']  : '' }}" placeholder="azuis">
              </div>
              <div class="form-group">
                  <label for="hairColor">Cor do Cabelo:</label>
                  <input name="hairColor" id="hairColor" class="form-control" value="{{ isset($_REQUEST['hairColor']) ? $_REQUEST['hairColor']  : '' }}" placeholder="loira">
              </div>
              <div class="form-group">
                  <label for="oral" class="col-sm-2 control-label">Oral:</label>
                  <div class="col-sm-1">
                      @if (isset ($_REQUEST['oral']) && $_REQUEST['oral']===1)
                          <input type="checkbox" name="oral" value="1" checked><br>
                      @else
                          <input type="checkbox" name="oral" value="1"><br>
                      @endif
                  </div>
                  <label for="anal" class="col-sm-2 control-label">Anal:</label>
                  <div class="col-sm-1">
                      @if (isset ($_REQUEST['anal']) && $_REQUEST['anal']===1)
                          <input type="checkbox" name="anal" value="1" checked><br>
                      @else
                          <input type="checkbox" name="anal" value="1"><br>
                      @endif
                  </div>
                  <label for="kiss" class="col-sm-2 control-label">Beija:</label>
                  <div class="col-sm-1">
                      @if (isset ($_REQUEST['kiss']) && $_REQUEST['kiss']===1)
                          <input type="checkbox" name="kiss" value="1" checked><br>
                      @else
                          <input type="checkbox" name="kiss" value="1"><br>
                      @endif
                  </div>
              </div>
              <div class="form-group">
                  <div class="col-md-6">
                      <button type="submit" class="btn btn-primary">
                          <i class="fa fa-search"></i>
                      </button>
                  </div>
              </div>
            </div>
        </form>
        <div class="row">
          @if (isset($ads))
            <div class="row">
              <div class="col-md-10">
                <h3 class="title-lg hr-left text-uppercase">Resultados</h3>
                <div id="container-mixitup">
                  <div class="row">
                    @forelse ($ads as $ad)
                    <div class="mix photography all col-sm-4 col-xs-12" style="display: inline-block;">
                      <a href="{{url('/anuncios/acompanhante/'.$ad->id)}}" class="img-wrapper rounded-top">
                        <img class="img-responsive" src="{{url('img/'.$ad->coverName.'?w=900&h=600&fit=stretch')}}" alt="{{'$ad->name'}}">
                      </a>
                      <div class="caption-portfolio text-center">
                        <h3 class="text-theme title-xs"><a href="{{url('/anuncios/acompanhante/'.$ad->id)}}">{{$ad->name}}</a></h3>
                      </div>
                    </div>
                    @empty
                      <div class="mix photography all col-sm-4 col-xs-12" style="display: inline-block;">
                        <p class="text-theme lead">Nenhum resultado</p>
                      </div>
                    @endforelse
                  </div>
                </div>
              </div>
            </div>
          @endif
        </div>
      </div>
      <div class="col-sm-2 grid-sidebar">
        <div class="row-heading row-heading-mt-40">
          <div class="col-sm-12">
            <h3 class="title-sm text-uppercase hr-left text-theme">Traduzir</h3>
          </div>
        </div>
        <div class="row">
          <div class="col-sm-12">
            <div id="google_translate_element" class="text-theme"></div><script type="text/javascript">
            function googleTranslateElementInit() {
              new google.translate.TranslateElement({pageLanguage: 'pt'}, 'google_translate_element');
            }
            </script><script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
          </div>
        </div>
        @if (isset($partners))
          <div class="row-heading row-heading-mt-40">
            <div class="col-sm-12">
              <h3 class="title-sm text-uppercase hr-left text-theme">Publicidade</h3>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-12">
              @forelse ($partners as $partner)
                <a href="{{$partner->site}}">
                  <img class="img-responsive" src="{{url('img/'.$partner->banner.'?w=120&h=300&fit=stretch')}}" alt="{{$partner->name}}" style="float:inherit;">
                </a>
              @empty
              @endforelse
            </div>
          </div>
        @endif
      </div>
    </div>
  </div>
</div>
@endsection