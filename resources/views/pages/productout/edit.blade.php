@extends('layouts.dashboard')
@section('content')
<section class="content">
<div class="row">
    <div class="col-md-4">
        <div class="box box-primary">
            <div class="box-header">
              <h3 class="box-title">Transaksi Out</h3>
            </div>
            <div class="box-body">
                <form method="POST" id="editForm">
                @csrf
                <input type="hidden" id="id_product_out" value="{{ $productout->id }}">
                <div class="form-group">
                    <label>Transaction Code</label>
                    <input class="form-control" value="{{ $productout->productout_code }}" readonly>
                </div>
                <div class="form-group">
                    <label>Transaction Date</label>
                    <input class="form-control" value="{{ $productout->date }}" readonly>
                </div>
                <div class="form-group">
                    <label>Customer</label>
                        <select name="customer_id" id="customer_id" class="form-control select2">
                            <option value="" selected>Choose Customer</option>
                            @foreach ($customers as $customer)
                                @if ($customer->id == $productout->customer_id)
                                    <option value="{{ $customer->id }}" selected>{{ $customer->name }}</option>                                                        
                                @else
                                    <option value="{{ $customer->id }}">{{ $customer->name }}</option>                            
                                @endif
                            @endforeach
                        </select>
                </div>
            </div>
            <div class  ="modal-footer">
                <button type="button" class="btn btn-primary pull-left" onclick="updateProductOut();">Save</button>
                <a href="{{ route('productout.index') }}" class="btn btn-default" data-dismiss="modal">Back</a>
                </form>
            </div>    
        </div>

    </div>
    <div class="col-md-8">
        <div class="box box-primary">
            <div class="box-header">
              <h3 class="box-title">Transaksi Out</h3>
            </div>
            <div class="box-body">
                <div class="row">
                    <form method="POST" id="addForm">
                    @csrf
                    <input type="hidden" id="product_out_id" name="product_out_id" value="{{ $productout->id }}">
                    <div class="col-md-8">
                        <div class="form-group">
                            <label>Product</label>
                            <select class="form-control select2" id="product_id" name="product_id">
                                <option value="" selected>Choose Product</option>
                                @foreach ($products as $product)
                                    <option value="{{ $product->id }}">{{ $product->name }} </option>
                                @endforeach
                            </select>
                            <span class="text-danger error-text product_id_error"  style="font-size: 13px"></span>   
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Qty</label>
                            <div class="input-group input-group-md">
                                <input type="number" class="form-control" placeholder="input qty" id="qty" name="qty">
                                    <span class="input-group-btn">
                                      <button type="button" class="btn btn-primary" onclick="addProductOutDetail()">Add Data</button>
                                    </span>
                              </div>
                              <span class="text-danger error-text qty_error"  style="font-size: 13px"></span>   
                        </div>
                    </div>
                    </form>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <table class="table table-bordered">
                            <tr>
                                <td width="5%">#</td>
                                <td>Product</td>
                                <td>Qty</td>
                                <td>Action</td>
                            </tr>
                            @foreach ($productoutdetails as $i => $data)
                            <tr>
                                <td width="5%">{{ $i+1 }}</td>
                                <td>{{ $data->product->name }}</td>
                                <td>{{ $data->qty }}</td>
                                <td><a href="javascript:void(0)" id="btn-delete-productoutdetail" data-id="{{ $data->id }}" class="btn btn-danger btn-sm"><i class="fa fa-fw fa-trash"></i></a></td>
                            </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
          </div>
    </div>
</div>
</section>
@push('after-script')
<script>
function updateProductOut(){
    var form = new FormData($('#editForm')[0]);
    var id_product_out  =$('#id_product_out').val();     
    $('.error-text').text('');   
    $.ajax({
        url: "{{ url('/') }}/productout/"+id_product_out,
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
            Swal.fire({
                text: 'Data Berhasil disimpan',
                icon: 'success',
                showConfirmButton: false,
                timer: 2000,
            });
        },
        error:function(errors){
            $.each(errors.responseJSON, function( key, value ) {
                $('.'+key+'_error').text(value[0]);
            });                                
        }
    })
}

function addProductOutDetail(){
    var form = new FormData($('#addForm')[0]);
    $('#addForm .error-text').text('');
    $.ajax({
        url: "{{ route('productoutdetail.store') }}",
        type: "POST",
        data: form,
        contentType: false,
        processData: false,
        dataType: 'json',
        beforeSend:function(){

        },
        success:function(response){
            Swal.fire({
                text: 'Data Berhasil disimpan',
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
                $('#addForm .'+key+'_error').text(value[0]);
            });               
            
            if (errors.responseJSON.success == false) {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: errors.responseJSON.message,
                    timer: 2000,
                    showCancelButton: false
                })
            }
            
        }
    })
}

$('body').on('click', '#btn-delete-productoutdetail', function () {
    let productoutdetail_id = $(this).data('id');
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
                url: `{{ url('/') }}/productoutdetail/${productoutdetail_id}`,
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