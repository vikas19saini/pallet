<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <link rel="shortcut icon" href="img/favicon.png" type="" />
    <title> Thepalettestore Store</title>
    <link rel="stylesheet" type="text/css" href="{{ url('css_new/bootstrap.min.css')}}" />
    <link rel="stylesheet" type="text/css" href="{{ url('css/style.css')}}" />
    <link rel="stylesheet" type="text/css" href="{{ url('css/footer.css')}}" />
    <link rel="stylesheet" type="text/css" href="{{ url('css/responsive.css')}}" />
    <link rel="stylesheet" type="text/css" href="{{ url('css_new/style.css')}}" />
    <!--[if lt IE 8]>
        <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
</head>

<body>
    <div class="container">
        <div class="top_logo">
            <a href="/"><img src="{{ url('img/logo.svg') }}" width="150px" alt=""></a></div>
    </div>
    <section class="form_sec sec_fixed">
        <div class="container">
            <div class="row">
                <div class="col-lg-5 col-md-5 contant_wrap">
                    <div class="inner_top_hd collection_bttn">
                        <h1 class="hide desk_view">We Make Patchworks <span>Using Upcycled Fabrics</span></h1>
                        <h1 class="hide mob_view">We Make <span>Patchworks Using </span>Upcycled Fabrics</h1>
                        <p class="click content_a"><a href="javascript:void(0)" class="hello">View Collection</a></p>
                        <p class="mob_show"><a href="#show_form">View Collection</a></p>
                    </div>
                </div>
                <div class="col-lg-7 col-md-7">
                    <div class="inner_top_img"><img src="{{ url('img/transition_img.gif') }}" alt="" class="img-fluid"></div>
                </div>
            </div>
        </div>
    </section>
    <section class="form_sec form_scrll" id="secound_sec">
        <div class="container">
            <div class="row">
                <div class="col-lg-7">
                    <div class="form_custom content_b" id="show_form">
                        <div class="content_b_content">
                            <h2>Hi There !</h2>
                            <p>You are a step away to view our products , simply fill the below info.</p>
                            @yield('content')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="fttr_bttm">
        @include("includes.footer")
    </div>
    <script src="https://code.jquery.com/jquery-1.12.0.min.js"></script>
    <script type="text/javascript" src="{{ url('js/bootstrap.min.js') }}"></script>
    <script type="text/javascript" src="{{ url('js/palatte_store.js') }}"></script>
    <script>
        $("[href^='#']").click(function() {
            id = $(this).attr("href")
            $('html, body').animate({
                scrollTop: $(id).offset().top
            }, 700);
        });
    </script>
    <script>
        $(document).ready(function() {
            $(".click").click(function() {
                $(".hide").hide();
            });
        });
    </script>
    <script>
        $('.hello').click(function() {
            $(".content_b").fadeIn();
            $(".content_b_content").animate({
                marginTop: "-=100px"
            }, 400);
        });
    </script>
</body>

</html>