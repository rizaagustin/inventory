<div class="modal fade" id="modal-edit">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Edit Data User</h4>
        </div>
        <div class="modal-body">
            <form method="POST" id="editForm">
                @csrf
                <input type="hidden" name="user_id" id="user_id">
                <div class="form-group">
                    <label>Name</label>
                    <input type="text" name="name" id="name-edit" class="form-control" placeholder="masukan nama user" autocomplete="off">
                    <span class="text-danger error-text name_error"  style="font-size: 13px"></span>
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email" id="email-edit" class="form-control" placeholder="masukan email" autocomplete="off">
                    <span class="text-danger error-text email_error"  style="font-size: 13px"></span>
                </div>

                
                <div class="form-group">
                    <label>Password</label>
                    <input type="text" name="password" id="password-edit" class="form-control" placeholder="masukan password" autocomplete="off">
                    <span class="text-danger error-text password_error"  style="font-size: 13px"></span>
                </div>          

                <div class="form-group">
                    <label>Password Confirmation</label>
                    <input type="text" name="password_confirmation" id="password_confirmation-password" class="form-control" placeholder="masukan konfirmasi password" autocomplete="off">
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
            <button type="button" class="btn btn-primary pull-left" onclick="updateUser()">Save</button>
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
</div>