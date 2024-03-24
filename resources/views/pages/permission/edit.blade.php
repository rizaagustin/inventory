<div class="modal fade" id="modal-edit">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Edit Data Permission</h4>
        </div>
        <div class="modal-body">
            <form method="POST" id="editPermisionForm">
                @csrf
                <input type="hidden" name="permission_id" id="permission_id">
                <div class="form-group">
                    <label>Name</label>
                    <input type="text" name="name" id="name-edit" class="form-control" placeholder="masukan nama permission" autocomplete="off">
                    <span class="text-danger error-text name_error"  style="font-size: 13px"></span>
                </div>          
            </form>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-primary pull-left" onclick="updatePermission()">Save</button>
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
</div>