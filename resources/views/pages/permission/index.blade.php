@extends('layouts.dashboard')
@section('content')
<!-- Main content -->
<section class="content">
    <div class="row">
      <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Permission</h3>
                <div class="row">
                    <br>
                    <form action="{{ route('permission.index') }}" method="GET">
                    <div class="col-md-9">
                        @can('permission-index')
                            <a href="javascript:void(0)" class="btn btn-primary mb-2" data-toggle="modal" data-target="#modal-add" id="btn-create-post">Add Permission</a>
                        @endcan
                    </div>
                    <div class="col-md-3">
                        <div class="input-group">
                            <input type="text" name="search" class="form-control" placeholder="search">
                                <span class="input-group-btn">
                                  <button type="button" class="btn btn-info btn-flat">Search</button>
                                </span>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
            <div class="box-body">
                <table id="" class="table table-bordered table-hover">
                  <thead>
                    <tr>
                        <th width="5%">#</th>
                        <th>Permission</th>
                        <th></th>
                    </tr>
                  </thead>
                  <tbody>
                        @foreach ($permissions as $i => $data)
                        <tr>
                            <td>{{ $i + $permissions->firstItem() }}</td>
                            <td>{{ $data->name }}</td>
                            <td>
                                @can('pemission-update')
                                    <a href="javascript:void(0)" id="btn-edit-permission" data-id="{{ $data->id }}" class="btn btn-success btn-sm" title="update"><i class="fa fa-fw fa-pencil"></i></a>
                                @endcan
                                @can('permission-delete')
                                    <a href="javascript:void(0)" id="btn-delete-permission" data-id="{{ $data->id }}" class="btn btn-danger btn-sm" title="delete"><i class="fa fa-fw fa-trash"></i></a>
                                @endcan
                            </td>
                        </tr>
                        @endforeach
                  </tbody>
                </table>
                <div class="d-flex justify-content-center">
                    {!! $permissions->links() !!}
                </div>
            </div>
        </div>
      </div>
    </div>
</section>    

@include('pages.permission.create')
@include('pages.permission.edit')

@push('after-script')
<script>
    function addPermission(){
        var form = new FormData($('#addPermisionForm')[0]);
        $.ajax({
            url: "{{ route('permission.store') }}",
            type: "POST",
            data: form,
            contentType: false,
            processData: false,
            dataType: 'json',
            beforeSend:function(){
            },
            success:function(response){
                $('#modal-add').modal('hide');
                Swal.fire({
                    text: 'Data Has Been Created',
                    icon: 'success',
                    showConfirmButton: false,
                    timer: 2000,
                    willClose: () => {
                        location.reload();
                    }
                });
            },
            error:function(errors){
                $.each(errors.responseJSON, function( key, value ) {
                    $('.'+key+'_error').text(value[0]);
                });                                
            }
        })
    }

    $('body').on('click', '#btn-edit-permission', function () {
        let id_permission = $(this).data('id');
        let base_url = $('#base_url').val();
        $.ajax({
            url: `${base_url}/permission/${id_permission}/edit`,  
            type: "GET",
            cache: false,
            success:function(response){
                $('#permission_id').val(response.data.id);
                $('#name-edit').val(response.data.name);
                $('#modal-edit').modal('show');
            }
        });
    });

    function updatePermission(){
        var form = new FormData($('#editPermisionForm')[0]);
        var id_permission  =$('#permission_id').val();        
        $.ajax({
            url: "{{ url('/') }}/permission/"+id_permission,
            type: "POST",
            data: form,
            contentType: false,
            processData: false,
            dataType: 'json',
            headers: {
                'X-HTTP-Method-Override': 'PUT'
            },
            beforeSend:function(){
                
            },
            success:function(response){
                $('#modal-edit').modal('hide');
                Swal.fire({
                    text: 'Data Has Been Updated',
                    icon: 'success',
                    showConfirmButton: false,
                    timer: 2000,
                    willClose: () => {
                        location.reload();
                    }
                });
            },
            error:function(errors){
                $.each(errors.responseJSON, function( key, value ) {
                    $('.'+key+'_error').text(value[0]);
                });                                
            }
        })

    }

    $('body').on('click', '#btn-delete-permission', function () {
        let post_id = $(this).data('id');
        let token   = $("meta[name='csrf-token']").attr("content");
        Swal.fire({
            title: 'Do you want to delete?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            cancelButtonText: 'NO',
            confirmButtonText: 'YES, DELETE!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: `{{ url('/') }}/permission/${post_id}`,
                    type: "DELETE",
                    cache: false,
                    data: {
                        "_token": token
                    },
                    success:function(response){ 
                        Swal.fire({
                            type: 'success',
                            icon: 'success',
                            title: `${response.message}`,
                            showConfirmButton: false,
                            timer: 2000,
                            willClose: () => {
                                location.reload();
                            }
                        });
                    }
                });                
            }
        })
    });

</script>
@endpush
@endsection
