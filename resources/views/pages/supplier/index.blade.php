@extends('layouts.dashboard')
@section('content')
<section class="content">
    <div class="row">
      <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Data Supplier</h3>
                <div class="row">
                    <br>
                    <form action="{{ route('supplier.index') }}" method="GET">
                    <div class="col-md-9">
                        @can('supplier-create')
                            <a href="javascript:void(0)" class="btn btn-primary mb-2" data-toggle="modal" data-target="#modal-add" id="btn-create-post">Add Supplier</a>                            
                        @endcan
                    </div>
                    <div class="col-md-3">
                        <div class="input-group">
                            <input type="text" name="search" class="form-control" placeholder="search">
                                <span class="input-group-btn">
                                  <button type="submit" class="btn btn-info btn-flat">Search</button>
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
                        <th>Supplier Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Addres</th>
                        <th>Webstite</th>
                        <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($suppliers as $i => $supplier)
                    <tr>
                        <td>{{ $i + $suppliers->firstItem() }}</td>
                        <td>{{ $supplier->name }}</td>
                        <td>{{ $supplier->email }}</td>
                        <td>{{ $supplier->phone }}</td>
                        <td>{{ $supplier->address }}</td>
                        <td>{{ $supplier->website }}</td>
                        <td>
                            @can('supplier-update')
                                <a href="javascript:void(0)" id="btn-edit-supplier" data-id="{{ $supplier->id }}" class="btn btn-success btn-sm"><i class="fa fa-fw fa-pencil"></i></a>                                
                            @endcan
                            @can('supplier-delete')
                                <a href="javascript:void(0)" id="btn-delete-supplier" data-id="{{ $supplier->id }}" class="btn btn-danger btn-sm"><i class="fa fa-fw fa-trash"></i></a>
                            @endcan
                        </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
                <div class="d-flex justify-content-center">
                    {!! $suppliers->links() !!}
                </div>
            </div>
        </div>
      </div>
    </div>
</section> 

@include('pages.supplier.create')
@include('pages.supplier.edit')

@push('after-script')
<script>
    function addSupplier(){
        var form = new FormData($('#addForm')[0]);
        $('.error-text').text('');
        $.ajax({
            url: "{{ route('supplier.store') }}",
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

    $('body').on('click', '#btn-edit-supplier', function () {
        let supplier_id = $(this).data('id');
        let base_url = $('#base_url').val();
        $('#modal-edit').modal('show');
        $('#modal-edit input[type="checkbox"]').prop('checked', false);
        $.ajax({
            url: `${base_url}/supplier/${supplier_id}/edit`,  
            type: "GET",
            cache: false,
            success:function(response){
                $('#supplier_id').val(response.data.id);
                $('#name-edit').val(response.data.name);
                $('#email-edit').val(response.data.email);
                $('#phone-edit').val(response.data.phone);
                $('#website-edit').val(response.data.website);
                $('#address-edit').val(response.data.address);
                $('#modal-edit').modal('show');
            }
        });
    });

    function updateSupplier(){
        var form = new FormData($('#editForm')[0]);
        var supplier_id  =$('#supplier_id').val();     
        $('.error-text').text('');   
        $.ajax({
            url: "{{ url('/') }}/supplier/"+supplier_id,
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

    $('body').on('click', '#btn-delete-supplier', function () {
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
                    url: `{{ url('/') }}/supplier/${user_id}`,
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