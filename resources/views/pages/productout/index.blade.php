@extends('layouts.dashboard')
@section('content')
<section class="content">
    <div class="row">
      <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Transaksi Out</h3>
                <div class="row">
                    <br>
                    <form action="{{ route('productout.index') }}" method="GET">
                    <div class="col-md-9">
                        @can('productout-create')
                            <a href="javascript:void(0)" class="btn btn-primary mb-2" data-toggle="modal" data-target="#modal-add" id="btn-create-post">Add Transaction Out</a>
                        @endcan
                    </div>
                    <div class="col-md-3">
                        <div class="input-group">
                            <input type="text" name="search" class="form-control" placeholder="search customer">
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
                        <th>transaction code</th>
                        <th>transaction date</th>
                        <th>Customer</th>
                        <th>User</th>
                        <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($productouts as $i => $data)
                    <tr>
                        <td>{{ $i + 1 }}</td>
                        <td>{{ $data->productout_code }}</td>
                        <td>{{ $data->date }}</td>
                        <td>{{ $data->customer->name }}</td>
                        <td>{{ $data->user->name }}</td>
                        <td>
                            @can('productout-update')
                                <a href="{{ route('productout.edit', $data->id) }}" id="btn-edit-productout" data-id="{{ $data->id }}" class="btn btn-success btn-sm"><i class="fa fa-fw fa-pencil"></i></a>
                            @endcan
                            @can('productout-delete')
                                <a href="javascript:void(0)" id="btn-delete-productout" data-id="{{ $data->id }}" class="btn btn-danger btn-sm"><i class="fa fa-fw fa-trash"></i></a>                                
                            @endcan
                        </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
                <div class="d-flex justify-content-center">
                    {!! $productouts->links() !!}
                </div>
            </div>
        </div>
      </div>
    </div>
</section> 

@include('pages.productout.create')

@push('after-script')
<script>
    function addProductOut(){
        var form = new FormData($('#addForm')[0]);
        $('#addForm .error-text').text('');
        let base_url = $('#base_url').val();
        $.ajax({
            url: "{{ route('productout.store') }}",
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
                    text: 'Data Berhasil disimpan',
                    icon: 'success',
                    showConfirmButton: false,
                    timer: 2000,
                    willClose: () => {
                        window.location.href = `${base_url}/productout/${response.data.id}/edit`;
                    }
                });
            },
            error:function(errors){
                $.each(errors.responseJSON, function( key, value ) {
                    $('#modal-add .'+key+'_error').text(value[0]);
                });                                
            }
        })
    }

    $('body').on('click', '#btn-delete-productout', function () {
        let productout_id = $(this).data('id');
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
                    url: `{{ url('/') }}/productout/${productout_id}`,
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