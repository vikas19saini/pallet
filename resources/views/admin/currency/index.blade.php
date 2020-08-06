@extends('admin.layouts.app')


@section('content')

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <i class="fa fa-align-justify"></i>
                    <a class="btn btn-primary" href="{{ url('admin/currencies/add') }}"> Add  </a>
                </div>
                <div class="card-body">
                    <table class="table table-responsive-sm table-bordered table-striped table-sm">
                        <thead>
                        <tr>
                            <th> Id </th>
                            <th> Currency </th>
                            <th> Country </th>
                            <th> Active </th>
                            <th> Primary </th> 
                            <th> Conversion Factor </th>                             
                            <th> Created </th>
                            <th> Action </th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach($list as $item)
                            <tr>
                                <td>  {{ $item->id }} </td>
                                <td>  {{ $item->currency }} </td>
                                <td>  {{ $item->country }} </td>
                                <td>  {{ $item->active }} </td>
                                <td>  {{ $item->is_primary ? 'True' : ' False ' }} </td>
                                <td>  {{ $item->is_primary ?  1 : $item->conversion_factor }} </td>
                                <td>  {{ $item->created_at }} </td>

                                <td>
                                    <a href="{{ url('admin/currencies/'.$item->id) }}"> Edit </a>
                                    <a href="#" onclick="return deleteCurrency({{ $item->id }})"> Delete </a>
                                </td>

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


<script>

    function deleteCurrency(currencyId)
    {
        var  confirm = window.confirm("Are you sure you want to delete this currency");
        if(confirm == false)
            return false; 

        $.ajax({
            url: '/admin/ajax/currencies/'+currencyId+'/delete',
            method : 'post',
            data: { _token: '{{ csrf_token() }}' },
            success: function(response) {
                if(response.status)
                    window.location.reload(); 
            }
        }); 
        return false; 
    }

</script>

@endsection


