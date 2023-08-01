<div>
    @if(Cart::instance('addtocart')->count() > 0)
    <!-- Breadcrumb Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-12">
                <nav class="breadcrumb bg-light mb-30">
                    <a class="breadcrumb-item text-dark" href="#">Home</a>
                    <a class="breadcrumb-item text-dark" href="#">Shop</a>
                    <span class="breadcrumb-item active">Checkout</span>
                </nav>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->

    @if (session()->has('stripe_error'))
        <div class="alert alert-danger" role="alert">
            {{ session()->get('stripe_error') }}
        </div>
    @endif

    <!-- Checkout Start -->
    <div class="container-fluid">

        <form action="" method="post" class="row px-xl-5" wire:submit.prevent="placeOrder">
            <div class="col-lg-8">
                <h5 class="mb-3 section-title position-relative text-uppercase"><span class="pr-3 bg-secondary">Billing
                        Address</span></h5>
                <div class="mb-5 bg-light p-30">
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label>First Name</label>
                            <input class="form-control" type="text" placeholder="John" name="first_name"
                                wire:model="first_name" required>
                            @error('first_name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Last Name</label>
                            <input class="form-control" type="text" placeholder="Doe" name="last_name"
                                wire:model="last_name" required>
                            @error('last_name')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-6 form-group">
                            <label>E-mail</label>
                            <input class="form-control" type="text" placeholder="example@email.com" name="email"
                                wire:model="email" required>
                            @error('email')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Mobile No</label>
                            <input class="form-control" type="text" placeholder="+123 456 789" name="mobile"
                                wire:model="mobile" required>
                            @error('mobile')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Address Line 1</label>
                            <input class="form-control" type="text" placeholder="123 Street" name="address1"
                                wire:model="address1" required>
                            @error('address1')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Address Line 2</label>
                            <input class="form-control" type="text" placeholder="123 Street" name="address2"
                                wire:model="address2">
                            @error('address2')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Country</label>
                            <select class="custom-select" wire:model="country" name="country">
                                <option value="united_state" selected>United States</option>
                                <option value="australia">Australia</option>
                                <option value="india">India</option>
                                <option value="china">China</option>
                                <option value="japan">Japan</option>
                            </select>
                            @error('country')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-6 form-group">
                            <label>City</label>
                            <input class="form-control" type="text" placeholder="New York" name="city" wire:model="city"
                                required>
                            @error('city')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-6 form-group">
                            <label>State / Provinence</label>
                            <input class="form-control" type="text" placeholder="New York" name="state"
                                wire:model="state" required>
                            @error('state')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-6 form-group">
                            <label>ZIP Code</label>
                            <input class="form-control" type="text" placeholder="123" name="zip_code"
                                wire:model="zip_code" required>
                            @error('zip_code')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        {{-- <div class="col-md-12 form-group">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="newaccount">
                                <label class="custom-control-label" for="newaccount">Create an account</label>
                            </div>
                        </div> --}}
                        <div class="col-md-12">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="1" id="shipto" wire:model="is_shipping_different">
                                <label class="form-check-label" for="shipto">
                                    Ship to different address
                                </label>
                              </div>
                        </div>
                    </div>
                </div>
                @if($is_shipping_different)
                <div class="mb-5" id="shipping-address">
                    <h5 class="mb-3 section-title position-relative text-uppercase"><span
                            class="pr-3 bg-secondary">Shipping
                            Address</span></h5>
                    <div class="bg-light p-30">
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label>First Name</label>
                                <input class="form-control" type="text" placeholder="John" name="first_name_2" wire:model="first_name_2">
                                @error('first_name_2')
                                    <span class="text-danger"> {{ $message }} </span>
                                @enderror
                            </div>
                            <div class="col-md-6 form-group">
                                <label>Last Name</label>
                                <input class="form-control" type="text" placeholder="Doe" name="last_name_2" wire:model="last_name_2">
                                @error('last_name_2')
                                    <span class="text-danger"> {{ $message }} </span>
                                @enderror
                            </div>
                            <div class="col-md-6 form-group">
                                <label>E-mail</label>
                                <input class="form-control" type="text" placeholder="example@email.com" name="email_2" wire:model="email_2">
                                @error('email_2')
                                    <span class="text-danger"> {{ $message }} </span>
                                @enderror
                            </div>
                            <div class="col-md-6 form-group">
                                <label>Mobile No</label>
                                <input class="form-control" type="text" placeholder="+123 456 789" name="mobile_2" wire:model="mobile_2">
                                @error('mobile_2')
                                    <span class="text-danger"> {{ $message }} </span>
                                @enderror
                            </div>
                            <div class="col-md-6 form-group">
                                <label>Address Line 1</label>
                                <input class="form-control" type="text" placeholder="123 Street" name="address1_2" wire:model="address1_2">
                                @error('address1_2')
                                    <span class="text-danger"> {{ $message }} </span>
                                @enderror
                            </div>
                            <div class="col-md-6 form-group">
                                <label>Address Line 2</label>
                                <input class="form-control" type="text" placeholder="123 Street" name="address2_2" wire:model="address2_2">
                                @error('address2_2')
                                    <span class="text-danger"> {{ $message }} </span>
                                @enderror
                            </div>
                            <div class="col-md-6 form-group">
                                <label>Country</label>
                                <select class="custom-select" name="country_2" wire:model="country_2">
                                    <option value="united_state" selected>United States</option>
                                    <option value="australia">Australia</option>
                                    <option value="india">India</option>
                                    <option value="china">China</option>
                                    <option value="japan">Japan</option>
                                </select>
                                @error('country_2')
                                    <span class="text-danger"> {{ $message }} </span>
                                @enderror
                            </div>
                            <div class="col-md-6 form-group">
                                <label>City</label>
                                <input class="form-control" type="text" placeholder="New York" name="city_2" wire:model="city_2">
                                @error('city_2')
                                    <span class="text-danger"> {{ $message }} </span>
                                @enderror
                            </div>
                            <div class="col-md-6 form-group">
                                <label>State / Provinence</label>
                                <input class="form-control" type="text" placeholder="New York" name="state_2" wire:model="state_2">
                                @error('state_2')
                                    <span class="text-danger"> {{ $message }} </span>
                                @enderror
                            </div>
                            <div class="col-md-6 form-group">
                                <label>ZIP Code</label>
                                <input class="form-control" type="text" placeholder="123" name="zip_code_2" wire:model="zip_code_2">
                                @error('zip_code_2')
                                    <span class="text-danger"> {{ $message }} </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                @endif
            </div>
            <div class="col-lg-4">
                <h5 class="mb-3 section-title position-relative text-uppercase"><span class="pr-3 bg-secondary">Order
                        Total</span></h5>
                <div class="mb-5 bg-light p-30">
                    <div class="border-bottom">
                        <h6 class="mb-3">Products</h6>

                        @php
                            $subtotal = str_replace(',', '', session()->get('checkout')['subTotal']);
                            $tax      = str_replace(',', '', session()->get('checkout')['tax']);
                            $total    = str_replace(',', '', session()->get('checkout')['total']);

                        @endphp

                        @foreach (Cart::instance('addtocart')->content() as $item)
                        <div class="d-flex justify-content-between">
                            <img src="{{ asset('storage/products/' . $item->model->image) }}" alt=""
                                style="width: 50px" />
                            <p>{{ $item->name }}</p>
                            <p>${{ number_format($item->model->sale_price, 2) }}</p>
                        </div>
                        @endforeach
                    </div>
                    <div class="pt-3 pb-2 border-bottom">
                        <div class="mb-3 d-flex justify-content-between">
                            <h6>Subtotal</h6>
                            <h6>${{ number_format((float)$subtotal, 2) }}</h6>
                        </div>
                        <div class="d-flex justify-content-between">
                            <h6 class="font-weight-medium">Tax</h6>
                            <h6 class="font-weight-medium">${{ (float)$tax }}
                            </h6>
                        </div>
                        <div class="d-flex justify-content-between">
                            <h6 class="font-weight-medium">Shipping</h6>
                            <h6 class="font-weight-medium">${{ number_format(0, 2) }}</h6>
                        </div>
                    </div>
                    <div class="pt-2">
                        <div class="mt-2 d-flex justify-content-between">
                            <h5>Total</h5>
                            <h5>${{ number_format((float)$total, 2) }}</h5>
                        </div>
                    </div>
                </div>

                <div class="mb-5">
                    <h5 class="mb-3 section-title position-relative text-uppercase"><span
                            class="pr-3 bg-secondary">Payment</span></h5>
                    <div class="bg-light p-30">
                        @if ($paymentForm3)
                        <div class="col-md-12 row">
                            <div class="form-group col-md-12">
                              <label for="card_no">Card Number</label>
                              <input type="text" name="" id="card_no" class="form-control" placeholder="000-000-000-000" aria-describedby="card number here" wire:model="card_no">
                            </div>
                            <div class="form-group col-md-12">
                              <label for="card_no">Expiry Month</label>
                              <input type="text" name="" id="card_no" class="form-control" placeholder="MM" aria-describedby="card number here" wire:model="exp_month">
                            </div>
                            <div class="form-group col-md-12">
                              <label for="card_no">Expiry Year</label>
                              <input type="text" name="" id="card_no" class="form-control" placeholder="YYYY" aria-describedby="card number here" wire:model="exp_year">
                            </div>
                            <div class="form-group col-md-12">
                              <label for="card_no">CVC</label>
                              <input type="password" name="" id="card_no" class="form-control" placeholder="" aria-describedby="card number here" wire:model="cvc">
                            </div>
                        </div>
                        @endif
                        <div class="form-check">
                            <label class="form-check-label" for="paymentmode1">
                            <input class="form-check-input" type="radio" id="paymentmode1" name="paymentmode" value="bank_transfer" wire:model="paymentmode" wire:click="paymentForm1">
                                Bank Transfer
                            </label>
                          </div>
                        <div class="form-check">
                            <label class="form-check-label" for="paymentmode2">
                            <input class="form-check-input" type="radio" id="paymentmode2" name="paymentmode" value="cod" wire:model="paymentmode" wire:click="paymentForm2">
                                Cash On Delivery
                            </label>
                          </div>
                          <div class="form-check">
                              <label class="form-check-label" for="paymentmode3">
                            <input class="form-check-input" type="radio" id="paymentmode3" name="paymentmode" value="card" wire:model="paymentmode" wire:click="paymentForm3">
                                Paypal
                            </label>
                          </div>

                        {{-- <input type="submit" name="submit" id="" value="Place Order"
                            class="py-3 btn btn-block btn-primary font-weight-bold"> --}}

                    </div>
                </div>

            </div>
            <button class="py-3 btn btn-block btn-primary font-weight-bold" type="submit">
                Place Order
            </button>
        </form>

    </div>
    @else
    <div class="container">
        <div class="row">
            <div class="text-center">
                <h3>
                    No Product(s) To Checkout
                </h3>
                <h4>Buy Somthing <a href="{{route('product.shop')}}" class="btn btn-primary">Shop Now</a> </h4>
            </div>
        </div>
    </div>
    @endif
    <!-- Checkout End -->
</div>
