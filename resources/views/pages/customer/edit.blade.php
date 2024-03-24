<div class="modal fade" id="modal-edit">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Update Data Customer</h4>
        </div>
        <div class="modal-body">
            <form method="POST" id="editForm">
                @csrf
                <input id="customer_id" type="hidden" name="customer_id">
                <div class="form-group">
                    <label>Name</label>
                    <input type="text" name="name" id="name-edit" class="form-control" placeholder="customer" autocomplete="off">
                    <span class="text-danger error-text name_error"  style="font-size: 13px"></span>
                </div>          
                <div class="form-group">
                    <label>Email</label>
                    <input type="text" name="email" id="email-edit" class="form-control" placeholder="email" autocomplete="off">
                    <span class="text-danger error-text email_error"  style="font-size: 13px"></span>
                </div>          
                <div class="form-group">
                    <label>Phone</label>
                    <input type="text" name="phone" id="phone-edit" class="form-control" placeholder="phone" autocomplete="off">
                    <span class="text-danger error-text phone_error"  style="font-size: 13px"></span>
                </div>          
                <div class="form-group">
                    <label>Website</label>
                    <input type="text" name="website" id="website-edit" class="form-control" placeholder="website" autocomplete="off">
                    <span class="text-danger error-text website_error"  style="font-size: 13px"></span>
                </div>          
                <div class="form-group">
                    <label>Address</label>
                    <textarea name="address" id="address-edit" class="form-control" placeholder="alamat"></textarea>
                    <span class="text-danger error-text address_error"  style="font-size: 13px"></span>
                </div>          
            </form>
        </div>
        <div class="modal-footer">
            <button type="button" onclick="updateCustomer();" class="btn btn-primary pull-left">Save</button>
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
</div>
