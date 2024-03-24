<div class="modal fade" id="modal-edit">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Update Data Product</h4>
        </div>
        <div class="modal-body">
            <form method="POST" id="editForm">
                <input type="hidden" name="id_product" id="id_product">
                @csrf
                <div class="form-group">
                    <label>Product Name</label>
                    <input type="text" name="name" id="name-edit" class="form-control" placeholder="masukan nama product" autocomplete="off">
                    <span class="text-danger error-text name_error"  style="font-size: 13px"></span>
                </div>          

                <div class="form-group">
                    <label>Uom</label>
                    <input type="text" name="uom" id="uom-edit" class="form-control" placeholder="masukan uom" autocomplete="off">
                    <span class="text-danger error-text uom_error"  style="font-size: 13px"></span>
                </div>          

                <div class="form-group">
                    <label>Image</label>
                    <input type="file" name="image" class="form-control" placeholder="masukan image" autocomplete="off">
                    <span class="text-danger error-text image_error"  style="font-size: 13px"></span>
                </div>          

                <div class="form-group">
                    <label>Description</label>
                    <textarea name="description" id="description-edit" class="form-control" placeholder="masukan description"></textarea>
                    <span class="text-danger error-text description_error"  style="font-size: 13px"></span>
                </div>          

            </form>
        </div>
        <div class="modal-footer">
            <button type="button" onclick="updateProduct();" class="btn btn-primary pull-left">Save</button>
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
</div>
