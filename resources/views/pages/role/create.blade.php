<div class="modal fade" id="modal-add">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Add Data Role</h4>
        </div>
        <div class="modal-body">
            <form method="POST" action="{{ route('role.store') }}" id="addForm">
                @csrf
                <div class="form-group">
                    <label>Role</label>
                    <input type="text" name="name" class="form-control" placeholder="masukan nama role" autocomplete="off">
                    <span class="text-danger error-text name_error"  style="font-size: 13px"></span>
                </div>          
                    <div class="form-group">
                    @foreach ($permissions as $permission)
                        <label>
                          <input type="checkbox" class="minimal m-2" name="permissions[]" value="{{ $permission->id }}">
                            {{ $permission->name }}
                        </label>
                    @endforeach
                    </div>
                    <span class="text-danger error-text permissions_error"  style="font-size: 13px"></span>
            </form>
        </div>
        <div class="modal-footer">
            <button type="button" onclick="addPermission();" class="btn btn-primary pull-left">Save</button>
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
