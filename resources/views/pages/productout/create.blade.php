<div class="modal fade" id="modal-add">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Input Transaksi Masuk</h4>
        </div>
        <div class="modal-body">
            <form method="POST" id="addForm">
                @csrf
                <div class="form-group">
                    <label>Customer</label>
                    <select name="customer_id" class="form-control select2" style="width: 100%">
                        <option value="" selected>Pilih Customer</option>
                        @foreach ($customers as $customer)
                            <option value="{{ $customer->id }}">{{ $customer->name }}</option>                            
                        @endforeach
                    </select>
                </div>       
                <span class="text-danger error-text supplier_id_error"  style="font-size: 13px"></span>   
                <div class="form-group">
                  <label>Tanggal Transaksi</label>
                  <input type="date" name="date" value="{{ date('Y-m-d') }}" class="form-control" placeholder="masukan tanggal transaksi" autocomplete="off" readonly>
                </div>
            </form>
        </div>
        <div class="modal-footer">
            <button type="button" onclick="addProductOut();" class="btn btn-primary pull-left">Simpan</button>
            <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
        </div>
      </div>
    </div>
</div>
