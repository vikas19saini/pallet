@extends('admin.layouts.app')


@section('content')

    <form method="post" enctype="multipart/form-data">
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
                            <div class="form-group col-sm-6">
                                <label for="name">Name</label>
                                <input class="form-control" name="name" id="name" value="{{ $category ? $category->name : '' }}" type="text" required placeholder="Enter Name">
                            </div>


                            <div class="form-group col-sm-6">
                                <label for="slug">Slug</label>
                                <input class="form-control" name="slug" id="slug" value="{{ $category ? $category->slug : '' }}" type="text" required placeholder="Enter Slug">
                            </div>


                            <div class="form-group col-md-6">
                                <label for="status"> Category </label>
                                <select class="form-control" name="status" id="status" required>
                                    @foreach($statuses as $status)
                                        <option value="{{ $status }}" @if( $category && $category->status == $status) selected @endif>
                                            {{ $status }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-sm-6">
                                <label for="thumbnail"> Images </label>
                                <select data-live-search="true" class="form-control" name="thumbnail" id="thumbnail" value="{{ $category ? $category->thumbnail : '' }}">
                                    @if($category && $category->thumnailImage )
                                        <option value="{{ $category->thumbnail }}" selected> {{ $category->thumnailImage->title}} </option>
                                    @endif 
                                </select>
                            </div>


                        </div>

                        <div class="row">
                            <div class="form-group col-sm-12">
                                <label for="description">description</label>
                                <input class="form-control" required name="description" id="description" type="text"
                                       placeholder="Enter description" value="{{ $category ? $category->description : '' }}" />
                            </div>

                        </div>

                        <div class="row">
                            <div class="form-group col-sm-6">
                                <label for="meta_title">Meta Title</label>
                                <input class="form-control" required name="meta_title" id="meta_title" type="text"
                                       placeholder="Enter Meta Title" value="{{ $category ? $category->meta_title : '' }}"/>
                            </div>

                            <div class="form-group col-sm-6">
                                <label for="meta_keyword">Meta Keyword</label>
                                <input class="form-control" required name="meta_keyword" id="meta_keyword" type="text"
                                       placeholder="Enter Meta Keyword" value="{{ $category ? $category->meta_keyword : '' }}" />
                            </div>

                            <div class="form-group col-sm-12">
                                <label for="meta_description">Meta Description</label>
                                <textarea class="form-control" required name="meta_description" id="meta_description" type="text"
                                          placeholder="Enter Meta Description">{{ $category ? $category->meta_description : '' }}</textarea>
                            </div>

                        </div>

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


    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>

    <script>
        
        $('select#thumbnail').selectpicker(); 

        $("input[role='textbox']").on('keyup',function(e){
            var searchText = this.value;
            text_to_search(searchText);
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
                        $("select#thumbnail").append(html);
                        $('select#thumbnail').selectpicker('refresh');
                    }
                }); 
        }

    </script>

@endsection 