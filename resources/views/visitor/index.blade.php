<html lang="ptbr">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Vips Brasil - Inicio</title>
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
  <!-- <link rel="stylesheet" type="text/css" href="{{asset('css/owl.carousel.css')}}"> -->
  <link rel="stylesheet" type="text/css" href="{{asset('css/owl.theme.css')}}">
  <!-- Theme -->
  <!-- <link rel="stylesheet" type="text/css" href="{{asset('css/carousel-animate.css')}}"> -->
  <link rel="stylesheet" type="text/css" href="{{asset('css/theme.css')}}">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<body>
	<div class="wrapper-table-cell" style="text-align:center">
		<div class="section-polygonal-black">
		    <div class="opacity-layer section section-both section-lg">
		      <div class="container">
		      	<img class="img-responsive" src="{{url('img/logo.png').'?w=300&h=300&fit=max'}}" alt="Vips Brasil Logo" style="margin: auto;">
		        <h1 class="">Escolha uma cidade</h1>
		        <form class="form-inline" role="form" method="POST" action="/anuncios/cidade">
		            {!! csrf_field() !!}

		            <div class="form-group">
		                <label for="city">Cidade:</label>
		                <select name="city" id="city" class="form-control" required>
		                    <option value="">Selecione</option>
		                    @foreach ($cities as $city)
		                        <option value="{{$city->id}}">{{$city->nome}}</option>
		                    @endforeach
		                </select>
		            </div>
	                <div class="form-group">
	                    <div class="col-md-2">
	                        <button type="submit" class="btn btn-primary">
	                            <i class="fa fa-chevron-right"></i>
	                        </button>
	                    </div>
	                </div>    
		        </form>
		        <p class="text-theme-lg subtitle-404"><b>Página destinada a maiores de 18 anos.</b><br>Nosso site é uma revista online. Não intermediamos nenhum contato com as acompanhantes aqui anunciadas. O mesmo deverá ser feito utilizando os números de telefone que constam nos anúncios.</p>
		        <div class="row">
		          <div class="col-sm-12">
		            <div id="google_translate_element" class="text-theme"></div><script type="text/javascript">
		            function googleTranslateElementInit() {
		              new google.translate.TranslateElement({pageLanguage: 'pt'}, 'google_translate_element');
		            }
		            </script><script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
		          </div>
		        </div>	
		      </div>
		    </div>
		  </div>
	  </div>
</body>
</html>