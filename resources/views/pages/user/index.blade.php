@extends('layouts.dashboard')
@section('content')
<section class="content">
    <div class="row">
      <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Data User</h3>
                <div class="row">
                    <br>
                    <form action="{{ route('user.index') }}" method="GET">
                    <div class="col-md-9">
                        @can('user-create')
                            <a href="javascript:void(0)" class="btn btn-primary mb-2" data-toggle="modal" data-target="#modal-add" id="btn-create-post">Add User</a>                            
                        @endcan
                    </div>
                    <div class="col-md-3">
                        <div class="input-group">
                            <input type="text" name="search" class="form-control">
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
                        <th>User Name</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($users as $i => $user)
                    <tr>
                        <td>{{ $i + $users->firstItem() }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                            @if (!empty($user->getRoleNames()))
                                @foreach($user->getRoleNames() as $role)
                                <label class="badge badge-success">{{ $role }}</label>
                                @endforeach                                
                            @endif
                        </td>
                        <td>
                            @can('user-update')
                                <a href="javascript:void(0)" id="btn-edit-user" data-id="{{ $user->id }}" class="btn btn-success btn-sm"><i class="fa fa-fw fa-pencil"></i></a>
                            @endcan
                            @can('user-delete')
                                <a href="javascript:void(0)" id="btn-delete-user" data-id="{{ $user->id }}" class="btn btn-danger btn-sm"><i class="fa fa-fw fa-trash"></i></a>
                            @endcan
                        </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
                <div class="d-flex justify-content-center">
                    {!! $users->links() !!}
                </div>
            </div>
        </div>
      </div>
    </div>
</section> 

@include('pages.user.create')
@include('pages.user.edit')

@push('after-script')
<script>
    function addUser(){
        var form = new FormData($('#addForm')[0]);
        $('.error-text').text('');
        $.ajax({
            url: "{{ route('user.store') }}",
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

    $('body').on('click', '#btn-edit-user', function () {
        let id_user = $(this).data('id');
        let base_url = $('#base_url').val();
        $('#modal-edit input[type="checkbox"]').prop('checked', false);
        $.ajax({
            url: `${base_url}/user/${id_user}/edit`,  
            type: "GET",
            cache: false,
            success:function(response){
                $('#user_id').val(response.data.id);
                $('#name-edit').val(response.data.name);
                $('#email-edit').val(response.data.email);
                $.each(response.data_roles, function( key, role ) {
                    $('#modal-edit input[type="checkbox"][value="' + role.name + '"]').prop('checked', true);
                });                                
                $('#modal-edit').modal('show');
            }
        });
    });

    function updateUser(){
        var form = new FormData($('#editForm')[0]);
        var user_id  =$('#user_id').val();     
        $('.error-text').text('');   
        $.ajax({
            url: "{{ url('/') }}/user/"+user_id,
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

    $('body').on('click', '#btn-delete-user', function () {
        let user_id = $(this).data('id');
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
                    url: `{{ url('/') }}/user/${user_id}`,
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