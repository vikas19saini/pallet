@extends('layouts.app')

@section('pageLevelCSS')
<link rel="stylesheet" href="{{ url('css_new/style.css') }}">
@endsection

@section('content')

<section>
    <div class="container">
        <div class="inner_first desk_view">
            <h2>We Make Scarves Using Upcycled Fabrics</h2>
        </div>
    </div>
</section>

<section>
    <div class="container">
        <div class="curetion_sec">
            <div class="row">
                <div class="col-md-6">
                    <h4>All products ({{ $products->total() }})</h4>
                </div>
                <div class="col-md-6">
                    <div class="desk_view">
                        <div class="inner_drop">
                            <div class="drop_menu inner_filtter">
                                <ul>
                                    <li><a href="javascript:void()">Filtter</a>
                                        <ul class="custom_drop inherit">
                                            @foreach($categories as $category)
                                            <li><a href="/{{ $category->slug }}/c">{{ $category->name }}</a></li>
                                            @endforeach
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                            <div class="drop_menu desk_view">
                                <ul>
                                    <li><a href="javascript:void()">Sort</a>
                                        <ul class="custom_drop custm_sort">
                                            <li><a href="?filter_sort=price_asc">Price low to high</a></li>
                                            <li><a href="?filter_sort=price_desc">Price high to low</a></li>
                                            <li><a href="?filter_sort=latest">Newest first</a></li>
                                            <li><a href="?filter_sort=oldest">Oldest first</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="top_mob">
                <div class="row mob_view">
                    <div class="col-md-6">
                        <div class="drop_menu">
                            <ul>
                                <li><a href="javascript:void()">Sort</a>
                                    <ul class="custom_drop custm_sort">
                                        <li><a href="?filter_sort=price_asc">Price low to high</a></li>
                                        <li><a href="?filter_sort=price_desc">Price high to low</a></li>
                                        <li><a href="?filter_sort=latest">Newest first</a></li>
                                        <li><a href="?filter_sort=oldest">Oldest first</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="inner_drop">
                            <div class="drop_menu inner_filtter">
                                <ul>
                                    <li><a href="#">Filtter</a>
                                        <ul class="custom_drop inherit">
                                            <ul>
                                                @foreach($categories as $category)
                                                <li><a href="/{{ $category->slug }}/c">{{ $category->name }}</a></li>
                                                @endforeach
                                            </ul>
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">

            @foreach($products as $index => $product)
            @if($index === 1)
            <div class="inner_first first_mb mob_view">
                <h2>We Make Scarves Using Upcycled Fabrics</h2>
            </div>
            @endif
            <div class="col-lg-4 col-md-4">
                <div class="content_img" onclick="return redirectToPage('{{ url( $product->slug) }}')">
                    @if( $product->primary_image && !is_numeric($product->primary_image) )
                    <img src='{{ url($product->primary_image ? 'img/product-images/'.$product->primary_image : '#') }}' alt="" class="img-fluid">
                    @else
                    <img src='{{ url($product->image_primary ? $product->image_primary->location : '#') }}' alt="" class="img-fluid">
                    @endif

                    <div class="product_detail">
                        <p>{{ $product->category->name }}
                            <span><i class="fa fa-usd" aria-hidden="true"></i><strong>{{ $product->amount }}</strong><b class="align_bttm">(3 Pieces)</b></span></p>
                        <h3>{{ $product->title }} </h3>

                        @if(!empty($product->total_created))
                        <div class="inner_colum">
                            <p>Pieces Created</p>
                            <h5>{{ $product->total_created }}</h5>
                        </div>
                        @endif

                        @if($product->total_quantity)
                        <div class="bdr_hidden inner_colum">
                            <p>In Stock</p>
                            <h5>{{ $product->total_quantity }} Left.</h5>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<section class="product_section">
    <div class="container">
        <div class="row">
            {{ $products->appends($_GET)->links() }}
        </div>
    </div>
</section>

@endsection


@section('pageLevelJS')


<script>
    $(document).ready(function() {
        $(".filter1>p").click(function() {
            $(".mobile_filter").addClass("active");
        });
        $(".mobile_filter_close").click(function() {
            $(".mobile_filter").removeClass("active");
        });
    });

    function redirectToPage(url) {
        window.location.href = url + "/p";
    }
</script>
<script>
    $(document).ready(function() {
        $(".img-fluid").mouseover(function() {
            $(this).next('.product_detail').addClass('open_detail');
        });
        $(".img-fluid").mouseout(function() {
            $(this).next('.product_detail').removeClass('open_detail');
        });
    });
</script>

@endsection