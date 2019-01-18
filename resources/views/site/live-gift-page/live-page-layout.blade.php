<!DOCTYPE html>
<html>
<head>
	<title>Fynches</title>
	<link rel="shortcut icon" type="image/png" href="{{asset('favicon.png')}}"/>
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	
	<meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:site" content="@fynches">
    <meta name="twitter:title" content="@isset($gift_page->page_title){{$gift_page->page_title}}@endisset">
    <meta name="twitter:description" content="@isset($gift_page->page_desc){{$gift_page->page_desc}}@endisset">
    <meta name="twitter:image" content="@isset($child_image)http://fynches.codeandsilver.com{{$child_image}}@endisset">
    <meta name="twitter:domain" content="fynches.com">
    
    <meta property="og:url"                content="http://fynches.codeandsilver.com/gift-page/{{$gift_page->slug}}" />
    <meta property="og:type"               content="page" />
    <meta property="og:title"              content="@isset($gift_page->page_title){{$gift_page->page_title}}@endisset" />
    <meta property="og:description"        content="@isset($gift_page->page_desc){{$gift_page->page_desc}}@endisset" />
    <meta property="og:image"              content="@isset($child_image)http://fynches.codeandsilver.com{{$child_image}}@endisset" />
	
	<meta name=viewport content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	<link href="https://fonts.googleapis.com/css?family=Lato:100,100i,300,300i,400,400i,700,700i,900,900i|Montserrat:300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
		
	<link href="{{ asset('public/asset/fonts/Futura/Futura.ttc') }}" rel="stylesheet">
	<link href="{{ asset('public/asset/fonts/Avenir/Avenir.ttc') }}" rel="stylesheet">
	
	<link href="https://fonts.googleapis.com/css?family=Poppins:100,400,600,700,800" rel="stylesheet">
	
	<link href="{{ asset('public/asset/css/info.css') }}" rel="stylesheet">
		<link href="{{ asset('public/asset/css/live_page.css') }}" rel="stylesheet">
	<link href="{{ asset('public/asset/css/gift.css') }}" rel="stylesheet">
	<link href="{{ asset('front/css/style.css') }}" rel="stylesheet">

	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
   <link href="https://cdn.jsdelivr.net/npm/pretty-checkbox@3.0/dist/pretty-checkbox.min.css" rel="stylesheet">
  
   
   
   
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script src="{{asset('public/js/live-gift.js')}}"></script> 
   
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
  
   
</head>

<body>



@yield('header')
@yield('live_content')
@yield('footer')


@yield('jss')

</body>
</html>
