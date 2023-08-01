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
    @if (Cart::instance('addtowishlist')->count() > 0)
    <!-- success message  -->
    @if (session()->has('movedToCart'))
    <div class="container">
        <div class="row">
            <div class="col-md-6 offset-3">
                <div class="alert alert-warning alert-dismissible fade show  " role="alert" id="alert1">
                    <strong>Success!</strong> <span> {{ session()->get('movedToCart') }} </span>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
        </div>
    </div>

    <script>
        setTimeout(function() {
            let div = document.getElementById('alert1');
            div.innerText = "{{session()->get('success_message')}}";
        }, 10);

        setTimeout(function() {
            let div = document.getElementById('alert1');
            div.style.display = "none";
        }, 2500);
    </script>
    @endif
    <!-- success message end  -->

    <!-- Cart Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            {{-- <div class="col-lg-8 table-responsive mb-5"> --}}
            <div class="col-md-12 col-lg-12">
                <div class="row pb-3">

                        @foreach (Cart::instance('addtowishlist')->content() as $product)
                            <div class="col-lg-2 col-md-6 col-sm-6 pb-1">
                                <div class="product-item bg-light mb-4">
                                    <div class="product-img position-relative overflow-hidden">
                                        <img class="img-fluid w-100"
                                            src="{{ asset('storage/products/' . $product->model->image) }}"
                                            alt="{{ $product->model->name }}">
                                        <div class="product-action">
                                            <a class="btn btn-outline-dark btn-square" href=""
                                                title="Add to cart"
                                                wire:click.prevent="store({{ $product->model->id }}, '{{ $product->model->name }}', {{ $product->model->sale_price }})"
                                                ><i
                                                    class="fa fa-shopping-cart"></i></a>

                                            <a class="btn btn-outline-dark btn-square" href=""
                                                title="Remove from favorites"
                                                wire:click.prevent="removeFromWishlist({{ $product->model->id }})"><i
                                                    class="fa fa-heart fill-heart"></i></a>

                                            <a class="btn btn-outline-dark btn-square" href="" title="Reload"><i
                                                    class="fa fa-sync-alt"></i></a>
                                            <a class="btn btn-outline-dark btn-square"
                                                href="{{ route('product.details', ['slug' => $product->model->slug]) }}"
                                                title="Details"><i class="fa fa-search"></i></a>
                                        </div>
                                    </div>
                                    <div class="text-center py-4 overflow-hidden">
                                        <a class="h6 text-decoration-none text-truncate" href=""
                                            id="{{ $product->model->name }}">{{ $product->model->name }}</a>
                                        <div class="d-flex align-items-center justify-content-center mt-2">
                                            <h5>{{ $product->model->sale_price }}</h5>
                                            <h6 class="text-muted ml-2">
                                                <del>{{ $product->model->regular_price }}</del>
                                            </h6>
                                        </div>
                                        {{-- <span>Sale ends in : 00:00:00</span> --}}
                                        <div class="d-flex align-items-center justify-content-center mb-1">
                                            <small class="fa fa-star text-primary mr-1"></small>
                                            <small class="fa fa-star text-primary mr-1"></small>
                                            <small class="fa fa-star text-primary mr-1"></small>
                                            <small class="fa fa-star text-primary mr-1"></small>
                                            <small class="fa fa-star text-primary mr-1"></small>
                                            <small>(99)</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                </div>
            </div>
            {{-- </div> --}}
        </div>
    @else
    <div class="container">
        <div class="row">
            <div class="text-center">
                <h3>
                    Your Wishlist Is Empty..!
                </h3>
                <h4>Add Some <a href="{{route('product.shop')}}" class="btn btn-primary">Add Now</a> </h4>
            </div>
        </div>
    </div>
        @endif
    </div>

    <!-- Cart End -->
</div>
