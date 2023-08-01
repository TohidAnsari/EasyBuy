<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card card-default col-lg-6 offset-lg-3 col-md-6 offset-md-3 col-sm-6 offset-sm-3">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-8 col-lg-8 col-sm-8">
                            <h4>Add New Coupon</h4>
                        </div>
                        <div class="col-md-4 col-lg-4 col-sm-4"><a href="{{ route('admin.allcoupons') }}" class="btn btn-primary">All Coupons</a></div>
                    </div>
                    <div class="card-body">
                        @if (session()->has('categoryAdded'))
                        <div class="alert alert-success col-md-12 text-center" role="alert" id="alert1"></div>
                        <script>
                            setTimeout(function() {
                                let div = document.getElementById('alert1');
                                div.innerText = "{{ session()->get('categoryAdded') }}";
                            }, 10);

                            setTimeout(function() {
                                let div = document.getElementById('alert1');
                                div.style.display = "none";
                            }, 2500);
                        </script>
                        @endif
                        <form action="" class="form-horizontal" wire:submit.prevent="storeCoupon()">
                            <div class="form-group">
                                <label for="code">Coupon Code</label>
                                <input id="code" class="form-control" type="text" name="code" placeholder="Coupon Code.." wire:model="code" required>
                                @error('code')
                                <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>

                                <div class="form-group">
                                    <label for="type">Coupon Type</label>
                                    <select id="type" class="form-control" name="type" wire:model="type">
                                        <option value="">select</option>
                                        <option value="fixed">Fixed</option>
                                        <option value="precent">Percent</option>
                                    </select>
                                </div>
                                @error('type')
                                <p class="text-danger">{{ $message }}</p>
                                @enderror

                                <div class="form-group">
                                    <label for="type">Coupon Visibility</label>
                                    <select id="type" class="form-control" name="type" wire:model="visible">
                                        <option value="0">Secrete</option>
                                        <option value="1">Not Secrete</option>
                                    </select>
                                </div>
                                @error('visible')
                                <p class="text-danger">{{ $message }}</p>
                                @enderror

                            <div class="form-group">
                                <label for="coupon_value">Coupon value</label>
                                <input id="coupon_value" class="form-control" type="text" name="coupon_value" placeholder="Coupon value.." wire:model="coupon_value" required>
                                @error('coupon_value')
                                <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="cart_value">Cart value</label>
                                <input id="cart_value" class="form-control" type="text" name="cart_value" placeholder="Cart value.." wire:model="cart_value" required>
                                @error('cart_value')
                                <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>


                            <div class="form-group">
                                <button class="btn btn-success">Add</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
