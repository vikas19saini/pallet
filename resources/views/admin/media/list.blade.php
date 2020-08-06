@extends('admin.layouts.app')


@section('content')

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <i class="fa fa-align-justify"></i>
                    <a class="btn btn-primary" href="{{ url('admin/media/upload/add') }}"> Add  </a>
                </div>
                <div class="card-body">
                    <table class="table table-responsive-sm table-bordered table-striped table-sm">
                        <thead>
                            <tr>
                                <th> id </th>
                                <th> Title </th>
                                <th> Alt </th>
                                <th> Caption </th>
                                <th> Type </th>
                                <th> Action </th>
                            </tr>
                        </thead>
                        <tbody>

                        @foreach($mediaList as $item)
                            <tr>
                                <td>  {{ $item->id }} </td>
                                <td>  {{ $item->title }} </td>
                                <td>  {{ $item->alt }} </td>
                                <td>  {{ $item->caption }} </td>
                                <td>  {{ $item->type }} </td>

                                <td>
                                    <a href="{{ url('admin/media/upload/'.$item->id) }}"> Edit </a>
                                    <a href="#" onclick="return deleteMedia({{ $item->id }})"> Delete </a>
                                </td>

                            </tr>
                        @endforeach

                        </tbody>
                    </table>


                   {{ $mediaList->render() }}


                </div>
            </div>
        </div>

    </div>



@endsection 

    @section('pageLevelJS')
<script>
    function deleteMedia(id) 
    {
        var  confirm = window.confirm("Are you sure you want to delete this media"); 

        if(confirm == false)
                return false; 

        $.ajax({
                    url: '/admin/ajax/media/'+id+'/delete',
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