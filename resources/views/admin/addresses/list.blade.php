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
                                <th> User </th>
                                <th> Gender </th>
                                <th> Contact NO </th>
                                <th> Add. Name </th>
                                <th> Address </th>
                                <th> City </th>
                                <th> Zipcode </th>
                                <th> State </th>
                                <th> Country </th>
                                <th> Created At </th>
                            </tr>
                        </thead>
                        <tbody>

                        @foreach($addresses as $address)
                            <tr>
                                <td>  {{ $address->id }} </td>
                                <td>  {{  $address->user_id .' - '.$address->user->name }} </td>
                                <td>  {{ $address->salution }} </td>
                                <td>  {{ $address->contact_no }} </td>
                                <td>  {{ $address->name }} </td>
                                <td>  {{ $address->address }} </td>
                                <td>  {{ $address->city }} </td>
                                <td>  {{ $address->zipcode }} </td>
                                <td>  {{ $address->state_obj ? $address->state_obj->name : $address->state }} </td>
                                <td>  {{ $address->country_obj ? $address->country_obj->name : $address->country }} </td>
                                <td> {{ $address->created_at }} </td>
                            </tr>
                        @endforeach

                        </tbody>
                    </table>

                    {{ $addresses->render() }}

                </div>
            </div>
        </div>

    </div>

@endsection