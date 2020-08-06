@extends('layouts.app')

@section('content')
<section class="myaccount_section">
        <div class="container">
            <div class="row">
                <h2>My Account</h2>
                <div class="myaccount_main">
                    
                    @include('includes.account-leftside-bar')

                    <div class="myaccount_right tab-content">
                        <h2>Welcome {{ Auth::user()->name  ?? 'USER'}},</h2>
                        <p>To your private corner of The Pallete store. You can manage your orders, returns, account info and convert sample order into order right here.</p>


                        <div class="overview tab-pane in active" id="myaccount5">
                            

                        <h2>My preferences</h2>
                            <p>Welcome to your preferences section of The Pallete store. You can convert your preferences into sample order right here.</p>
                            <div class="preferences">

                                @foreach($preferences  as $item)

                                <?php
                                    if ( $item->product->primary_image && !is_numeric($item->product->primary_image) )
                                        $image = $item->product->primary_image ? 'img/product-images/'.$item->product->primary_image : '#';  
                                    else
                                        $image = $item->product->image_primary ? $item->product->image_primary->location : '#';
                                ?>

                                    <div class="preferences1" >
                                        <img src="{{ url( $image ) }}" class="img-responsive" onclick="return redirectToProduct({{ $item->id}}, '{{$item->slug}}')" />
                                        <p  onclick="return redirectToProduct({{ $item->id}}, '{{$item->slug}}')" >
                                            <span>
                                                {{ $item->product->title }}
                                            
                                                <span>
                                                    <!-- <i>$ 30</i>    -->
                                                    $ {{ $item->product->amount }} 
                                                </span>
                                            </span>
                                                <!-- <span><b></b><b></b><b></b><b></b></span> -->
                                            </p>
                                        <h3> {{ $item->product->status}} </h3>
                                        <!-- <a href="javascript:void(0);">SHOW SIMILAR</a> -->
                                        <div onclick="return removeFromWishlist({{ $item->product_id }})" class="close"></div>
                                    </div>
                                @endforeach 

                                @if( count( $preferences ) == 0 )
                                    No Item In Wishlist 
                                @endif 
                            
                            </div>

                        </div>

                    </div>
                </div>
                <div class="subscribe_banner">
                    <!-- <a href="javascript:void(0);"><img src="img/subscribe_banner.jpg" class="img-responsive"/></a> -->
                </div>
            </div>
        </div>

     {{ csrf_field() }}
    </section>



<div class="filter1">
    <p>Filter</p>
</div>

<div class="mobile_filter">
    <div class="mobile_show_filter">
        <h3>Filter By</h3>
        <div class="accordion">
            <h4 class="accordion-toggle">Short By</h4>
            <div class="accordion-content">
                <ul>
                    <li><a href="javascript:void(0);">Short By1</a></li>
                </ul>
            </div>
            <h4 class="accordion-toggle">Material</h4>
            <div class="accordion-content">
                <ul>
                    <li><a href="javascript:void(0);">Short By1</a></li>
                </ul>
            </div>
            <h4 class="accordion-toggle">Price</h4>
            <div class="accordion-content">
                <ul>
                    <li><a href="javascript:void(0);">Short By1</a></li>
                </ul>
            </div>
            <h4 class="accordion-toggle">Colour</h4>
            <div class="accordion-content">
                <ul>
                    <li><a href="javascript:void(0);">Short By1</a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="mobile_filter_close">
        <a href="javascript:void(0);">CLOSE</a>
    </div>
</div>

@endsection

@section('pageLevelJS')
  
    <script>

        function redirectToProduct(id,str)
        {
            window.location.href = "{{ url('/') }}" + "/" + id + "/p"; 
        }

        function removeFromWishlist(id)
        {
            $.ajax({
                url: '/ajax/product/'+id+'/wishlist',
                method : 'post',
                data: { _token: '{{ csrf_token() }}' },
                success: function(response) { 
                    if(response.status)
                    {
                        window.location.reload(); 
                    } 
                }
            }); 
            return false;
        }

    </script>

@endsection

