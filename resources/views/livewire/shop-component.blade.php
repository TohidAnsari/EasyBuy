<div>
    <!-- Breadcrumb Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-12">
                <nav class="breadcrumb bg-light mb-30">
                    <a class="breadcrumb-item text-dark" href="#">Home</a>
                    <a class="breadcrumb-item text-dark" href="#">Shop</a>
                    <span class="breadcrumb-item active">Shop List</span>
                </nav>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->
    <!-- success message  -->
    @if (session()->has('success_message'))
    <div class="container" style="width: 100%; text-align: center;">
        <div class="row" style="width: 100%; text-align: center;">
            <div class="card" style="width: 100%; text-align: center;">
                <div class="alert alert-success col-md-12 text-center" role="alert" id="alert1" style="text-align: center;"></div>
            </div>
        </div>
    </div>

    <script>
        setTimeout(function() {
            let div = document.getElementById('alert1');
            div.innerText = "{{ session()->get('success_message') }}";
        }, 10);

        setTimeout(function() {
            let div = document.getElementById('alert1');
            div.style.display = "none";
        }, 2500);
    </script>
    @endif
    <!-- success message end  -->

    <!-- Shop Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <!-- Shop Sidebar Start -->
            <div class="col-lg-3 col-md-4">
                <!-- Price Start -->
                <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Filter
                        by price</span></h5>
                <div class="bg-light p-4 mb-30">
                    <form>
                        <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input type="checkbox" class="custom-control-input" checked id="price-all" wire:model="price_all">
                            <label class="custom-control-label" for="price-all">All Price</label>
                            <span class="badge border font-weight-normal">1000</span>
                        </div>
                        <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input type="checkbox" class="custom-control-input" id="price-1" wire:model="price_100" value="100">
                            <label class="custom-control-label" for="price-1">$0 - $100</label>
                            <span class="badge border font-weight-normal">150</span>
                        </div>
                        <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input type="checkbox" class="custom-control-input" id="price-2" wire:model="price_200" value="200">
                            <label class="custom-control-label" for="price-2">$100 - $200</label>
                            <span class="badge border font-weight-normal">295</span>
                        </div>
                        <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input type="checkbox" class="custom-control-input" id="price-3" wire:model="price_500" value="500">
                            <label class="custom-control-label" for="price-3">$200 - $500</label>
                            <span class="badge border font-weight-normal">246</span>
                        </div>
                        <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input type="checkbox" class="custom-control-input" id="price-4" wire:model="price_1000" value="1000">
                            <label class="custom-control-label" for="price-4">$500 - $1000</label>
                            <span class="badge border font-weight-normal">145</span>
                        </div>
                        <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between">
                            <input type="checkbox" class="custom-control-input" id="price-5" wire:model="price_1000A" value="1000">
                            <label class="custom-control-label" for="price-5">$1000 and above</label>
                            <span class="badge border font-weight-normal">168</span>
                        </div>
                        <!-- <div class="form-control custom-checkbox d-flex align-items-center justify-content-between">
                            <input type="submit" class="form-control-input btn btn-block btn-primary" id="submit" value="Apply">
                        </div> -->
                    </form>
                </div>
                <!-- Price End -->

                <!-- Color Start -->
                {{-- <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Filter by color</span></h5>
                <div class="bg-light p-4 mb-30">
                    <form>
                        <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input type="checkbox" class="custom-control-input" checked id="color-all">
                            <label class="custom-control-label" for="price-all">All Color</label>
                            <span class="badge border font-weight-normal">1000</span>
                        </div>
                        <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input type="checkbox" class="custom-control-input" id="color-1">
                            <label class="custom-control-label" for="color-1">Black</label>
                            <span class="badge border font-weight-normal">150</span>
                        </div>
                        <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input type="checkbox" class="custom-control-input" id="color-2">
                            <label class="custom-control-label" for="color-2">White</label>
                            <span class="badge border font-weight-normal">295</span>
                        </div>
                        <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input type="checkbox" class="custom-control-input" id="color-3">
                            <label class="custom-control-label" for="color-3">Red</label>
                            <span class="badge border font-weight-normal">246</span>
                        </div>
                        <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input type="checkbox" class="custom-control-input" id="color-4">
                            <label class="custom-control-label" for="color-4">Blue</label>
                            <span class="badge border font-weight-normal">145</span>
                        </div>
                        <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between">
                            <input type="checkbox" class="custom-control-input" id="color-5">
                            <label class="custom-control-label" for="color-5">Green</label>
                            <span class="badge border font-weight-normal">168</span>
                        </div>
                    </form>
                </div> --}}
                <!-- Color End -->

                <!-- Size Start -->
                {{-- <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Filter by size</span></h5>
                <div class="bg-light p-4 mb-30">
                    <form>
                        <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input type="checkbox" class="custom-control-input" checked id="size-all">
                            <label class="custom-control-label" for="size-all">All Size</label>
                            <span class="badge border font-weight-normal">1000</span>
                        </div>
                        <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input type="checkbox" class="custom-control-input" id="size-1">
                            <label class="custom-control-label" for="size-1">XS</label>
                            <span class="badge border font-weight-normal">150</span>
                        </div>
                        <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input type="checkbox" class="custom-control-input" id="size-2">
                            <label class="custom-control-label" for="size-2">S</label>
                            <span class="badge border font-weight-normal">295</span>
                        </div>
                        <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input type="checkbox" class="custom-control-input" id="size-3">
                            <label class="custom-control-label" for="size-3">M</label>
                            <span class="badge border font-weight-normal">246</span>
                        </div>
                        <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input type="checkbox" class="custom-control-input" id="size-4">
                            <label class="custom-control-label" for="size-4">L</label>
                            <span class="badge border font-weight-normal">145</span>
                        </div>
                        <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between">
                            <input type="checkbox" class="custom-control-input" id="size-5">
                            <label class="custom-control-label" for="size-5">XL</label>
                            <span class="badge border font-weight-normal">168</span>
                        </div>
                    </form>
                </div> --}}
                <!-- Size End -->
            </div>
            <!-- Shop Sidebar End -->


            <!-- Shop Product Start -->
            <div class="col-lg-9 col-md-8">
                <div class="row pb-3">
                    <div class="col-12 pb-1">
                        <div class="d-flex align-items-center justify-content-between mb-4">
                            <div>
                                <button class="btn btn-sm btn-light"><i class="fa fa-th-large"></i></button>
                                <button class="btn btn-sm btn-light ml-2"><i class="fa fa-bars"></i></button>
                            </div>

                            <div class="ml-2 d-flex">
                                <select class="btn btn-sm btn-light dropdown-toggle d-flex mr-1"  wire:model="sorting">
                                    <option selected>Sorting</option>
                                    <option class="dropdown-item" value="newest">Newest</option>
                                    <option class="dropdown-item" value="price">price low-to-high</option>
                                    <option class="dropdown-item" value="priceDesc">price high-to -low</option>
                                    <option class="dropdown-item" value="rating">Best Rating</option>
                                </select>

                                <select class="btn btn-sm btn-light dropdown-toggle " wire:model="pagesize">
                                    <option class="dropdown-item" value="9">Showing</option>
                                    <option class="dropdown-item" value="9">9</option>
                                    <option class="dropdown-item" value="18">18</option>
                                    <option class="dropdown-item" value="36">36</option>
                                    <option class="dropdown-item" value="72">72</option>
                                    <!-- <option class="dropdown-item" value="all"></option> -->
                                </select>
                            </div>
                        </div>
                    </div>
                    @php
                    $wishlist = Cart::instance('addtowishlist')
                    ->content()
                    ->pluck('id');
                    @endphp
                    @foreach ($products as $product)
                    <div class="col-lg-4 col-md-6 col-sm-6 pb-1">
                        <div class="product-item bg-light mb-4">
                            <div class="product-img position-relative overflow-hidden">
                                <img class="img-fluid w-100" src="{{ asset('storage/products/' . $product->image) }}" alt="{{ $product->name }}">
                                <div class="product-action">
                                    <a class="btn btn-outline-dark btn-square" href="" title="Add to cart" wire:click.prevent="store({{ $product->id }}, '{{ $product->name }}', {{ $product->sale_price }})"><i class="fa fa-shopping-cart"></i></a>
                                    @if ($wishlist->contains($product->id))
                                    <a class="btn btn-outline-dark btn-square" href="" title="Remove from favorites" wire:click.prevent="removeFromWishlist({{ $product->id }})"><i class="fa fa-heart fill-heart"></i></a>
                                    @else
                                    <a class="btn btn-outline-dark btn-square" href=""  title="Add to favorites" wire:click.prevent="addToWishlist({{ $product->id }}, '{{ $product->name }}', {{ $product->sale_price }})"><i class="fa fa-heart"></i></a>
                                    @endif
                                    <a class="btn btn-outline-dark btn-square" href="" title="Reload"><i class="fa fa-sync-alt"></i></a>
                                    <a class="btn btn-outline-dark btn-square" href="{{ route('product.details', ['slug' => $product->slug]) }}" title="Details"><i class="fa fa-search"></i></a>
                                </div>
                            </div>
                            <div class="text-center py-4 overflow-hidden">
                                <a class="h6 text-decoration-none text-truncate" href="" id="{{ $product->name }}">{{ $product->name }}</a>
                                <div class="d-flex align-items-center justify-content-center mt-2">
                                    <h5>$ {{ $product->sale_price }}</h5>
                                    <h6 class="text-muted ml-2"><del>$ {{ $product->regular_price }}</del></h6>
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
                    {{ $products->links('layouts.pagination') }}
                </div>
            </div>
            <!-- Shop Product End -->
        </div>
    </div>
    <!-- Shop End -->
</div>
