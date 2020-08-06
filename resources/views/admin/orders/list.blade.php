@extends('admin.layouts.app')


@section('content')

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    {{ ucfirst($type) }} Orders
                    <i class="fa fa-align-justify"> </i>
                  </div>
                <div class="card-body">
                    <table class="table table-responsive-sm table-bordered table-striped table-sm">
                        <thead>
                        <tr>
                            <th> id </th>
                            <th> User Id </th>
                            <th> Product  </th>
                            <th> Amount </th>
                            <th> Quantity </th>
                            <th> Size </th>
                            <th> Status </th>
                            <th> Type </th>
                            <th> Date </th>
                            <th> Action </th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach($orders as $order)
                            <tr>
                                <td>  {{ $order->id }} </td>
                                <td>  {{ $order->user_id }} </td>
                                <td>  {{ $order->product->title }} </td>
                                <td>  {{ $order->amount }} </td>
                                <td>  {{ $order->quantity }} </td>
                                <td>  {{ $order->size }} </td>
                                <td>

                                    <span class="badge badge-success"> {{ $order->status }}</span>
                                    {{--<span class="badge badge-danger">Banned</span>--}}
                                    {{--<span class="badge badge-secondary">Inactive</span>--}}
                                    {{--<span class="badge badge-warning">Pending</span>--}}
                                    {{--<span class="badge badge-success">Active</span>--}}
                                </td>

                                <td> {{ strtoupper($type) }} </td>
                                <td> {{ $order->created_at }}</td>

                                <td>
                                    <a href="{{ url('admin/orders/'.$type.'/'.$order->id) }}"> View </a>
                                </td>

                            </tr>
                        @endforeach

                        </tbody>
                    </table>

                    {{ $orders->render() }}

                </div>
            </div>
        </div>

    </div>

@endsection