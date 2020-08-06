@extends('admin.layouts.app')


@section('content')

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <i class="fa fa-align-justify"></i>
                    List Users
{{--                    <a class="btn btn-primary" href="{{ url('admin/users/add') }}"> Add  </a>--}}
                </div>
                <div class="card-body">
                    <table class="table table-responsive-sm table-bordered table-striped table-sm">
                        <thead>
                            <tr>
                                <th> Id </th>
                                <th> Name </th>
                                <th> Email </th>
                                <th> Mobile </th>
                                <th> Company Name </th>
                                <th> Company Details </th>
                                <th> Alternative Mobile </th>
                                <th> Registered At </th>
                                {{--<th> Status </th>--}}
                                {{--<th> Action </th>--}}
                            </tr>
                        </thead>
                        <tbody>

                        @foreach($users as $user)
                            <tr>
                                <td>  {{ $user->id }} </td>
                                <td>  {{ $user->name }} </td>
                                <td>  {{ $user->email }} </td>
                                <td>  {{ $user->mobile }} </td>
                                <td>  {{ $user->company_name }} </td>
                                <td>  {{ $user->company_details }} </td>
                                <td>  {{ $user->alternative_mobile }} </td>

                                <td> {{ $user->created_at }} </td>
                                {{--<td>--}}
                                    {{--<a href="{{ url('admin/products/'.$product->id) }}"> Edit </a>--}}
                                {{--</td>--}}

                            </tr>
                        @endforeach

                        </tbody>
                    </table>


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