<!DOCTYPE html>
<html>
<head>
	<title>Fynches</title>
	<link rel="shortcut icon" type="image/png" href="{{asset('favicon.png')}}"/>
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<meta name=viewport content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	<link href="https://fonts.googleapis.com/css?family=Lato:100,100i,300,300i,400,400i,700,700i,900,900i|Montserrat:300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
		
	<link href="{{ asset('public/asset/fonts/Futura/Futura.ttc') }}" rel="stylesheet">
	<link href="{{ asset('public/asset/fonts/Avenir/Avenir.ttc') }}" rel="stylesheet">
	
	<link href="https://fonts.googleapis.com/css?family=Poppins:100,400,600,700,800" rel="stylesheet">
	
	<link href="{{ asset('public/asset/css/info.css') }}" rel="stylesheet">
	<link href="{{ asset('public/asset/css/demo.css') }}" rel="stylesheet">
	<link href="{{ asset('public/asset/css/croppie.css') }}" rel="stylesheet">
	<link href="{{ asset('public/asset/css/gift.css') }}" rel="stylesheet">
	<link href="{{ asset('front/css/style.css') }}" rel="stylesheet">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
   <link href="https://cdn.jsdelivr.net/npm/pretty-checkbox@3.0/dist/pretty-checkbox.min.css" rel="stylesheet">
  
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>  
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js" ></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script>
  <script src="http://jqueryvalidation.org/files/dist/additional-methods.min.js"></script>
  
 
   
   <style type="text/css">
    @font-face {
    font-family: Avenir;
    src: url('{{ asset('front/fonts/Avenir-Book.ttf') }}');
    }
     @font-face {
    font-family: Futura;
    src: url('{{ asset('front/fonts/Futura-Medium.ttf') }}');
    }
    </style>
    
    <!-- CSS Tooltip-->
      <style>
         .ui-tooltip-content::after, .ui-tooltip-content::before {
            content: "";
            position: absolute;
            border-style: solid;
            display: block;
            left: 90px;
         }
         .ui-tooltip-content::before {
            bottom: -10px;
            border-color: #AAA transparent;
            border-width: 10px 10px 0;
         }
         .ui-tooltip-content::after {
            bottom: -7px;
            border-color: white transparent;
            border-width: 10px 10px 0;
         }
      </style>
      
      <!-- Javascript -->
      <script>
         $(function() {
            $( ".tooltips" ).tooltip({
               position: {
                  my: "center bottom",
                  at: "center top-10",
                  collision: "none"
               }
            });
         });
      </script>
  
   
</head>

<body>



@yield('header')
@yield('gift_content')
@yield('footer')


<script src="{{ asset('public/js/lightslider.js') }}"></script>
<script src="{{asset ('public/js/gift.js')}}"></script>
<script src="{{asset ('public/js/shop.js')}}"></script>
<script src="{{asset ('public/js/crop.js')}}"></script>
<script src="{{asset ('public/js/croppie.js')}}"></script>
<script src="{{asset ('public/js/demo.js')}}"></script>
<script src="{{asset ('public/js/croppie.min.js')}}"></script>
<script src="{{asset('public/asset/js/favorite.js')}}"></script>
@yield('jss')

</body>
</html>
