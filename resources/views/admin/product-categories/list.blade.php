@extends('admin.layouts.app')


@section('content')

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <i class="fa fa-align-justify"></i>
                    <a class="btn btn-primary" href="{{ url('admin/product-categories/add') }}"> Add  </a>
                </div>
                <div class="card-body">
                    <table class="table table-responsive-sm table-bordered table-striped table-sm">
                        <thead>
                        <tr>
                            <th> id </th>
                            <th> Name </th>
                            <th> Slug </th>
                            <th> Description </th>
                            <th> Active </th>
                            <th> Status </th>
                            <th> Created On </th>
                            <th> Action </th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach($list as $item)
                            <tr>
                                <td>  {{ $item->id }} </td>
                                <td>  {{ $item->name }} </td>
                                <td>  {{ $item->slug }} </td>
                                <td>  {{ $item->description }} </td>
                                <td>  {{ $item->active }} </td>
                                <td>  {{ $item->status }} </td>
                                <td>  {{ $item->created_at }} </td>
                                <td>
                                    <a href="{{ url('admin/product-categories/'.$item->id) }}"> Edit </a>
                                </td>

                            </tr>
                        @endforeach

                        </tbody>
                    </table>


                    {{ $list->render() }}



                </div>
            </div>
        </div>

    </div>

@endsection