@extends('admin.layouts.app')


@section('content')

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <i class="fa fa-align-justify"></i>
                    Payments 
                    <!-- <a class="btn btn-primary" href="{{ url('admin/products/add') }}"> Add  </a> -->
                </div>
                <div class="card-body">
                    <table class="table table-responsive-sm table-bordered table-striped table-sm">
                        <thead>
                            <tr>
                                <th> id </th>
                                <th> User </th>
                                <th> Amount </th>
                                <th> Gateway </th>
                                <th> Product Title </th>
                                <th> Status </th>
                                <!-- <th> Action </th> -->
                            </tr>
                        </thead>
                        <tbody>

                        @foreach($payments as $payment)
                            <tr>
                                <td>  {{ $payment->id }} </td>
                                <td>  {{ $payment->user_id." / ".$payment->user->name }} </td>
                                <td>  {{ $payment->total_amount }} </td>
                                <td>  {{ isset($payment->paymentProvider) ? $payment->paymentProvider->name : $payment->payment_provider_id  }} </td>
                                <td>
                                    <a href="{{ url('admin/products/'.$payment->product_id) }}"> 
                                        {{ $payment->product->title }}
                                    </a>  
                                </td>

                                <td>

                                    @if($payment->payment_status == "PLACED" )
                                        <span class="badge badge-success"> PLACED  </span>
                                    @else
                                        <span class="badge badge-warning">Pending</span>
                                    @endif 

                                    {{--<span class="badge badge-danger">Banned</span>--}}
                                    {{--<span class="badge badge-secondary">Inactive</span>--}}
                                    {{--<span class="badge badge-warning">Pending</span>--}}
                                    {{--<span class="badge badge-success">Active</span>--}}
                                </td>

                                <!-- <td> -->
                                    <!-- <a href="{{ url('admin/payments/'.$payment->id) }}"> Edit </a> -->
                                <!-- </td> -->

                            </tr>
                        @endforeach

                        </tbody>
                    </table>


                    {{ $payments->links() }}


                </div>
            </div>
        </div>

    </div>

@endsection