<div>
    <!-- Breadcrumb Start -->
    @php
        $avg_rating = 0;
        $rating = 0;
    @endphp
    <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-12">
                <nav class="breadcrumb bg-light mb-30">
                    <a class="breadcrumb-item text-dark" href="#">Home</a>
                    <a class="breadcrumb-item text-dark" href="#">Shop</a>
                    <span class="breadcrumb-item active">Shop Detail</span>
                </nav>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->

    <!-- Shop Detail Start -->
    <div class="container-fluid pb-5">
        <div class="row px-xl-5">
            <div class="col-lg-5 mb-30">
                <div id="product-carousel" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner bg-light">
                        <div class="carousel-item active">
                            <img class="w-100 h-100" src="{{ asset('storage/products/' . $product->image) }}"
                                alt="Image">
                        </div>
                        <div class="carousel-item">
                            <img class="w-100 h-100" src="{{ asset('storage/products/' . $product->image) }}"
                                alt="Image">
                        </div>
                        <div class="carousel-item">
                            <img class="w-100 h-100" src="{{ asset('storage/products/' . $product->image) }}"
                                alt="Image">
                        </div>
                        <div class="carousel-item">
                            <img class="w-100 h-100" src="{{ asset('storage/products/' . $product->image) }}"
                                alt="Image">
                        </div>
                    </div>
                    <a class="carousel-control-prev" href="#product-carousel" data-slide="prev">
                        <i class="fa fa-2x fa-angle-left text-dark"></i>
                    </a>
                    <a class="carousel-control-next" href="#product-carousel" data-slide="next">
                        <i class="fa fa-2x fa-angle-right text-dark"></i>
                    </a>
                </div>
            </div>

            @php
                $wishlist = Cart::instance('addtowishlist')
                    ->content()
                    ->pluck('id');
            @endphp

            <div class="col-lg-7 h-auto mb-30">
                <div class="h-100 bg-light p-30">
                    <h3>{{ $product->name }}</h3>
                    <div class="d-flex mb-3">
                        <div class="text-primary mr-2">
                            @foreach ($product->orderItems->where('rs_status', 1) as $order_item)
                                @php
                                    $avg_rating = $avg_rating + $order_item->review->rating / $product->orderItems->where('rs_status', 1)->count();
                                @endphp
                            @endforeach
                                @for ($i = 1; $i <= 5; $i++)
                                    @if ($i <= $avg_rating)
                                        {{-- @dd($avg_rating) --}}
                                        <i class="fa fa-star fill-star" aria-hidden="true"></i>
                                    @else
                                        <i class="far fa-star"></i>
                                    @endif
                                @endfor
                        </div>
                        <small class="pt-1">({{ $product->orderItems->where('rs_status', 1)->count() }}
                            Reviews)</small>
                    </div>
                    <div class="d-flex align-items-center justify-content-start mt-2">
                        <h3>${{ $product->sale_price }}</h3>
                        <h4 class="text-muted ml-2"><del>${{ $product->regular_price }}</del></h4>
                    </div>
                    <h4 class="mb-2">Discount : {{ $product->discount }}%</h4>
                    <p class="mb-4">{!! $product->short_description !!}</p>

                    <div class="d-flex align-items-center mb-4 pt-2">
                        <button class="btn btn-primary px-3"
                            wire:click.prevent="store({{ $product->id }}, '{{ $product->name }}', {{ $product->sale_price }})"><i
                                class="fa fa-shopping-cart mr-1"></i> Add To
                            Cart</button>

                        @if ($wishlist->contains($product->id))
                            <button class="btn btn-primary px-3 ml-1"
                                wire:click.prevent="removeFromWishlist({{ $product->id }})">
                                <i class="fa fa-heart fill-heart mr-1"></i> Remove From WishList</button>
                        @else
                            <button class="btn btn-primary px-3 ml-1"
                                wire:click.prevent="addToWishlist({{ $product->id }}, '{{ $product->name }}', {{ $product->sale_price }})">
                                <i class="fa fa-heart mr-1"></i> Add To WishList</button>
                        @endif

                    </div>
                    <div class="d-flex pt-2">
                        <strong class="text-dark mr-2">Share on:</strong>
                        <div class="d-inline-flex">
                            <a class="text-dark px-2" href="">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                            <a class="text-dark px-2" href="">
                                <i class="fab fa-twitter"></i>
                            </a>
                            <a class="text-dark px-2" href="">
                                <i class="fab fa-linkedin-in"></i>
                            </a>
                            <a class="text-dark px-2" href="">
                                <i class="fab fa-pinterest"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <x-featured />
        <div class="row px-xl-5">
            <div class="col">
                <div class="bg-light p-30">
                    <div class="nav nav-tabs mb-4">
                        <a class="nav-item nav-link text-dark active" data-toggle="tab"
                            href="#tab-pane-1">Description</a>
                        <a class="nav-item nav-link text-dark" data-toggle="tab" href="#tab-pane-2">Information</a>
                        <a class="nav-item nav-link text-dark" data-toggle="tab" href="#tab-pane-3">Reviews
                            ({{ $product->orderItems->where('rs_status', 1)->count() }})</a>
                    </div>
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="tab-pane-1">
                            <h4 class="mb-3">Product Description</h4>
                            {{-- <p>{!! $product->short_description !!}</p> --}}
                            <p>{!! $product->description !!}</p>
                        </div>
                        <div class="tab-pane fade" id="tab-pane-2">
                            <h4 class="mb-3">Additional Information</h4>
                            <p>{!! $product->short_description !!}</p>
                            <p>{!! $product->description !!}</p>
                            <div class="row">

                            </div>
                        </div>


                        <div class="tab-pane fade" id="tab-pane-3">
                            <div class="row">
                                <div class="col-md-6">
                                    <h4 class="mb-4">{{ $product->orderItems->where('rs_status', 1)->count() }}
                                        review(s) for "{{ $product->name }}"</h4>
                                    @foreach ($product->orderItems->where('rs_status', 1) as $order_item)
                                        @php
                                            $rating = $order_item->review->rating;
                                        @endphp
                                        <div class="media mb-4">
                                            <img src="{{ asset('storage/products/user.jpg') }}" alt="Image"
                                                class="img-fluid mr-3 mt-1" style="width: 45px;">
                                            <div class="media-body">
                                                <h6>{{ $order_item->review->name }}<small> -
                                                        <i>{{ Carbon\Carbon::parse($order_item->review->created_at)->format('d F Y h:i A') }}</i></small>
                                                </h6>
                                                <div class="text-primary mb-2">
                                                    @for ($i = 1; $i <= 5; $i++)
                                                        @if ($i <= $rating)
                                                            {{-- @dd($avg_rating) --}}
                                                            <i class="fa fa-star fill-star" aria-hidden="true"></i>
                                                        @else
                                                            <i class="far fa-star"></i>
                                                        @endif
                                                    @endfor
                                                </div>
                                                <p>{{ $order_item->review->comment }}</p>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                {{-- <div class="col-md-6">
                                <h4 class="mb-4">Leave a review</h4>
                                <small>Your email address will not be published. Required fields are marked
                                    *</small>
                                <div class="d-flex my-3">
                                    <p class="mb-0 mr-2">Your Rating * :</p>
                                    <div class="text-primary">
                                        <i class="far fa-star"></i>
                                        <i class="far fa-star"></i>
                                        <i class="far fa-star"></i>
                                        <i class="far fa-star"></i>
                                        <i class="far fa-star"></i>
                                    </div>
                                </div>
                                <form>
                                    <div class="form-group">
                                        <label for="message">Your Review *</label>
                                        <textarea id="message" cols="30" rows="5" class="form-control"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="name">Your Name *</label>
                                        <input type="text" class="form-control" id="name">
                                    </div>
                                    <div class="form-group">
                                        <label for="email">Your Email *</label>
                                        <input type="email" class="form-control" id="email">
                                    </div>
                                    <div class="form-group mb-0">
                                        <input type="submit" value="Leave Your Review"
                                            class="btn btn-primary px-3">
                                    </div>
                                </form>
                            </div> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Shop Detail End -->

    <!-- Products Start -->
    <div class="container-fluid pt-5 pb-3">
        <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4"><span
                class="bg-secondary pr-3">Related Products</span></h2>
        <div class="row px-xl-5">
            @foreach ($related_product as $product)
                <div class="col-lg-3 col-md-4 col-sm-6 pb-1">
                    <div class="product-item bg-light mb-4">
                        <div class="product-img position-relative overflow-hidden">
                            <img class="img-fluid w-100" src="{{ asset('storage/products/' . $product->image) }}"
                                alt="">
                            <div class="product-action">
                                <a class="btn btn-outline-dark btn-square" href=""
                                    wire:click.prevent="store({{ $product->id }}, '{{ $product->name }}', {{ $product->sale_price }})"><i
                                        class="fa fa-shopping-cart"></i></a>
                                <a class="btn btn-outline-dark btn-square" href=""><i
                                        class="far fa-heart"></i></a>
                                <a class="btn btn-outline-dark btn-square" href=""><i
                                        class="fa fa-sync-alt"></i></a>
                                <a class="btn btn-outline-dark btn-square"
                                    href="{{ route('product.details', ['slug' => $product->slug]) }}"><i
                                        class="fa fa-search"></i></a>
                            </div>
                        </div>
                        <div class="text-center py-4 overflow-hidden">
                            <a class="h6 text-decoration-none text-truncate" href="">{{ $product->name }}</a>
                            <div class="d-flex align-items-center justify-content-center mt-2">
                                <h5>${{ $product->sale_price }}</h5>
                                <h6 class="text-muted ml-2"><del>${{ $product->regular_price }}</del></h6>
                            </div>
                            <div class="d-flex align-items-center justify-content-center mb-1">
                                @for ($i = 1; $i <= 5; $i++)
                                    @if ($i <= $avg_rating)
                                        <small class="fa fa-star text-primary mr-1"></small>
                                    @else
                                        <small class="far fa-star text-primary mr-1"></small>
                                    @endif
                                @endfor
                                <small>(99)</small>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <!-- Products End -->
</div>
