@extends('layouts.app')

@section('content')

    <section class="product_section">
        <div class="container">
            @if(count($products) > 0)
            <div class="row">
                <div class="col-sm-12">
                    <form method="GET">
                        <div class="row">
                        <h2> {{ !empty($category) ? $category->name : 'Products' }}</h2>
                
<!--                -<ul>
                    <li>
                        <select name="filter_sort" id="filter_sort">
                            <option value="" selected disabled>Sort By</option>
                            <option value="price_asc"> Price (Asc) </option>
                            <option value="price_desc"> Price (Desc) </option>
                            <option value="latest"> Latest </option>
                            <option value="oldest"> Oldest </option>

                        </select>
                    </li>
                    <li>
                        <select name="filter_material" id="filter_material">
                            <option value="" selected disabled>Select Material</option>
                            @foreach($fabrics as $item)
                                <option value="{{ $item->id }}"> {{ $item->name}} </option>
                            @endforeach 
                        </select>
                    </li>
                    <li>
                        <select>
                            <option>Price</option>
                        </select>
                    </li>
                    <li class="btn btn-primary">
                        <button style="width: 100%;background-color: transparent;border: none"> Search </button> 
                         <select>
                            <option>Colour</option>
                        </select> 
                    </li>
                </ul>-->
                        </div>
                    </form> 
                </div>
            </div>
            @endif
            <div class="row">
                <div class="preferences">                 
                    @if(count($products) > 0)
                        @foreach($products as $product)
                            <div class="preferences1" onclick="return redirectToPage('{{ $product->slug }}',{{ $product->id }})">
                                @if( $product->primary_image && !is_numeric($product->primary_image) )
                                    <img src="{{ url($product->primary_image ? 'img/product-images/'.$product->primary_image : '#') }}" class="img-responsive"/>
                                    <p>
                                        <span>{{ $product->title }} <span>
                                            $ {{ $product->amount }}</span>
                                            </span>
                                            </p>

                                @else
                                    <img src="{{ url($product->image_primary ? $product->image_primary->location : '#') }}" class="img-responsive"/>
                                    <p><span>{{ $product->title }} <span>
                                            {{--<i>$ 30</i> --}}
                                            $ {{ $product->amount }}</span>
                                            </span>
                                            <span>
                                                <!-- <b></b><b></b><b></b><b></b> -->
                                                </span>
                                            </p>
                                @endif 
                            </div>
                        @endforeach
                     @else
                     <div class="empty-list">
                         <img src="{{ url('img/logo2.png') }}">
                        <h1>We couldn't find any product!</h1>
                        <button type="button" onclick="window.history.back()">GO BACK</button>
                     </div>
                     @endif

                </div>

                {{ $products->render() }}
            </div>
        </div>
    </section>

@endsection


@section('pageLevelJS')


    <script>

        $(document).ready(function() {
            $(".filter1>p").click(function(){
                $(".mobile_filter").addClass("active");
            });
            $(".mobile_filter_close").click(function(){
                $(".mobile_filter").removeClass("active");
            });
        });

        function redirectToPage(str,id) {
            window.location.href = "/p/"+str; //+"/"+id;
        }


    </script>


@endsection