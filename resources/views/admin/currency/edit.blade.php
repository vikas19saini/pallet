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
                                <label for="currency">currency</label>
                                <input class="form-control" name="currency" id="currency" value="{{ $currency ? $currency->currency : '' }}" type="text" required placeholder="Enter Currency Name">
                            </div>


                            <div class="form-group col-sm-6">
                                <label for="country">country</label>
                                <input class="form-control" name="country" id="country" value="{{ $currency ? $currency->country : '' }}" type="text" required placeholder="Enter country">
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-sm-6">
                                <label for="active">active</label>
                                <input class="form-control" required name="active" id="active" type="text"
                                       placeholder="Enter description" value="{{ $currency && $currency->active ? '1' : '0' }}" />
                            </div>

                            <div class="form-group col-sm-6">
                             <input type="checkbox" name="is_primary" {{ $currency && $currency->is_primary == 1 ? 'checked' : '' }} /> 
                             Is Primary ? 
                                <!-- <label class="is_primary">Is Primary </label>  -->
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-sm-6">
                                <label for="conversion_factor">Conversion Factor <small>( 1 Primary Currency = N this currency) </small> </label>
                                <input class="form-control" name="conversion_factor" id="conversion_factor" value="{{ $currency ? $currency->conversion_factor : '1' }}" type="text" required placeholder="Conversion Factor">
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