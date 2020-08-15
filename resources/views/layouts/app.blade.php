<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <meta http-equiv="x-ua-compatible" content="ie=edge"/>
    <link rel="shortcut icon" href="{{ url('img/favicon.png') }}" type=""/>

    @if( isset($meta) )
        <title> {{ $meta['title'] }} | Palette Store </title>
        <meta name="description" content="{{ $meta['keywords'] }}" />
        <meta name="keywords" content="{{ $meta['description'] }}" />
    @else
        <title> Palatte Store || Home</title>
    @endif


    <link rel="stylesheet" type="text/css" href="{{ url('css/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ url('css/aos.css') }}"/>
    <link rel="stylesheet" type="text/css" href="{{ url('css/owl.carousel.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ url('css/header.css') }}"/>
    <link rel="stylesheet" type="text/css" href="{{ url('css/footer.css') }}"/>
    <link rel="stylesheet" type="text/css" href="{{url('css/style.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ url('css/responsive.css') }}">
    @yield('pageLevelCSS')

    <!--[if lt IE 8]>
    <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
    <![endif]-->

    <style>
        .navigation ul li a {
            color: #655b5b;
        }
    </style>

</head>
<body class="main_header">

<!-- header area start -->
@include("includes.header")
<!-- header area end -->

@if(\Illuminate\Support\Facades\Session::has('message'))
<div class="row">
    <div class="alert alert-success">
        {{ Session::get('message') }}
    </div>
</div>
@endif

@yield('content')

<!-- footer area start -->
@include("includes.footer")
<!-- footer area end -->


<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script>
    window.jQuery || document.write('<script src="{{ url('js/jquery-1.12.0.min.js') }}"><\/script>')
</script>
<script type="text/javascript" src="{{ url('js/bootstrap.min.js') }}"></script>
<script type="text/javascript" src="{{ url('js/aos.js') }}"></script>
<script type="text/javascript" src="{{ url('js/smoothScroll.min.js') }}"></script>
<script type="text/javascript" src="{{ url('js/owl.carousel.js') }}"></script>
<script type="text/javascript" src="{{ url('js/palatte_store.js') }}"></script>
<script type="text/javascript" src="{{ url('js/magiczoomplus.js') }}"></script>

@yield('pageLevelJS')

</body>
</html>