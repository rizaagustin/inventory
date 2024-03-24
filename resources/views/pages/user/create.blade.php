<div class="modal fade" id="modal-add">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Add Data User</h4>
        </div>
        <div class="modal-body">
            <form method="POST" action="{{ route('user.store') }}" id="addForm">
                @csrf
                <div class="form-group">
                    <label>User Name</label>
                    <input type="text" name="name" class="form-control" placeholder="user" autocomplete="off">
                    <span class="text-danger error-text name_error"  style="font-size: 13px"></span>
                </div>          

                <div class="form-group">
                    <label>Email</label>
                    <input type="text" name="email" class="form-control" placeholder="email" autocomplete="off">
                    <span class="text-danger error-text email_error"  style="font-size: 13px"></span>
                </div>          

                <div class="form-group">
                    <label>Kata Sandi</label>
                    <input type="text" name="password" class="form-control" placeholder="password" autocomplete="off">
                    <span class="text-danger error-text password_error"  style="font-size: 13px"></span>
                </div>          

                <div class="form-group">
                    <label>Konfirmasi Kata Sandi</label>
                    <input type="text" name="password_confirmation" class="form-control" placeholder="konfirmasi password" autocomplete="off">
                    <span class="text-danger error-text password_confirmation_error"  style="font-size: 13px"></span>
                </div>          

                <div class="form-group">
                    @foreach ($roles as $role)
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="roles[]" value="{{ $role->name }}" id="check-{{ $role->id }}">
                                {{ $role->name }}
                            </label>
                        </div>
                    @endforeach
                    <span class="text-danger error-text roles_error"  style="font-size: 13px"></span>
                </div>
            </form>
        </div>
        <div class="modal-footer">
            <button type="button" onclick="addUser();" class="btn btn-primary pull-left">Save</button>
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
