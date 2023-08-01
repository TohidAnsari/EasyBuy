<div>
    <div class="container">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                @if (session()->has('password_changed_success'))
                    <div class="alert alert-success text-center" role="alert">{{ session()->get('password_changed_success') }}</div>
                @endif
                @if (session()->has('password_changed_error'))
                    <div class="alert alert-danger text-center" role="alert">{{ session()->get('password_changed_error') }}</div>
                @endif
                <div class="card">
                    <div class="card-header bg-primary">
                        <h4>Change Password</h4>
                    </div>
                    <div class="card-body">
                        <form wire:submit.prevent='changePassword'>
                            <div class="form-group">
                              <input type="password" id="current_password" name="current_password" class="form-control" placeholder="Current Password" wire:model="current_password">
                              @error('current_password')
                                  <span class="text-danger">{{ $message }}</span>
                              @enderror
                            </div>
                            <div class="form-group">
                              <input type="password" id="new_password" name="new_password" class="form-control" placeholder="New Password" wire:model="new_password">
                              @error('new_password')
                                  <span class="text-danger">{{ $message }}</span>
                              @enderror
                            </div>
                            <div class="form-group">
                              <input type="password" id="confirm_password" name="confirm_password" class="form-control" placeholder="Confirm Password" wire:model="confirm_password">
                              @error('confirm_password')
                                  <span class="text-danger">{{ $message }}</span>
                              @enderror
                            </div>
                            <div class="form-group">
                              <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
