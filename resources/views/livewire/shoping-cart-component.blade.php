<div>
    <!-- Breadcrumb Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-12">
                <nav class="breadcrumb bg-light mb-30">
                    <a class="breadcrumb-item text-dark" href="/">Home</a>
                    <a class="breadcrumb-item text-dark" href="/shop">Shop</a>
                    <span class="breadcrumb-item active">Shopping Cart</span>
                </nav>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->

    <!-- success message  -->
    @if (Cart::instance('addtocart')->count() > 0)
        @if (session()->has('success_message'))
            <div class="container">
                <div class="row">
                    <div class="col-md-6 offset-3">
                        <div class="alert alert-warning alert-dismissible fade show" role="alert" id="alert1">
                            <strong>Success!</strong>
                            <span> {{ session()->get('success_message') }} </span>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"
                                aria-label="Close"></button>
                        </div>
                    </div>
                </div>
            </div>

            <script>
                setTimeout(function() {
                    let div = document.getElementById("alert1");
                    div.innerText = "{{ session()->get('success_message') }}";
                }, 10);

                setTimeout(function() {
                    let div = document.getElementById("alert1");
                    div.style.display = "none";
                }, 2500);
            </script>
        @endif
        <!-- Modal -->

        @if (session()->has('deleted'))
            <div class="container">
                <div class="row">
                    <div class="col-md-6 offset-3">
                        <div class="alert alert-warning alert-dismissible fade show" role="alert" id="alert1">
                            <strong>Success!</strong>
                            <span> {{ session()->get('deleted') }} </span>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"
                                aria-label="Close"></button>
                        </div>
                    </div>
                </div>
            </div>

            <script>
                setTimeout(function() {
                    let div = document.getElementById("alert1");
                    div.innerText = "{{ session()->get('success_message') }}";
                }, 10);

                setTimeout(function() {
                    let div = document.getElementById("alert1");
                    div.style.display = "none";
                }, 2500);
            </script>
        @endif

        <!-- success message end  -->

        <!-- Cart Start -->
        <div class="container-fluid">
            <div class="row px-xl-5">
                <div class="col-lg-8 table-responsive mb-5">

                    <table class="table table-light table-borderless table-hover text-left mb-0">
                        <thead class="thead-dark">
                            <tr>
                                <th>Products</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Total</th>
                                <th>Remove</th>
                            </tr>
                        </thead>
                        <tbody class="align-center">
                            @foreach (Cart::instance('addtocart')->content() as $item)
                                <tr>
                                    <td class="align-middle">
                                        <img src="{{ asset('storage/products/' . $item->model->image) }}" alt=""
                                            style="width: 50px" />{{ $item->name }}
                                    </td>

                                    <td class="align-middle">
                                        $ {{ $item->model->sale_price }}
                                    </td>
                                    <td class="align-middle">
                                        <div class="input-group quantity mx-auto" style="width: 100px">
                                            <div class="input-group-btn">
                                                <button class="btn btn-sm btn-primary btn-minus"
                                                    wire:click.prevent="decreaseQuantity('{{ $item->rowId }}')">
                                                    <i class="fa fa-minus"></i>
                                                </button>
                                            </div>
                                            <input type="text"
                                                class="form-control form-control-sm bg-secondary border-0 text-center"
                                                value="{{ $item->qty }}" />
                                            <div class="input-group-btn">
                                                <button class="btn btn-sm btn-primary btn-plus"
                                                    wire:click.prevent="increaseQuantity('{{ $item->rowId }}')">
                                                    <i class="fa fa-plus"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="align-middle">
                                        $ {{ $item->subtotal }}
                                    </td>
                                    <td class="align-middle">
                                        <button class="btn btn-sm btn-danger" data-bs-toggle="modal"
                                            data-bs-target="#exampleModal"
                                            wire:click.prevent="removeProduduct('{{ $item->rowId }}')">
                                            <i class="fa fa-times"></i>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="col-lg-4">
                    <form class="mb-30" action="" wire:submit.prevent="ApplyCoupon()">
                        <div class="input-group">
                            <input type="text" class="form-control border-0 p-4" placeholder="Coupon Code"
                                wire:model="couponCode" />
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
                    {{-- <a class="btn btn-primary mb-1" style="width: 100%" href="{{ route('product.offers') }}">See
                    Offers</a> --}}
                    <h5 class="section-title position-relative text-uppercase mb-3">
                        <span class="bg-secondary pr-3">Cart Summary</span>
                    </h5>
                    <div class="bg-light p-30 mb-5">
                        @if (session()->has('coupon'))
                            <div class="d-flex justify-content-between mb-3">
                                <h6>Subtotal</h6>
                                <h6>
                                    $ {{ Cart::instance('addtocart')->subtotal() }}
                                </h6>
                            </div>
                            <div class="d-flex justify-content-between mb-3">
                                <h6>Discount ({{ session()->get('coupon')['code'] }})</h6>
                                <h6>- ${{ $discount }}</h6>
                            </div>
                            <div class="border-bottom pb-2">
                                <div class="d-flex justify-content-between mb-3">
                                    <h6>SubTotal With Discount ( ${{ $discount }} )</h6>
                                    <h6>${{ $sub_total_with_discount }}</h6>
                                </div>

                                <div class="d-flex justify-content-between">
                                    <h6 class="font-weight-medium">Shipping</h6>
                                    <h6 class="font-weight-medium">$0.00</h6>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <h6>Tax ({{ config('cart.tax') }}%)</h6>
                                    <h6>${{ $tax_with_discount }}</h6>
                                </div>
                            </div>
                            <div class="pt-2">
                                <div class="d-flex justify-content-between mt-2">
                                    <h5>Total</h5>
                                    ${{ $total_with_discount }}
                                </div>
                                <a href="#" class="btn btn-block btn-primary font-weight-bold my-3 py-3"
                                    wire:click.prevent="checkout()">Proceed To
                                    Checkout</a>
                            </div>
                        @else
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
                                <a href="#" class="btn btn-block btn-primary font-weight-bold my-3 py-3"
                                    wire:click.prevent="checkout()">Proceed To
                                    Checkout</a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        @else
            <div class="container">
                <div class="row">
                    <div class="text-center">
                        <h3>
                            Your Cart Is Empty..!
                        </h3>
                        <h4>Buy Somthing <a href="{{ route('product.shop') }}" class="btn btn-primary">Shop Now</a>
                        </h4>
                    </div>
                </div>
            </div>
    @endif
</div>
</div>
