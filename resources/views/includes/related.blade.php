<section class="product_section similar_product">
    <div class="container">
        <div class="row">
            <h2>Similar Products</h2>
            <div class="preferences">

                <?php 
                    $catId = isset($product) && $product ? $product->product_category_id : '';
                    $relatedItems = App\Http\Controllers\ProductCtrl::relatedItems($catId);  
                ?>

                @foreach($relatedItems as $product)
                <div class="preferences1" onclick="return redirectToProductPage('{{ $product->slug }}',{{ $product->id }})">
                    <div >
                        <img src="{{ url( is_numeric($product->primary_image) ? ($product->image_primary ? $product->image_primary->location : '#') : 'img/product-images/'.$product->primary_image ) }}" class="img-responsive"/>
                        <p>
                            <span>
                                {{ $product->title }}
                                <span>
                                    <!-- <i>$ 15</i>    -->
                                    $ {{ $product->amount }} 
                                </span>
                            </span>
                                <span>
                                    <!-- <b></b><b></b><b></b><b></b> -->
                                </span></p>
                    </div>
                </div>
                @endforeach 

                <!-- <div class="preferences1">
                    <a href="product_details_IMG_0002.php">
                        <img src="img/static/IMG_0002.JPG" class="img-responsive"/>
                        <p><span>V-neck Kaftan <span><i>$ 15</i>   $ 10</span></span><span><b></b><b></b><b></b><b></b></span></p>
                    </a>
                </div>
                <div class="preferences1">
                    <a href="product_details_IMG_0003.php">
                        <img src="img/static/IMG_0003.JPG" class="img-responsive"/>
                        <p><span>V-neck Kaftan <span><i>$ 15</i>   $ 10</span></span><span><b></b><b></b><b></b><b></b></span></p>
                    </a>
                </div> -->
            </div>
        </div>
    </div>
</section>


<script>
    
    function redirectToProductPage(str,id) {
        window.location.href = "/p/"+str; //+"/"+id;
    }

</script>