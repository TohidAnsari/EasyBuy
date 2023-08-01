 <div>
     <!-- Carousel Start -->
     <div class="container-fluid mb-3">
         <div class="row px-xl-5">
             <div class="col-lg-8">
                 <div id="header-carousel" class="carousel slide carousel-fade" data-bs-ride="carousel" data-loop="1"
                     data-nav="true">
                     <ol class="carousel-indicators">
                         <li data-target="#header-carousel" data-slide-to="0" class="active"></li>

                         @for ($i = 1; $i < count($slides); $i++)
                             <li data-target="#header-carousel" data-slide-to="{{ $i }}"></li>
                         @endfor
                         {{-- @dd(count($slides)); --}}

                     </ol>
                     <div class="carousel-inner">
                         <div class="carousel-item position-relative active" style="height: 430px;">
                             <img class="position-absolute w-100 h-100"
                                 src={{ asset('storage/products/sliders/' . $slides[4]->image) }}
                                 style="object-fit: cover;">
                             <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                                 <div class="p-3" style="max-width: 700px;">
                                     <h1 class="display-4 text-white mb-3 animate__animated animate__fadeInDown">
                                         {{ $slides[4]->title }}</h1>
                                     <p class="mx-md-5 px-5 animate__animated animate__bounceIn">
                                         {{ $slides[4]->subtitle }}</p>
                                     <p class="mx-md-5 px-5 animate__animated animate__bounceIn">Staring at just
                                         ${{ $slides[4]->price }}</p>
                                     <a class="btn btn-outline-light py-2 px-4 mt-3 animate__animated animate__fadeInUp"
                                         href="{{ $slides[4]->link }}">Shop Now</a>
                                 </div>
                             </div>
                         </div>
                         @foreach ($slides as $slid)
                             <div class="carousel-item position-relative" style="height: 430px;">
                                 <img class="position-absolute w-100 h-100"
                                     src={{ asset('storage/products/sliders/' . $slid->image) }}
                                     style="object-fit: cover;">
                                 <div
                                     class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                                     <div class="p-3" style="max-width: 700px;">
                                         <h1 class="display-4 text-white mb-3 animate__animated animate__fadeInDown">
                                             {{ $slid->title }}</h1>
                                         <p class="mx-md-5 px-5 animate__animated animate__bounceIn">
                                             {{ $slid->subtitle }}</p>
                                         <p class="mx-md-5 px-5 animate__animated animate__bounceIn">Staring at just
                                             ${{ $slid->price }}</p>

                                         <a class="btn btn-outline-light py-2 px-4 mt-3 animate__animated animate__fadeInUp"
                                             href="{{ $slid->link }}">Shop Now</a>
                                     </div>
                                 </div>
                             </div>
                         @endforeach
                     </div>
                 </div>
             </div>
             <div class="col-lg-4">
                 <div class="product-offer mb-30" style="height: 200px;">
                     <img class="img-fluid" src={{ asset('storage/products/offer-1.jpg') }} alt="">
                     <div class="offer-text">
                         <h6 class="text-white text-uppercase">Save 20%</h6>
                         <h3 class="text-white mb-3">Special Offer</h3>
                         <a href="" class="btn btn-primary">Shop Now</a>
                     </div>
                 </div>
                 <div class="product-offer mb-30" style="height: 200px;">
                     <img class="img-fluid" src={{ asset('storage/products/offer-2.jpg') }} alt="">
                     <div class="offer-text">
                         <h6 class="text-white text-uppercase">Save 20%</h6>
                         <h3 class="text-white mb-3">Special Offer</h3>
                         <a href="" class="btn btn-primary">Shop Now</a>
                     </div>
                 </div>
             </div>
         </div>
     </div>
     <!-- Carousel End -->


     <!-- Featured Start -->
     <div class="container-fluid pt-5">
         <div class="row px-xl-5 pb-3">
             <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
                 <div class="d-flex align-items-center bg-light mb-4" style="padding: 30px;">
                     <h1 class="fa fa-check text-primary m-0 mr-3"></h1>
                     <h5 class="font-weight-semi-bold m-0">Quality Product</h5>
                 </div>
             </div>
             <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
                 <div class="d-flex align-items-center bg-light mb-4" style="padding: 30px;">
                     <h1 class="fa fa-shipping-fast text-primary m-0 mr-2"></h1>
                     <h5 class="font-weight-semi-bold m-0">Free Shipping</h5>
                 </div>
             </div>
             <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
                 <div class="d-flex align-items-center bg-light mb-4" style="padding: 30px;">
                     <h1 class="fas fa-exchange-alt text-primary m-0 mr-3"></h1>
                     <h5 class="font-weight-semi-bold m-0">14-Day Return</h5>
                 </div>
             </div>
             <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
                 <div class="d-flex align-items-center bg-light mb-4" style="padding: 30px;">
                     <h1 class="fa fa-phone-volume text-primary m-0 mr-3"></h1>
                     <h5 class="font-weight-semi-bold m-0">24/7 Support</h5>
                 </div>
             </div>
         </div>
     </div>
     <!-- Featured End -->
     <!-- Categories Start -->
     <div class="container-fluid pt-5">
         <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4"><span
                 class="bg-secondary pr-3">Categories</span></h2>
         <div class="row px-xl-5 pb-3">
             @foreach ($categories as $category)
                 @php
                     $products = DB::table('products')
                         ->where('category_id', $category->id)
                         ->get();
                 @endphp
                 <div class="col-lg-3 col-md-4 col-sm-6 pb-1 active">
                     <a class="text-decoration-none"
                         href="{{ route('product-category', ['category_slug' => $category->slug]) }}">
                         <div class="cat-item d-flex align-items-center mb-4">
                             <div class="overflow-hidden" style="width: 100px; height: 100px;">
                                 <img class="img-fluid"
                                     src="{{ asset('storage/products/HomeCategory/' . $category->thumbnail) }}"
                                     alt="" style="height: 100%; width: 100%;">
                             </div>
                             <div class="flex-fill pl-3">
                                 <h6>{{ $category->name }}</h6>
                                 <small class="text-body">{{ $category->quantity }} Products</small>
                             </div>
                         </div>
                     </a>
                 </div>
             @endforeach
         </div>
     </div>
     <!-- Categories End -->

     <!-- Products Start -->
     <div class="container-fluid pt-5 pb-3">
         <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4"><span class="bg-secondary pr-3">Latest
                 Products</span></h2>
         <div class="row px-xl-5">
             @php
                 $wishlist = Cart::instance('addtowishlist')
                     ->content()
                     ->pluck('id');
             @endphp
             @foreach ($latest_products as $product)
                 <div class="col-lg-3 col-md-4 col-sm-6 pb-1">
                     <div class="product-item bg-light mb-4">
                         <div class="product-img position-relative overflow-hidden">
                             <img class="img-fluid w-100" src="{{ asset('storage/products/' . $product->image) }}"
                                 alt="{{ $product->name }}">
                             <div class="product-action">
                                 <a class="btn btn-outline-dark btn-square" href="javascript:void(0)"
                                     title="Add to cart"
                                     wire:click.prevent="store({{ $product->id }}, '{{ $product->name }}', {{ $product->sale_price }})"><i
                                         class="fa fa-shopping-cart"></i></a>
                                 @if ($wishlist->contains($product->id))
                                     <a class="btn btn-outline-dark btn-square" href=""
                                         title="Remove from favorites"
                                         wire:click.prevent="removeFromWishlist({{ $product->id }})"><i
                                             class="fa fa-heart fill-heart"></i></a>
                                 @else
                                     <a class="btn btn-outline-dark btn-square" href=""
                                         title="Add to favorites"
                                         wire:click.prevent="addToWishlist({{ $product->id }}, '{{ $product->name }}', {{ $product->sale_price }})"><i
                                             class="fa fa-heart"></i></a>
                                 @endif
                                 <a class="btn btn-outline-dark btn-square" href="" title="Reload"><i
                                         class="fa fa-sync-alt"></i></a>
                                 <a class="btn btn-outline-dark btn-square"
                                     href="{{ route('product.details', ['slug' => $product->slug]) }}"
                                     title="Details"><i class="fa fa-search"></i></a>
                             </div>
                         </div>
                         <div class="text-center py-4 overflow-hidden">
                             <a class="h6 text-decoration-none text-truncate"
                                 href="{{ route('product.details', ['slug' => $product->slug]) }}"
                                 id="{{ $product->name }}">{{ $product->name }}</a>
                             <div class="d-flex align-items-center justify-content-center mt-2">
                                 <h5>${{ $product->sale_price }}</h5>
                                 <h6 class="text-muted ml-2"><del>${{ $product->regular_price }}</del></h6>
                             </div>
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
             {{ $latest_products->links('layouts.pagination') }}

         </div>
     </div>
     <!-- Products End -->

     <!-- Offer Start -->
     <div class="container-fluid pt-5 pb-3">
         <div class="row px-xl-5">
             <div class="col-md-6">
                 <div class="product-offer mb-30" style="height: 300px;">
                     <img class="img-fluid" src="storage/products/offer-1.jpg" alt="">
                     <div class="offer-text">
                         <h6 class="text-white text-uppercase">Save 20%</h6>
                         <h3 class="text-white mb-3">Special Offer</h3>
                         <a href="" class="btn btn-primary">Shop Now</a>
                     </div>
                 </div>
             </div>
             <div class="col-md-6">
                 <div class="product-offer mb-30" style="height: 300px;">
                     <img class="img-fluid" src="storage/products/offer-2.jpg" alt="">
                     <div class="offer-text">
                         <h6 class="text-white text-uppercase">Save 20%</h6>
                         <h3 class="text-white mb-3">Special Offer</h3>
                         <a href="" class="btn btn-primary">Shop Now</a>
                     </div>
                 </div>
             </div>
         </div>
     </div>
     <!-- Offer End -->

     <!-- Products Start -->
     <div class="container-fluid pt-5 pb-3">
         <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4"><span
                 class="bg-secondary pr-3">Featurd Products</span></h2>
         <div class="row px-xl-5">
             @foreach ($featurd_products as $product)
                 <div class="col-lg-3 col-md-4 col-sm-6 pb-1">
                     <div class="product-item bg-light mb-4">
                         <div class="product-img position-relative overflow-hidden">
                             <img class="img-fluid w-100" src="{{ asset('storage/products/' . $product->image) }}"
                                 alt="{{ $product->name }}">
                             <div class="product-action">
                                 <a class="btn btn-outline-dark btn-square" href="javascript:void(0)"
                                     title="Add to cart"
                                     wire:click.prevent="store({{ $product->id }}, '{{ $product->name }}', {{ $product->regular_price }})"><i
                                         class="fa fa-shopping-cart"></i></a>
                                 <a class="btn btn-outline-dark btn-square" href=""
                                     title="Add to favorites"><i class="far fa-heart"></i></a>
                                 <a class="btn btn-outline-dark btn-square" href="" title="Reload"><i
                                         class="fa fa-sync-alt"></i></a>
                                 <a class="btn btn-outline-dark btn-square"
                                     href="{{ route('product.details', ['slug' => $product->slug]) }}"
                                     title="Details"><i class="fa fa-search"></i></a>
                             </div>
                         </div>
                         <div class="text-center py-4 overflow-hidden">
                             <a class="h6 text-decoration-none text-truncate"
                                 href="{{ route('product.details', ['slug' => $product->slug]) }}"
                                 id="{{ $product->name }}">{{ $product->name }}</a>
                             <div class="d-flex align-items-center justify-content-center mt-2">
                                 <h5>${{ $product->sale_price }}</h5>
                                 <h6 class="text-muted ml-2"><del>${{ $product->regular_price }}</del></h6>
                             </div>
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
             {{ $featurd_products->links('layouts.pagination') }}

         </div>
     </div>
     <!-- Products End -->

     <!-- Vendor Start -->
     <div class="container-fluid py-5">
         <div class="row px-xl-5">
             <div class="col">
                 <div class="owl-carousel vendor-carousel">
                     <div class="bg-light p-4">
                         <img src="storage/products/vendor-1.jpg" alt="">
                     </div>
                     <div class="bg-light p-4">
                         <img src="storage/products/vendor-2.jpg" alt="">
                     </div>
                     <div class="bg-light p-4">
                         <img src="storage/products/vendor-3.jpg" alt="">
                     </div>
                     <div class="bg-light p-4">
                         <img src="storage/products/vendor-4.jpg" alt="">
                     </div>
                     <div class="bg-light p-4">
                         <img src="storage/products/vendor-5.jpg" alt="">
                     </div>
                     <div class="bg-light p-4">
                         <img src="storage/products/vendor-6.jpg" alt="">
                     </div>
                     <div class="bg-light p-4">
                         <img src="storage/products/vendor-7.jpg" alt="">
                     </div>
                     <div class="bg-light p-4">
                         <img src="storage/products/vendor-8.jpg" alt="">
                     </div>
                 </div>
             </div>
         </div>
     </div>
     <!-- Vendor End -->
 </div>
