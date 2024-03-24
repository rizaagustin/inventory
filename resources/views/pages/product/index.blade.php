@extends('layouts.dashboard')
@section('content')
<section class="content">
    <div class="row">
      <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Data Product</h3>
                <div class="row">
                    <br>
                    <form action="{{ route('product.index') }}" method="GET">
                    <div class="col-md-9">
                        @can('product-create')
                            <a href="javascript:void(0)" class="btn btn-primary mb-2" data-toggle="modal" data-target="#modal-add" id="btn-create-post">Add Product</a>
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
                        <th>Image</th>
                        <th>Product Name</th>
                        <th>Uom</th>
                        <th>Stock</th>
                        <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($products as $i => $product)
                    <tr>
                        <td>{{ $i + $products->firstItem() }}</td>
                        <td><img src="{{ $product->image }}" class="img-fluid img-thumbnail" style="width: 200px"></td>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->uom }}</td>
                        <td>{{ $product->stock }}</td>
                        <td>
                            @can('product-update')
                                <a href="javascript:void(0)" id="btn-edit-product" data-id="{{ $product->id }}" class="btn btn-success btn-sm"><i class="fa fa-fw fa-pencil"></i></a>                                
                            @endcan
                            @can('product-delete')
                                <a href="javascript:void(0)" id="btn-delete-product" data-id="{{ $product->id }}" class="btn btn-danger btn-sm"><i class="fa fa-fw fa-trash"></i></a>
                            @endcan
                        </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
                <div class="d-flex justify-content-center">
                    {!! $products->links() !!}
                </div>
            </div>
        </div>
      </div>
    </div>
</section> 

@include('pages.product.create')
@include('pages.product.edit')

@push('after-script')
<script>
    function addProduct(){
        var form = new FormData($('#addForm')[0]);
        $('.error-text').text('');
        $.ajax({
            url: "{{ route('product.store') }}",
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

    $('body').on('click', '#btn-edit-product', function () {
        let id_product = $(this).data('id');
        let base_url = $('#base_url').val();
        $('#modal-edit input[type="checkbox"]').prop('checked', false);
        $.ajax({
            url: `${base_url}/product/${id_product}/edit`,  
            type: "GET",
            cache: false,
            success:function(response){
                $('#id_product').val(response.data.id);
                $('#name-edit').val(response.data.name);
                $('#uom-edit').val(response.data.uom);
                $('#description-edit').val(response.data.description);
                $('#modal-edit').modal('show');
            }
        });
    });

    function updateProduct(){
        var form = new FormData($('#editForm')[0]);
        var id_product  =$('#id_product').val();     
        $('.error-text').text('');   
        $.ajax({
            url: "{{ url('/') }}/product/"+id_product,
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

    $('body').on('click', '#btn-delete-product', function () {
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
                    url: `{{ url('/') }}/product/${user_id}`,
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