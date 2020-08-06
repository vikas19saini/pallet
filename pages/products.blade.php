@extends('layouts.app')

@section('content')

    <section class="product_section">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <form method="GET">
                        <div class="row">
                        <h2> {{ !empty($category) ? $category->name : 'Products' }}</h2>
                
                <ul>
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
                        <button style="width: 100%;background-color: transparent;border: none;%"> Search </button> 
                        <!-- <select>
                            <option>Colour</option>
                        </select> -->
                    </li>
                </ul>
                        </div>
                    </form> 
                </div>
            </div>
            <div class="row">
                <div class="preferences">


                    {{--<div class="preferences1">--}}
                        {{--<img src="img/preferences.jpg" class="img-responsive"/>--}}
                        {{--<p><span>V-neck Kaftan <span><i>$ 30</i>   $ 24</span></span><span><b></b><b></b><b></b><b></b></span></p>--}}
                    {{--</div>--}}

                    @foreach($products as $product)
                        <div class="preferences1" onclick="return redirectToPage('{{ $product->slug }}',{{ $product->id }})">
                            <img src="{{ url($product->image_primary ? $product->image_primary->location : '#') }}" class="img-responsive"/>
                            <p><span>{{ $product->title }} <span>
                                        {{--<i>$ 30</i> --}}
                                        INR {{ $product->amount }}</span></span><span><b></b><b></b><b></b><b></b></span></p>
                        </div>
                    @endforeach


                </div>

                {{ $products->render() }}

                <!-- <div class="product_button"><button>VIEW MORE</button></div> -->
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