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
                                <label for="title">Name</label>
                                <input class="form-control" name="title" id="title" value="{{ $media ? $media->title : '' }}" type="text" required placeholder="Enter title">
                            </div>


                            <div class="form-group col-sm-6">
                                <label for="caption">Caption</label>
                                <input class="form-control" name="caption" id="caption" value="{{ $media ? $media->caption : '' }}" type="text" required placeholder="Enter caption">
                            </div>


                            <div class="form-group col-md-12">
                                <label for="type"> Type </label>
                                <select class="form-control" name="type" id="type" required>
                                    @foreach($type as $item)
                                        <option value="{{ $item }}" @if( $media && $media->type == $item) selected @endif>
                                            {{ $item }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                        </div>

                        <div class="row">
                            <div class="form-group col-sm-12">
                                <label for="alt">Alt</label>
                                <input class="form-control" required name="alt" id="alt" type="text"
                                       placeholder="Enter description" value="{{ $media ? $media->alt : '' }}" />
                            </div>
                        </div>


                        <div class="form-group col-sm-12">
                            <label for="description">Attachment</label>
                            <input type="file" accept="image/*"  @if(!$media) multiple name="attachment[]" required @else name="attachment" @endif  />
                        </div>

                        @if($media)
                             <img src="{{ url($media->location) }}" />
                        @endif

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