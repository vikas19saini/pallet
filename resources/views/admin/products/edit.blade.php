@extends('admin.layouts.app')


@section('content')

    <form method="post" enctype="multipart/form-data" >
    <div class="row">
         <!-- /.col-->
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <strong>Product</strong>
                    <small>Form</small>
                </div>
                <div class="card-body">

                    <div class="row">
                        <div class="col-sm-8">
                            <div class="row">
                                <div class="form-group col-sm-6">
                                    <label for="title">Title</label>
                                    <input class="form-control" name="title" id="title" value="{{ $product ? $product->title : '' }}" type="text" required placeholder="Enter your Product Title">
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="slug"> Slug </label>
                                    <input class="form-control"  type="text" name="slug" id="slug"  value="{{ $product ? $product->slug  : '' }}" placeholder="Enter Slug" /> 
                                </div>

                                <div class="form-group col-sm-6">
                                    <label for="tagline">tagline</label>
                                    <input class="form-control" id="tagline" value="{{ $product ? $product->tagline : '' }}"  required name="tagline" type="text" placeholder="tagline">
                                </div>

                                <div class="form-group col-sm-6">
                                    <label for="amount">amount</label>
                                    <input class="form-control" id="amount" required value="{{ $product ? $product->amount : '' }}"  name="amount" type="text" placeholder="Enter amount ">
                                </div>
                                <div class="form-group col-sm-6">
                                    <label for="product_key">product_key</label>
                                    <input class="form-control" id="product_key" required value="{{ $product ? $product->product_key : '' }}"  name="product_key" type="text" placeholder="Enter product key ">
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="category"> Category </label>
                                    <select class="form-control" name="category" id="category" required>
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}" @if( $product && $product->product_category_id == $category->id) selected @endif>
                                                {{ $category->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>


                                <div class="form-group col-md-12">
                                    <label for="status"> Status </label>
                                    <select class="form-control" name="status" id="status" required>
                                    @foreach($statuses as $status)
                                        <option value="{{ $status }}" @if( $product && $product->status == $status) selected @endif>
                                            {{ $status }}
                                        </option>
                                    @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-4" style="border-left: 1px solid grey">
                            <div class="row"> 
                                <div class="col-sm-12 form-group">
                                    <label for="color"> Add Color </label> 
                                    <input type="text" id="color" name="color" class="form-control" pattern="([0-9A-F]{2}){3}|([0-9a-f]{2}){3}" /> 
                                </div> 

                                <div class="col-sm-12" >
                                    <label class="button btn btn-success" onclick="return add_color();" value="Submit">Add </button>
                                </div>
                            </div>


                            <div class="row">
                                <div class="col-sm-12">
                                    
                                    <!-- <label class="button btn" style="border-radius: 17px;background-color: #443344"> 
                                        <i class="fa fa-close"></i> 
                                    </label> -->

                                    @if($product)
                                        @foreach( $product->productColors as $item )
                                        <label class="button btn" 
                                            onclick="return removeColor({{$item->id}})"
                                            style="border-radius: 17px;background-color: #{{ $item->color_code }}"> 
                                            <i class="fa fa-close"></i> 
                                        </label>
                                        @endforeach 
                                    @endif 

                                </div>
                            </div>
                        </div> 

                    </div> 
                    

                    <div class="row">
                        <div class="form-group col-sm-12">
                            <label for="description">description</label>
                            <input class="form-control" required name="description" id="description" type="text"
                                      placeholder="Enter description" value="{{ $product ? $product->description : '' }}" />
                        </div>
                    </div>

                    <div class="row">
                            <div class="form-group col-sm-6">
                                <label for="start_percentage">
                                     Start % 
                                </label>
                                <input class="form-control" required name="start_percentage" id="start_percentage" type="number"
                                        placeholder="Enter % Start" value="{{ $product ? $product->start_percentage : '' }}" />
                            </div>

                            <div class="form-group col-sm-6">
                                <label for="end_percentage">
                                     End % 
                                </label>
                                <input class="form-control" required name="end_percentage" id="end_percentage" type="number"
                                        placeholder="Enter % End" value="{{ $product ? $product->end_percentage : '' }}" />
                            </div>
                        </div>
                      
                        <div class="row">
                            <div class="form-group col-sm-6">
                                <label for="range_start">
                                    Range Start <small> (in dozens) </small>
                                </label>
                                <input class="form-control" required name="range_start" id="range_start" type="number"
                                        placeholder="Enter Range Start" value="{{ $product ? $product->range_start : '' }}" />
                            </div>

                            <div class="form-group col-sm-6">
                                <label for="range_start">
                                    Range End <small> (in dozens) </small> 
                                </label>
                                <input class="form-control" required name="range_end" id="range_end" type="number"
                                        placeholder="Enter Range End" value="{{ $product ? $product->range_end : '' }}" />
                            </div>
                        </div>
                      


                    



                    <div class="row">
                        <div class="col-sm-12">

                            <label for="description"> Price For Fabrics </label>
                            <div class="row" style="padding: 20px;margin-bottom: 20px">
                            <?php if($product) $product_has_fabrics=$product->product_has_fabrics; else $product_has_fabrics=$fabrics; ?> 
                
                                @foreach($product_has_fabrics as $item) 
                                    <div class="col-sm-6">
                                        <label for="description"> Price % change For {{ $item->fabric ? $item->fabric->name : $item->name}} </label>
                                        <input class="form-control" name="price[{{ $item->fabric ? $item->fabric_id : $item->id }}]" type="number"
                                                placeholder="Enter Price Percentage" value="{{ $product ? $item->amount : '' }}" step="0.01" />
                                    </div>
                                @endforeach 
                            </div>
                        </div> 

                    </div>

                    <div class="row">
                        <div class="form-group col-sm-6">
                            <label for="meta_title">Meta Title</label>
                            <input class="form-control" required name="meta_title" id="meta_title" type="text"
                                      placeholder="Enter Meta Title" value="{{ $product ? $product->meta_title : '' }}"/>
                        </div>

                        <div class="form-group col-sm-6">
                            <label for="meta_keyword">Meta Keyword</label>
                            <input class="form-control" required name="meta_keyword" id="meta_keyword" type="text"
                                      placeholder="Enter Meta Keyword" value="{{ $product ? $product->meta_keyword : '' }}" />
                        </div>

                        <div class="form-group col-sm-12">
                            <label for="meta_description">Meta Description</label>
                            <textarea class="form-control" required name="meta_description" id="meta_description" type="text"
                                      placeholder="Enter Meta Description">{{ $product ? $product->meta_description : '' }}</textarea>
                        </div>



                    </div>


                    <div class="row" >
                        <!-- <div class="form-group col-sm-6">
                            <label for="description">Primary Image</label>
                            <input type="text" accept="image/*" name="primary_image" value="{{ $product ? $product->primary_image : '' }}"/>
                        </div> -->


                        <div class="col-sm-12">
                            <label for="primary_image"> Images </label>
                            <select data-live-search="true" class="form-control" name="primary_image" id="primary_image" value="{{ $product ? $product->primary_image : '' }}">
                                <!-- @if($product && $productImages)
                                    @foreach($productImages as $item)
                                        <option selected value="{{ $item->id }}" > {{ $item->title}} </option>
                                    @endforeach
                                @endif                              -->
                            </select>
                        </div>

                        @if($product)
                        <div class="form-group col-sm-6">
                            <label for="description">Image</label>
                            <img class="img img-responsive" height="200px" src="{{ url( $product->image_primary ?  $product->image_primary->location : '#') }}" width="200px" />
                        </div>
                        @endif
                    </div>


                    <div class="row" style="padding: 20px;">
                        <br />
                        <br />
                        <br />
                    </div>

                    <div class="row">

<!-- 
                        <div class="form-group col-sm-12">
                            <label for="other_images"> Other Image <small>(Comma seperated) </small>  </label>
                            <input class="form-control" type="text" name="other_images" value="{{ $product ? $product->other_images : '' }}" />
                        </div> -->

                        <div class="col-sm-12">
                            <label for="multi_select"> Images </label>
                            <select data-live-search="true" class="form-control" name="multi_select[]" id="multi_select" multiple="multiple">
                                @if($product && $productImages)
                                    @foreach($productImages as $item)
                                        <option selected value="{{ $item->id }}" > {{ $item->title}} </option>
                                    @endforeach
                                @endif                             
                            </select>
                        </div>

                    </div>



                    @if( isset($productImages) )
                        <div class="row">
                            <!-- otherimages -->
                            @foreach($productImages as $item)
                                <div class="form-group col-sm-3">
                                    <label >Image</label>
                                    <img class="img img-responsive" width="200px" height="200px" src="{{ url($item->location) }}" />
                                </div>
                            @endforeach
                        </div>
                    @endif

                    <!-- /.row-->
                    <div class="form-group">
                        <button class="button btn btn-success"> Submit </button>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.col-->
    </div>

        {{ csrf_field() }}
    </form>


@endsection


@section('pageLevelJS')
<script>

        // function submitForm()
        // {
        //     var selectedValues = $('select#multi_select').val();
        //     console.log(selectedValues);
        //     return false;
        // }

        function add_color()
        {
            var color = $("#color").val(); 
            if(  !document.getElementById('color').validity.patternMismatch ) {
                $.ajax({
                    url: '/admin/ajax/product/{{$product ? $product->id : ''}}/color',
                    method : 'post',
                    data: { color: color,_token: '{{ csrf_token() }}' },
                    success: function() {
                        window.location.reload(); 
                    }
                }); 

            }            
            return false; 
        }

        function removeColor(color_id)
        {
            $.ajax({
                    url: '/admin/ajax/product/{{$product ? $product->id : ''}}/color/'+color_id+'/delete',
                    method : 'post',
                    data: { color: color_id,_token: '{{ csrf_token() }}' },
                    success: function() {
                        window.location.reload(); 
                    }
                }); 
        }
    </script>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>

    <script>
        
        $('select#multi_select').selectpicker(); 

        $('select#primary_image').selectpicker(); 

        $("input[role='textbox']").on('keyup',function(e){
            var searchText = this.value;

            var id = this.parentNode.parentNode.parentNode.parentNode.children[0].getAttribute('for'); 
            // var id = $("input[role='textbox']")[0].parentNode.parentNode.parentNode.parentNode.children[0].getAttribute('for');
            text_to_search(searchText,id);
        }); 

        $("#amount").on('keyup',function(e){
            var value =this.value; 
            $("input[name^='price']").each(function(){
                // this.value =
                // if( !this.value || isNaN(this.value) ) 
                    // this.value = value; 
                // console.log([isNaN(this.value),this.value,value]); 
            })
        });

        function text_to_search(searchText,id)
        {
            $.ajax({
                    url: '/admin/ajax/media/search?q='+searchText,
                    method : 'get',
                    success: function(data) {
                        var html = '';
                        for( var item in data) {
                            html += "<option value='"+data[item].id+"'> "+data[item].title+" </option>";
                        }
                        console.log(id);
                        $("select#"+id).append(html);
                        $('select#'+id).selectpicker('refresh');
                    }
                }); 
        }

    </script>

@endsection 