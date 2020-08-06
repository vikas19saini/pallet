@extends('admin.layouts.app')


@section('content')

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    Fabric  

                    <a href="{{ url('/admin/fabrics/add') }}" class="btn btn-primary"> Add </a> 

                    <!-- <i class="fa fa-align-justify"> </i> -->
                  </div>
                <div class="card-body">
                    <table class="table table-responsive-sm table-bordered table-striped table-sm">
                        <thead>
                        <tr>
                            <th> id </th>
                            <th> Name </th>
                            <th> Code  </th>
                            <th> Active </th>
                            <th> Action </th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach($list as $item)
                            <tr>
                                <td>  {{ $item->id }} </td>
                                <td>  {{ $item->name }} </td>
                                <td>  {{ $item->code }} </td>
                               
                               <td>
                                    @if($item->active)
                                    <span class="badge badge-success"> Active </span>
                                    @else
                                    <span class="badge badge-danger">Inactive</span>
                                    @endif 
                                </td>

                                <td>
                                    <a href="{{ url('admin/fabrics/'.$item->id) }}"> View </a>
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