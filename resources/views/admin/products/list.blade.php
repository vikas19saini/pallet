@extends('admin.layouts.app')


@section('content')

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <i class="fa fa-align-justify"></i>
                    <a class="btn btn-primary" href="{{ url('admin/products/add') }}"> Add  </a>
                </div>
                <div class="card-body">
                    <table class="table table-responsive-sm table-bordered table-striped table-sm">
                        <thead>
                            <tr>
                                <th> id </th>
                                <th> Title </th>
                                <th> Tagline </th>
                                <th> Amount </th>
                                <th> Status </th>
                                <th> Action </th>
                            </tr>
                        </thead>
                        <tbody>

                        @foreach($products as $product)
                            <tr>
                                <td>  {{ $product->id }} </td>
                                <td>  {{ $product->title }} </td>
                                <td>  {{ $product->tagline }} </td>
                                <td>  {{ $product->amount }} </td>
                                 <td>

                                    <span class="badge badge-success"> {{ $product->status }}</span>
                                    {{--<span class="badge badge-danger">Banned</span>--}}
                                    {{--<span class="badge badge-secondary">Inactive</span>--}}
                                    {{--<span class="badge badge-warning">Pending</span>--}}
                                    {{--<span class="badge badge-success">Active</span>--}}
                                </td>

                                <td>
                                    <a href="{{ url('admin/products/'.$product->id) }}"> Edit </a>
                                </td>

                            </tr>
                        @endforeach

                        </tbody>
                    </table>


                    {{ $products->render() }}

                    {{--<nav>--}}
                        {{--<ul class="pagination">--}}
                            {{--<li class="page-item">--}}
                                {{--<a class="page-link" href="#">Prev</a>--}}
                            {{--</li>--}}
                            {{--<li class="page-item active">--}}
                                {{--<a class="page-link" href="#">1</a>--}}
                            {{--</li>--}}
                            {{--<li class="page-item">--}}
                                {{--<a class="page-link" href="#">2</a>--}}
                            {{--</li>--}}
                            {{--<li class="page-item">--}}
                                {{--<a class="page-link" href="#">3</a>--}}
                            {{--</li>--}}
                            {{--<li class="page-item">--}}
                                {{--<a class="page-link" href="#">4</a>--}}
                            {{--</li>--}}
                            {{--<li class="page-item">--}}
                                {{--<a class="page-link" href="#">Next</a>--}}
                            {{--</li>--}}
                        {{--</ul>--}}
                    {{--</nav>--}}



                </div>
            </div>
        </div>

    </div>

@endsection