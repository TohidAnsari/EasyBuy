<div>
    <div class="container">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                @if (session()->has('settings_saved'))
                    <div class="alert alert-success" role="alertdialog">{{ session()->get('settings_saved') }}</div>
                @endif
                <div class="card">
                    <div class="card-header bg-primary">
                        <h4>Settings</h4>
                    </div>
                    <div class="card-body">
                        <form wire:submit='saveSettings'>
                            <div class="mb-3">
                              <input type="email" name="email" id="email" class="form-control" placeholder="Email" wire:model='email'>
                              @error('email')
                                <span class="text-danger">{{ $message }}</span>
                              @enderror
                            </div>
                            <div class="mb-3">
                              <input type="text" name="phone1" id="phone1" class="form-control" placeholder="Phone 1" wire:model='phone1'>
                              @error('phone1')
                                <span class="text-danger">{{ $message }}</span>
                              @enderror
                            </div>
                            <div class="mb-3">
                              <input type="text" name="phone2" id="phone2" class="form-control" placeholder="Phone 2" wire:model='phone2'>
                              @error('phone2')
                                <span class="text-danger">{{ $message }}</span>
                              @enderror
                            </div>
                            <div class="mb-3">
                              <input type="text" name="address1" id="address1" class="form-control" placeholder="Address" wire:model='address1'>
                              @error('address1')
                                <span class="text-danger">{{ $message }}</span>
                              @enderror
                            </div>
                            <div class="mb-3">
                              <input type="text" name="map" id="map" class="form-control" placeholder="Map" wire:model='map'>
                              @error('map')
                                <span class="text-danger">{{ $message }}</span>
                              @enderror
                            </div>
                            <div class="mb-3">
                              <input type="text" name="twiter" id="twiter" class="form-control" placeholder="Twiter" wire:model='twiter'>
                              @error('twiter')
                                <span class="text-danger">{{ $message }}</span>
                              @enderror
                            </div>
                            <div class="mb-3">
                              <input type="text" name="facebook" id="facebook" class="form-control" placeholder="Facebook" wire:model='facebook'>
                              @error('facebook')
                                <span class="text-danger">{{ $message }}</span>
                              @enderror
                            </div>
                            <div class="mb-3">
                              <input type="text" name="pinterest" id="pinterest" class="form-control" placeholder="Pinterest" wire:model='pinterest'>
                              @error('pinterest')
                                <span class="text-danger">{{ $message }}</span>
                              @enderror
                            </div>
                            <div class="mb-3">
                              <input type="text" name="instagram" id="instagram" class="form-control" placeholder="Instagram" wire:model='instagram'>
                              @error('instagram')
                                <span class="text-danger">{{ $message }}</span>
                              @enderror
                            </div>
                            <div class="mb-3">
                              <input type="text" name="youtube" id="youtube" class="form-control" placeholder="YouTube" wire:model='youtube'>
                              @error('youtube')
                                <span class="text-danger">{{ $message }}</span>
                              @enderror
                            </div>
                            <div class="mb-3">
                                <button class="btn btn-primary" type="submit">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
