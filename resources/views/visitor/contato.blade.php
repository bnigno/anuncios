@extends('layouts.template')
@section('title')
  Contato - Vips Brasil
@endsection


@section('content')
  <div class="section-heading-page">
    <div class="container">
      <div class="row">
        <div class="col-sm-6">
          <h1 class="heading-page text-center-xs">Contato</h1>
        </div>
      </div>
    </div>
  </div>

  <div class="container">
    <div class="row">
      <div class="col-md-10">
        <div class="col-md-5">
          <h3 class="title-md text-theme hr-left">Formulário de Contato</h3>
          <form class="form-bg text-theme" id="contato" name="contato" method="post" novalidate="novalidate">
            {!! csrf_field() !!}
            <div class="form-group">
              <label for="name">Nome
                <span class="required" aria-required="true">*</span>
              </label>
              <input class="form-control" type="text" name="name" id="name" size="30" value="" required="" aria-required="true">
            </div>
            <div class="form-group">
              <label for="email">Email
                <span class="required" aria-required="true">*</span>
              </label>
              <input class="form-control" type="text" name="email" id="email" size="30" value="" required="" aria-required="true">
            </div>
            <div class="form-group text-theme">
              <label for="message">Mensagem
                <span class="required" aria-required="true">*</span>
              </label>
              <textarea class="form-control" rows="6" name="message" id="message" required="" aria-required="true"></textarea>
            </div>
            <button id="submit" type="submit" class="btn btn-primary text-theme" name="submit" value="Send"><i class="fa fa-paper-plane"></i>Enviar Mensagem</button>
          </form>

          <div id="success" class="mt-40">
            <div class="icon-box bordered">
              <i class="fa fa-check fa-round fa-4x text-theme"></i>
              <h3 class="lead text-theme">Mensagem enviada com sucesso!</h3>
            </div>
          </div>

          <div id="error" class="mt-40">
            <div class="icon-box bordered">
              <i class="fa fa-lock fa-round fa-4x text-theme"></i>
              <h3 class="lead text-theme">Algo deu errado. Envie novamente.</h3>
            </div>
          </div>
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
                  <img class="img-responsive img-sidebar-sm" src="{{url('img/'.$partner->banner.'?w=110&h=200&fit=contain')}}" alt="{{$partner->name}}">
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