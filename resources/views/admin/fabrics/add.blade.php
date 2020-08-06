@extends('admin.layouts.app')


@section('content')

    <form action="{{ url('admin/fabrics/'.($fabric ? $fabric->id : '')) }}" method="post" enctype="multipart/form-data">
        <div class="row">
            <!-- /.col-->
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <strong>Fabric</strong>
                        <small>Form</small>
                    </div>
                    <div class="card-body">

                        <div class="row">
                            <div class="form-group col-sm-6">
                                <label for="name">Name</label>
                                <input class="form-control" name="name" id="name" value="{{ $fabric ? $fabric->name : '' }}" type="text" required placeholder="Enter Name">
                            </div>


                            <div class="form-group col-sm-6">
                                <label for="code">Code</label>
                                <input class="form-control" name="code" id="code" value="{{ $fabric ? $fabric->code : '' }}" type="text" required placeholder="Enter code">
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-sm-6">
                                <label for="active">active</label>
                                <select class="form-control" required name="active" id="active">
                                <option value="0" {{ $fabric ? !$fabric->active : 'selected'  }}> Inactive </option>
                                <option value="1" {{ $fabric ? $fabric->active : 'selected'  }}> Active </option>
                                </select>
                                    
                            </div>

                            <div class="form-group col-sm-6">
                                <label for="gsm">GSM</label>
                                <input class="form-control" name="gsm" id="gsm" value="{{ $fabric ? $fabric->gsm : '' }}" type="number" required placeholder="Enter gsm">
                            </div>

                        </div>

                        <div class="row">
                            <div class="form-group col-sm-6">
                                <label for="content">Content</label>
                                <input class="form-control" name="content" id="content" value="{{ $fabric ? $fabric->content : '' }}" type="text" required placeholder="Enter content">
                            </div>


                            <div class="form-group col-sm-6">
                                <label for="count">Count</label>
                                <input class="form-control" name="count" id="count" value="{{ $fabric ? $fabric->count : '' }}" type="text" required placeholder="Enter count">
                            </div>

                            <div class="form-group col-sm-6">
                                <label for="construction">Construction</label>
                                <input class="form-control" name="construction" id="construction" value="{{ $fabric ? $fabric->construction : '' }}" type="text" required placeholder="Enter construction">
                            </div>

                            <div class="form-group col-sm-6">
                                <label for="certification">Certification</label>
                                <input class="form-control" name="certification" id="certification" value="{{ $fabric ? $fabric->certification : '' }}" type="text" required placeholder="Enter certification">
                            </div>

                            <div class="form-group col-sm-6">
                                <label for="usability">Usability</label>
                                <input class="form-control" name="usability" id="usability" value="{{ $fabric ? $fabric->usability : '' }}" type="text" required placeholder="Enter usability">
                            </div>
                            
                            <div class="form-group col-sm-6">
                                <label for="weight">Weight</label>
                                <input class="form-control" name="weight" id="weight" value="{{ $fabric ? $fabric->weight : '' }}" type="number" required placeholder="Enter weight">
                            </div>
                            

                        </div>

                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <button class="button btn btn-success"> Submit </button>
                                </div>
                            </div>
                        </div>

                    </div>

                    <!-- /.row-->
                  
                </div>
            </div>
        </div>
        <!-- /.col-->
        </div>

        {{ csrf_field() }}
    </form>

@endsection