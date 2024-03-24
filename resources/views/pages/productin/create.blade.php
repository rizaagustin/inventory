<div class="modal fade" id="modal-add">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Input Transaction In</h4>
        </div>
        <div class="modal-body">
            <form method="POST" id="addForm">
                @csrf
                <div class="form-group">
                    <label>Supplier</label>
                    <select name="supplier_id" class="form-control select2">
                        <option value="" selected>Pilih Supplier</option>
                        @foreach ($suppliers as $supplier)
                            <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>                            
                        @endforeach
                    </select>
                </div>       
                <span class="text-danger error-text supplier_id_error"  style="font-size: 13px"></span>   
                <div class="form-group">
                  <label>Transaction Date</label>
                  <input type="date" name="date" value="{{ date('Y-m-d') }}" class="form-control" placeholder="masukan tanggal transaksi" autocomplete="off" readonly>
                </div>
            </form>
        </div>
        <div class="modal-footer">
            <button type="button" onclick="addProductIn();" class="btn btn-primary pull-left">Save</button>
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
</div>
