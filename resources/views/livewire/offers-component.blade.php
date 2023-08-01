<div>
    <div class="container">
        <h1>All Offers</h1>
        <div class="row">
            <div class="col-md-12">
                <form
                    class="mb-30"
                    action=""
                    wire:submit.prevent="ApplyCoupon()"
                >
                    <div class="input-group">
                        <input
                            type="text"
                            class="form-control border-0 p-4"
                            placeholder="Coupon Code"
                            wire:model="couponCode"
                        />
                        <div class="input-group-append">
                            <button class="btn btn-primary">
                                Apply Coupon
                            </button>
                        </div>
                    </div>
                    @if (session()->has('error'))
                    <p class="text-danger">{{ session()->get('error') }}</p>
                    @endif
                </form>
                <table class="table table-light">
                    <thead class="thead-primary">
                        <tr>
                            <th>#</th>
                            <th>Coupons</th>
                            <th>Coupon Type</th>
                            <th>Value</th>
                            <th>Cart Value</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($coupons as $key => $coupon)
                        <tr>
                            <td>{{ +(+$key) }}</td>
                            <td>{{ $coupon->coupon_code }}</td>
                            <td>{{ $coupon->type }}</td>
                            <td>{{ $coupon->value }}</td>
                            <td>$ {{ $coupon->cart_value }}</td>
                            <td>
                                <a href="">
                                    <button class="btn btn-primary">
                                        Apply
                                    </button>
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4">
                                <h4>Sorry, No Offers Yet!</h4>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
                <h5 class="section-title position-relative text-uppercase mb-3">
                    <span class="bg-secondary pr-3">Cart Summary</span>
                </h5>
                <div class="bg-light p-30 mb-5">
                    <div class="border-bottom pb-2">
                        <div class="d-flex justify-content-between mb-3">
                            <h6>Subtotal</h6>
                            <h6>
                                $ {{ Cart::instance('addtocart')->subtotal() }}
                            </h6>
                        </div>
                        <div class="d-flex justify-content-between">
                            <h6 class="font-weight-medium">Shipping</h6>
                            <h6 class="font-weight-medium">$0.00</h6>
                        </div>
                        <div class="d-flex justify-content-between">
                            <h6 class="font-weight-medium">Tax</h6>
                            <h6 class="font-weight-medium">
                                ${{ Cart::instance('addtocart')->tax(2) }}
                            </h6>
                        </div>
                    </div>
                    <div class="pt-2">
                        <div class="d-flex justify-content-between mt-2">
                            <h5>Total</h5>
                            ${{ Cart::instance('addtocart')->total() }}
                        </div>
                        <a href="/checkout" class="btn btn-block btn-primary font-weight-bold my-1">Proceed To Checkout</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
