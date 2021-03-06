@extends('layouts.app')

@section('content')
    <div class="banner">
        <div class="row">
            <div id="myCarousel" class="carousel slide" data-ride="carousel">
                <ol class="carousel-indicators">
                    <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                    <li data-target="#myCarousel" data-slide-to="1"></li>
                </ol>
                <div class="carousel-inner">
                    <div class="item active">
                        <img src="img/banner1.jpg" class="img-responsive banner1"/>
                        <div class="carousel-caption">
                            <div class="caption_left"></div>
                            <div class="caption_right">
                                <h2>Every Sample you order <span>becomes your Product</span></h2>
                                <p>At the Palette Store once you order any sample <span>we permanently remove the product from</span> <span>our Website for the next 14 days.</span></p>
                            </div>
                        </div>
                    </div>
                    <div class="item">
                        <img src="img/banner2.jpg" class="img-responsive banner2"/>
                        <div class="carousel-caption">
                            <div class="caption_left">
                                <h2>Our MOQ’s starts at 2 dozen </h2>
                                <p>In here you can place a bulk order starting two Dozen pieces per design.</p>
                            </div>
                            <div class="caption_right"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <section class="home_section1">
        <div class="row">
            <h2><b>OUR</b> <span>PRODUCT</span> <span>RANGE</span></h2>
            <div class="owl-carousel owl-theme product_carousel">
                <div class="item">
                    <img src="img/n/product1.jpg" class="img-responsive"/>
                    <p><a href="/scarves/c">Scarves</a><a href="/scarves/c">View Products</a></p>
                </div>
                <div class="item">
                    <p><a href="/kaftans/c">Kaftans</a><a href="/kaftans/c">View Products</a></p>
                    <img src="img/n/product2.jpg" class="img-responsive"/>
                </div>
                <div class="item">
                    <img src="img/n/product3.jpg" class="img-responsive"/>
                    <p><a href="/parios/c">Pario</a><a href="/parios/c">View Products</a></p>
                </div>
<!--                <div class="item">
                    <p><a href="/bandanas/c">Bandanas</a><a href="/bandanas/c">View Products</a></p>
                    <img src="img/n/product4.jpg" class="img-responsive"/>
                </div>
                <div class="item">
                    <img src="img/n/product5.jpg" class="img-responsive"/>
                    <p><a href="/footas/c">Footas</a><a href="/footas/c">View Products</a></p>
                </div>-->
            </div>
        </div>
    </section>

    <section class="home_section2">
        <div class="container">
            <div class="row">
                <h2>PICK OF THE WEEK</h2>
                <div class="owl-carousel owl-theme pick_carousel">
                    @foreach($products as $product)
                    <div class="item" onclick="window.location.href = '{{ url($product->slug . '/p') }}'">
                        <div class="pic_img">
                            <div class="on_img">
                                <img src="{{ url('img/product-images/' . $product->primary_image) }}" class="img-responsive" />
                            </div>
                            <div class="summer_btn"><a href="#"><button>SHOP NOW</button></a></div>
                        </div>
                        <div class="pick_text">
                            <h2>{{ $product->title }}</h2>
                            <p>Price: ${{ $product->amount }}</p>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>


<!--    <section class="home_section4">
        <div class="row">
            <div class="owl-carousel owl-theme inspiration_carousel">
                <div class="item" data-img="inspiration1.jpg" data-heading="Pastel paisleys <span>dominating</span> Summer - 19">
                    <div class="inspiration_img">
                        <img src="img/inspiration1.jpg" class="img-responsive"/>
                    </div>
                    <div class="inspiration_text">
                        <h2>Pastel paisleys <span>dominating Summer - 19</span></h2>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor </p>
                        <a href="javascript:void(0);">Read More...</a>
                    </div>
                </div>
                <div class="item" data-img="inspiration2.jpg" data-heading="Pastel paisleys <span>dominating</span> Summer - 19">
                    <div class="inspiration_img">
                        <img src="img/inspiration2.jpg" class="img-responsive"/>
                    </div>
                    <div class="inspiration_text">
                        <h2>Pastel paisleys <span>dominating Summer - 19</span></h2>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor </p>
                        <a href="javascript:void(0);">Read More...</a>
                    </div>
                </div>
                <div class="item" data-img="inspiration2.jpg" data-heading="Pastel paisleys <span>dominating</span> Summer - 19">
                    <div class="inspiration_img">
                        <img src="img/inspiration2.jpg" class="img-responsive"/>
                    </div>
                    <div class="inspiration_text">
                        <h2>Pastel paisleys <span>dominating Summer - 19</span></h2>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor </p>
                        <a href="javascript:void(0);">Read More...</a>
                    </div>
                </div>
            </div>

            <div class="inspiration_categories">
                <div class="inspiration_prev">
                    <img src="img/inspiration2.jpg" class="img-responsive dynamic_img1"/>
                    <h2 class="dynamic_text1">Pastel paisleys <span>dominating</span> Summer - 19</h2>
                </div>
                <div class="inspiration_next">
                    <img src="img/inspiration2.jpg" class="img-responsive dynamic_img2"/>
                    <h2 class="dynamic_text2">Pastel paisleys <span>dominating</span> Summer - 19</h2>
                </div>
            </div>

            <div class="inspiration_next_area">
            <div class="arrow_right">
  <a href="#">View Next Story <span class="arrow_nxt"><span></span></span></a>
</div>
            <div class="inspiration_heading"><h2>INSPIRA<span>TIONS</span></h2></div>

        </div>
        </div>
    </section>-->
@endsection



@section('pageLevelJS')
    <script>
        /* bootstrap carousel pause on hover not working */
        $('.carousel').carousel({
            pause: "false",
            interval: 7000
        });

        $('.product_carousel').owlCarousel({
            loop:false,
            margin:40,
            nav:true,
            autoplay:false,
            autoplayTimeout:4000,
            stagePadding: 100,
            navText: ['<img src="img/left_arrow.png">', '<img src="img/right_arrow.png">' ],
            responsive:{
                0:{
                    items:1,
                    stagePadding: 50,
                    margin:30
                },
                768:{
                    items:3
                }
            }
        });
        $('.pick_carousel').owlCarousel({
            loop:false,
            margin:0,
            nav:true,
            autoplay:false,
            autoplayTimeout:4000,
            navText: ['<img src="img/left_arrow.png">', '<img src="img/right_arrow.png">' ],
            responsive:{
                0:{
                    items:1,
                    stagePadding: 50,
                    margin:30
                },
                768:{
                    items:3,
                    slideBy:3
                }
            }
        });


        $('.inspiration_carousel').owlCarousel({
            loop:true,
            margin:0,
            nav:true,
            autoplay:false,
            autoplayTimeout:4000,
            navText: ['', '' ],
            responsive:{
                0:{
                    items:1
                }
            }
        });
        $(document).ready(function() {
            $(".inspiration_prev").click(function () {
                $(".inspiration_carousel").trigger('prev.owl.carousel')
            });
            $(".inspiration_next").click(function () {
                $(".inspiration_carousel").trigger('next.owl.carousel')
            });
            $(".inspiration_next_area>span").click(function () {
                $(".inspiration_carousel").trigger('next.owl.carousel')
            });
        });
        setInterval(function(){
            $(".inspiration_carousel .owl-item.active").prev().addClass('prevdiv');
            $(".inspiration_carousel .owl-item.active").siblings().prev().removeClass('prevdiv');
            $(".inspiration_carousel .owl-item.active").next().addClass('nextdiv');
            $(".inspiration_carousel .owl-item.active").siblings().next().removeClass('nextdiv');
            var dynamic = $(".owl-item.prevdiv .item").attr("data-img");
            var dynamic2 = $(".owl-item.nextdiv .item").attr("data-img");
            $(".dynamic_img1").attr("src" , "img/" + dynamic);
            $(".dynamic_img2").attr("src" , "img/" + dynamic2);
            var dynamic3 = $(".owl-item.prevdiv .item").attr("data-heading");
            var dynamic4 = $(".owl-item.nextdiv .item").attr("data-heading");
            $(".dynamic_text1").html(dynamic3);
            $(".dynamic_text2").html(dynamic4);

        }, 1000);


        setInterval(function(){
            if($(window).width() <= 767){
                $(".banner1").attr("src", "img/mobile_banner.jpg");
                $(".banner2").attr("src", "img/banner2.jpg");
            }
        });

        /*
        setInterval(function(){
           if($(window).width() <= 767){
              $('.owl-carousel').owlCarousel('destroy');
              $('.inspiration_carousel, .product_carousel, .pick_carousel').removeClass("owl-carousel");
            }
        });
        */

    </script>
@endsection