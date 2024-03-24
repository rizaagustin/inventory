<div class="modal fade" id="modal-add">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Add Data Supplier</h4>
        </div>
        <div class="modal-body">
            <form method="POST" action="{{ route('supplier.store') }}" id="addForm">
                @csrf
                <div class="form-group">
                    <label>Name</label>
                    <input type="text" name="name" class="form-control" placeholder="supplier" autocomplete="off">
                    <span class="text-danger error-text name_error"  style="font-size: 13px"></span>
                </div>          
                <div class="form-group">
                    <label>Email</label>
                    <input type="text" name="email" class="form-control" placeholder="email" autocomplete="off">
                    <span class="text-danger error-text email_error"  style="font-size: 13px"></span>
                </div>          
                <div class="form-group">
                    <label>Phone</label>
                    <input type="text" name="phone" class="form-control" placeholder="phone" autocomplete="off">
                    <span class="text-danger error-text phone_error"  style="font-size: 13px"></span>
                </div>          
                <div class="form-group">
                    <label>Website</label>
                    <input type="text" name="website" class="form-control" placeholder="website" autocomplete="off">
                    <span class="text-danger error-text website_error"  style="font-size: 13px"></span>
                </div>          
                <div class="form-group">
                    <label>Address</label>
                    <textarea name="address" class="form-control" placeholder="alamat"></textarea>
                    <span class="text-danger error-text address_error"  style="font-size: 13px"></span>
                </div>          
            </form>
        </div>
        <div class="modal-footer">
            <button type="button" onclick="addSupplier();" class="btn btn-primary pull-left">Simpan</button>
            <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
        </div>
      </div>
    </div>
</div>
