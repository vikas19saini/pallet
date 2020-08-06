@extends('admin.layouts.app')


@section('content')

    <form method="post" enctype="multipart/form-data">
    <div class="row">
         <!-- /.col-->
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <strong>Product Order </strong>
                    <small> view </small>
                    -
                    {{ ucfirst($type) }}
                </div>
                <div class="card-body">

                    <div class="row">
                        <div class="form-group col-sm-6">
                            <label for="title">User </label>
                            <input type="hidden" name="user_id" value="{{ $order->user_id }}" />
                            <input class="form-control" name="user" id="user" value="{{ $order->user ? $order->user->name : '' }}" type="text" required readonly placeholder="Enter your Product Title">
                        </div>

                        <div class="form-group col-sm-6">
                            <label for="tagline"> Product </label>
                            <input type="hidden" name="product_id" value="{{ $order->product_id }}" />
                            <input class="form-control" readonly id="product" value="{{ $order->product ? $order->product->title : '' }}"  required name="product" type="text" placeholder="product">
                        </div>

                        <div class="form-group col-sm-6">
                            <label for="amount">amount</label>
                            <input class="form-control" id="amount" required value="{{ $order ? $order->amount : '' }}"  readonly name="amount" type="text" placeholder="Enter amount ">
                        </div>
                        <div class="form-group col-sm-6">
                            <label for="quantity">quantity</label>
                            <input class="form-control" id="quantity" required value="{{   $order->quantity }}" readonly name="quantity" type="text" placeholder="Enter quantity ">
                        </div>

                        <div class="form-group col-sm-12">
                            <label for="address">Address</label>
                            <input class="form-control" id="address" name="address" value="{{ $order->address.','.$order->city }}">
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-sm-12">
                            <label for="status">Status</label>
                            <select name="status" class="form-control">
                                @foreach($statutes as $status)
                                    <option value="{{ $status }}" @if($status == $order->status) @endif > {{ $status }} </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <!-- /.row-->
                   <div class="row">
                       <div class="form-group">
                           <button class="button btn btn-success"> Submit </button>
                       </div>
                   </div>
                </div>
            </div>
        </div>
        <!-- /.col-->
    </div>

        {{ csrf_field() }}
    </form>

@endsection