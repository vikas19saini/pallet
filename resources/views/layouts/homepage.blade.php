<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1"/>
        <meta http-equiv="x-ua-compatible" content="ie=edge"/>
        <link rel="shortcut icon" href="img/favicon.png" type=""/>
        <title> Thepalettestore Store</title>
        <link rel="stylesheet" type="text/css" href="{{ url('css/bootstrap.min.css')}}" />
        <link rel="stylesheet" type="text/css" href="{{ url('css/pagepiling.css')}}" />
        <link rel="stylesheet" type="text/css" href="{{ url('css/style.css')}}" />
        <link rel="stylesheet" type="text/css" href="{{ url('css/responsive.css')}}" />
        <!--[if lt IE 8]>
        <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->  
    </head>
    <body class="landing-page">
        <div id="pagepiling">
            <section class="landing_section1 section" id="section1">  
                <div class="container">
                    <div class="row">
                        <img src="{{ url('img/logo.png')}}" class="img-responsive">
                        <div class="landing_login">

                            <div class="landing_login_text">
                                <h2>WE USE</h2>
                                <h3>Organic, Recycled & sustainable materials</h3>
                            </div>        

                            <div class="landing_login_form" id="logreg-forms">
                                @yield('content')
                            </div>
                        </div> 
                    </div>
                </div>  
            </section>

            <section class="landing_section2 section" id="section2">  
                <div class="container">
                    <div class="row">
                        <div class="work_section_main"> 
                            <div class="work_section">
                                <h2>HOW WE <span>WORK ?</span></h2>
                                <div class="work_icon">
                                    <div class="work_icon1">
                                        <img src="{{url('img/work_icon1.png')}}" class="img-responsive"/>
                                        <p>Register with us</p>
                                        <span></span>
                                    </div>
                                    <div class="work_icon1">
                                        <img src="{{url('img/work_icon2.png')}}" class="img-responsive"/>
                                        <p>See our <span>Designs/Products</span></p>
                                        <span class="span2"></span>
                                    </div>
                                    <div class="work_icon1">
                                        <img src="{{url('img/work_icon3.png')}}" class="img-responsive"/>
                                        <p>Order Samples</p>
                                        <span></span>
                                    </div>
                                    <div class="work_icon1">
                                        <img src="{{url('img/work_icon4.png')}}" class="img-responsive"/>
                                        <p>Order Bulk</p>
                                    </div>
                                </div>
                            </div>
                        </div>  
                    </div>
                </div>  
            </section>

            <section class="landing_section3 section" id="section3"> 
                <div class="row">
                    <div class="landing3_heading">
                        <h2><span>KAFTANS</span></h2>
                    </div>
                    <p class="things_text">THINGS WE DO</p>
                </div>
            </section>

            <section class="landing_section3 section" id="section4"> 
                <div class="row">
                    <div class="landing3_heading">
                        <h2><span>SCARVES</span></h2>
                    </div>
                    <p class="things_text">THINGS WE DO</p>
                </div>
            </section>

            <section class="landing_section3 section" id="section5"> 
                <div class="row">
                    <div class="landing3_heading">
                        <h2><span>PARIOS</span></h2>
                    </div>
                    <p class="things_text">THINGS WE DO</p>
                </div>
            </section>

<!--            <section class="landing_section3 section" id="section6"> 
                <div class="row">
                    <div class="landing3_heading">
                        <h2><span>BANDANAS</span></h2>
                    </div>
                    <p class="things_text">THINGS WE DO</p>
                </div>
            </section>

            <section class="landing_section3 section" id="section7"> 
                <div class="row">
                    <div class="landing3_heading">
                        <h2><span>FOOTAS</span></h2>
                    </div>
                    <p class="things_text">THINGS WE DO</p>
                </div>
            </section>-->

        </div>

    </body>

<script src="https://code.jquery.com/jquery-1.12.0.min.js"></script>
<script>window.jQuery || document.write('<script src="js/jquery-1.12.0.min.js"></script>')</script>
<script type="text/javascript" src="{{ url('js/bootstrap.min.js') }}"></script>
<script type="text/javascript" src="{{ url('js/pagepiling.min.js')}}"></script>
<script type="text/javascript" src="{{ url('js/jquery.countdown.min.js')}}"></script>
<script type="text/javascript" src="{{ url('js/palatte_store.js') }}"></script>

<script>

$(document).ready(function () {
    $('#pagepiling').pagepiling({
        navigation: {
            'position': 'left',
        }
    });
});
</script>


</body>
</html> 