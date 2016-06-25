<html lang="ptbr">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>@yield('title')</title>
  <link rel="icon" href="assets/images/favicon.ico">
  <script src="{{asset('js/page/carousel-preload.js')}}"></script>

  <!--[if IE 8]><html class="ie8"><![endif]-->
  <!-- Bootstrap -->
  <link href="{{URL('css/bootstrap.min.css')}}" rel="stylesheet">
  <!-- Fonts -->
  <link href='http://fonts.googleapis.com/css?family=Open+Sans:400italic,400,600,700,800,300' rel='stylesheet' type='text/css'>
  <link href="http://netdna.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
  <!-- Plugins -->
  <link rel="stylesheet" type="text/css" href="{{asset('css/magnific-popup.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset('css/owl.carousel.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset('css/owl.theme.css')}}">
  <!-- Theme -->
  <link rel="stylesheet" type="text/css" href="{{asset('css/carousel-animate.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset('css/theme.css')}}">
  @yield('header')

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
  <![endif]-->
  <SCRIPT LANGUAGE="JavaScript">   
    <!-- Disable   
    function disableselect(e){   
    return false   
    }   

    function reEnable(){   
    return true   
    }   

    //if IE4+   
    document.onselectstart=new Function ("return false")   
    document.oncontextmenu=new Function ("return false")   
    //if NS6   
    if (window.sidebar){   
    document.onmousedown=disableselect   
    document.onclick=reEnable   
    }   
    //-->   
  </script>   
</head>
<body class="body-nav-fixed-menu-top">
  <div class="wrapper-body">

    <!-- NAVBAR -->
    <!--===============================================================-->
    <div id="header">
      <nav id="nav" class="navbar navbar-inverse navbar-fixed-top">
        <div class="container">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/"><img class="img-responsive" src="{{url('images/logo.png')}}" alt="Logo"></a>
          </div>

          <div id="navbar" class="navbar-collapse collapse">

            <ul class="nav navbar-nav navbar-right">
              <li class="">
                <a href="/" class="" data-toggle="" role="button" aria-expanded="false">Inicio</a>
              </li>

              <li class="">
                <a href="/anuncios/termos" class="" data-toggle="" role="button" aria-expanded="false">Termos de Uso</a>
              </li>

              <li class="">
                <a href="/anuncios/anuncie" class="" data-toggle="" role="button" aria-expanded="false">Anuncie</a>
              </li>

              <li class="">
                <a href="/anuncios/contato" class="" data-toggle="" role="button" aria-expanded="false">Contato</a>
              </li>

              <li class="">
                <a href="/anuncios/parceiros" class="" data-toggle="" role="button" aria-expanded="false">Parceiros</a>
              </li>

              <li class="">
                <a href="/anuncios/pesquisar" class="" data-toggle="" role="button" aria-expanded="false">Pesquisar</a>
              </li>

              <li class="">
                <a href="/anuncios/alterar" class="" data-toggle="" role="button" aria-expanded="false">Alterar Cidade</a>
              </li>
            </ul>
          </div><!--/.nav-collapse -->
        </div>
      </nav>
    </div>
    <!-- NAVBAR END -->

  @yield('content')

    
  <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <script src="{{asset('js/page/page.navbar-fixed-shrinked.js')}}"></script>
  <!-- Include all compiled plugins (below), or include individual files as needed -->
  <script src="{{URL('js/bootstrap.min.js')}}"></script>
  <script src="{{asset('js/owl.carousel.js')}}"></script>
  <script src="{{asset('js/jquery.magnific-popup.js')}}"></script>
  <script src="{{asset('js/jquery.waypoints.js')}}"></script>
  <script src="{{asset('js/jquery.countTo.js')}}"></script>
  <script src="{{asset('js/page/theme.js')}}"></script>
  <script src="{{asset('js/page/page.home.js')}}"></script>
  @yield('footer')
</body>

</html>


