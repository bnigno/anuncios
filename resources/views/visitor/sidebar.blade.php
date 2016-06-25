<div class="col-sm-3 grid-sidebar">
  <div class="row-heading row-heading-mt-40">
    <div class="col-sm-12">
      <h3 class="title-sm text-uppercase hr-left text-theme">Translate</h3>
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

          <a href="/">
            <img class="img-responsive" src="{{url('img/d3542f23b2309495325876e768fb8b40b9261fce.jpg'.'??w=230&h=385&fit=stretch')}}" alt="" style="margin: auto;">
          </a>
          <br>
          <a href="/">
            <img class="img-responsive" src="{{url('img/d3542f23b2309495325876e768fb8b40b9261fce.jpg'.'??w=230&h=385&fit=stretch')}}" alt="" style="margin: auto;">
          </a>

      </div>
    </div>
  @endif
</div>