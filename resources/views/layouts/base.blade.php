@php

use App\Models\Category;
use App\Models\Settings;
$categories = Category::all();
$settings = Settings::find(1);

@endphp

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>EasyBuy - Online Shop Website Template</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Free HTML Templates" name="keywords">
    <meta content="Free HTML Templates" name="description">

    <!-- Favicon -->
    <link href="storage/products/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href={{ asset('lib/animate/animate.min.css') }} rel="stylesheet">
    <link href={{ asset('lib/owlcarousel/assets/owl.carousel.min.css') }} rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css" integrity="sha512-aEe/ZxePawj0+G2R+AaIxgrQuKT68I28qh+wgLrcAJOz3rxCP+TwrK5SPN+E5I+1IQjNtcfvb96HDagwrKRdBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href={{ asset('css/style.css') }} rel="stylesheet">

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <script src={{ asset('lib/easing/easing.min.js') }}></script>
    <script src={{ asset('lib/owlcarousel/owl.carousel.min.js') }}></script>

    <!-- Contact Javascript File -->
    <script src={{ asset('mail/jqBootstrapValidation.min.js') }}></script>
    <script src={{ asset('mail/contact.js') }}></script>

    <!-- Template Javascript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src={{ asset('js/main.js') }}></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.19.1/moment.min.js" integrity="sha512-Dz4zO7p6MrF+VcOD6PUbA08hK1rv0hDv/wGuxSUjImaUYxRyK2gLC6eQWVqyDN9IM1X/kUA8zkykJS/gEVOd3w==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js" integrity="sha512-GDey37RZAxFkpFeJorEUwNoIbkTwsyC736KNSYucu1WJWFK9qTdzYub8ATxktr6Dwke7nbFaioypzbDOQykoRg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.2/bootstrap3-typeahead.min.js" integrity="sha512-HWlJyU4ut5HkEj0QsK/IxBCY55n5ZpskyjVlAoV9Z7XQwwkqXoYdCIC93/htL3Gu5H3R4an/S0h2NXfbZk3g7w==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    @livewireStyles

</head>

<body>

    <!-- Topbar Start -->
    <div class="container-fluid">
        <div class="py-1 row bg-secondary px-xl-5">
            <div class="col-lg-6 d-none d-lg-block">
                <div class="d-inline-flex align-items-center h-100">
                    <a class="mr-3 text-body" href="">About</a>
                    <a class="mr-3 text-body" href="">Contact</a>
                    <a class="mr-3 text-body" href="">Help</a>
                    <a class="mr-3 text-body" href="">FAQs</a>
                </div>
            </div>
            <div class="text-center col-lg-6 text-lg-right">
                <div class="d-inline-flex align-items-center">
                    @if (Route::has('login'))
                        @auth
                            @if (Auth::user()->userType === 'ADM')
                                <!-- Admin User -->
                                <div class="btn-group">
                                    <button type="button" class="btn btn-sm btn-light dropdown-toggle"
                                        data-toggle="dropdown">My Account ({{ Auth::user()->name }})</button>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        {{-- <a href=""><button class="dropdown-item" type="button">{{Auth::user()->name}}</button></a> --}}
                                        <a title="Dashboard" href="{{ route('admin.dashboard') }}"><button
                                                class="dropdown-item" type="button">Dashboard</button></a>
                                        <a title="Manage Categories" href="{{ route('admin.categories') }}"
                                            class="dropdown-item">Categories</a>
                                        <a title="Manage Products" href="{{ route('admin.products') }}"
                                            class="dropdown-item">Products</a>
                                        <a title="Manage Home Slider" href="{{ route('admin.homeslider') }}"
                                            class="dropdown-item">Manage Sliders</a>
                                        <a title="Manage Home Categories" href="{{ route('admin.homecategories') }}"
                                            class="dropdown-item">Manage Home Categories</a>
                                        {{-- <a title="Manage Sales Timers" href="{{ route('admin.salesTimers') }}"
                                            class="dropdown-item">Manage Sale Timers</a> --}}
                                        <a title="Manage Sales Timers" href="{{ route('admin.allcoupons') }}"
                                            class="dropdown-item">Manage Coupons</a>
                                        <a title="Manage Sales Timers" href="{{ route('admin.orders') }}"
                                            class="dropdown-item">All Orders</a>
                                        <a title="Manage Sales Timers" href="{{ route('admin.contact') }}"
                                            class="dropdown-item">All Contacts</a>
                                        <a title="Manage Sales Timers" href="{{ route('admin.settings') }}"
                                            class="dropdown-item">Settings</a>


                                        <!-- logout button starts here -->
                                        <a href="/logout"
                                            onclick="event.preventDefault(); document.getElementById('form-logout').submit();"><button
                                                class="dropdown-item" type="button">logout</button></a>
                                        <form action="{{ route('logout') }}" method="post" id="form-logout">
                                            @csrf
                                        </form>
                                        <!-- logout button ends here -->
                                    </div>
                                </div>
                            @else
                                <!-- normal user -->
                                <div class="btn-group">
                                    <button type="button" class="btn btn-sm btn-light dropdown-toggle"
                                        data-toggle="dropdown">My Account ({{ Auth::user()->name }})</button>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        {{-- <a href=""><button class="dropdown-item" type="button">{{Auth::user()->name}}</button></a> --}}
                                        <a href="{{ route('user.dashboard') }}"><button class="dropdown-item"
                                                type="button">Dashboard</button></a>

                                        <a href="{{ route('user.orders') }}"><button class="dropdown-item"
                                                type="button">My Orders</button></a>

                                        <a href="{{ route('user.changepassword') }}"><button class="dropdown-item"
                                                type="button">Change Password</button></a>

                                        <a href="/logout"
                                            onclick="event.preventDefault(); document.getElementById('form-logout').submit();"><button
                                                class="dropdown-item" type="button">logout</button></a>
                                        <form action="{{ route('logout') }}" method="post" id="form-logout">
                                            @csrf
                                        </form>
                                    </div>
                                </div>
                            @endif
                        @else
                            <div class="btn-group">
                                <button type="button" class="btn btn-sm btn-light dropdown-toggle"
                                    data-toggle="dropdown">My Account</button>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a href="{{ route('login') }}"><button class="dropdown-item" type="button">Log
                                            in</button></a>
                                    <a href="{{ route('register') }}"><button class="dropdown-item" type="button">Sign
                                            up</button></a>

                                </div>
                            </div>
                        @endif
                        @endif

                        <div class="mx-2 btn-group">
                            <button type="button" class="btn btn-sm btn-light dropdown-toggle"
                                data-toggle="dropdown">USD</button>
                            <div class="dropdown-menu dropdown-menu-right">
                                <button class="dropdown-item" type="button">EUR</button>
                                <button class="dropdown-item" type="button">GBP</button>
                                <button class="dropdown-item" type="button">CAD</button>
                            </div>
                        </div>
                        <div class="btn-group">
                            <button type="button" class="btn btn-sm btn-light dropdown-toggle"
                                data-toggle="dropdown">EN</button>
                            <div class="dropdown-menu dropdown-menu-right">
                                <button class="dropdown-item" type="button">FR</button>
                                <button class="dropdown-item" type="button">AR</button>
                                <button class="dropdown-item" type="button">RU</button>
                            </div>
                        </div>
                    </div>
                    <div class="d-inline-flex align-items-center d-block d-lg-none">
                        <a href="" class="px-0 ml-2 btn">
                            <i class="fas fa-heart text-dark"></i>
                            <span class="border badge text-dark border-dark rounded-circle"
                                style="padding-bottom: 2px;">0</span>
                        </a>
                        <a href="" class="px-0 ml-2 btn">
                            <i class="fas fa-shopping-cart text-dark"></i>
                            <span class="border badge text-dark border-dark rounded-circle"
                                style="padding-bottom: 2px;">0</span>
                        </a>
                    </div>
                </div>
            </div>
            <div class="py-3 row align-items-center bg-light px-xl-5 d-none d-lg-flex">
                <div class="col-lg-4">
                    <a href="/" class="text-decoration-none">
                        <span class="px-2 h1 text-uppercase text-primary bg-dark">Easy</span>
                        <span class="px-2 h1 text-uppercase text-dark bg-primary ml-n1">Buy</span>
                    </a>
                </div>

                @livewire('header-search-component')

                <div class="text-right col-lg-4 col-6">
                    <p class="m-0">Customer Service</p>
                    <h5 class="m-0">+012 345 6789</h5>
                </div>
            </div>
        </div>
        <!-- Topbar End -->


        <!-- Navbar Start -->
        <div class="container-fluid bg-dark mb-30">
            <div class="row px-xl-5">
                <div class="col-lg-3 d-none d-lg-block">
                    <a class="btn d-flex align-items-center justify-content-between bg-primary w-100"
                        data-toggle="collapse" href="#navbar-vertical" style="height: 65px; padding: 0 30px;">
                        <h6 class="m-0 text-dark"><i class="mr-2 fa fa-bars"></i>Categories</h6>
                        <i class="fa fa-angle-down text-dark"></i>
                    </a>
                    <nav class="p-0 collapse position-absolute navbar navbar-vertical navbar-light align-items-start bg-light"
                        id="navbar-vertical" style="width: calc(100% - 30px); z-index: 999;">
                        <div class="navbar-nav w-100">
                            <div class="nav-item dropdown dropright">
                                <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">Dresses <i
                                        class="float-right mt-1 fa fa-angle-right"></i></a>
                                <div class="m-0 border-0 dropdown-menu position-absolute rounded-0">
                                    <a href="" class="dropdown-item">Men's Dresses</a>
                                    <a href="" class="dropdown-item">Women's Dresses</a>
                                    <a href="" class="dropdown-item">Baby's Dresses</a>
                                </div>
                            </div>

                            @forelse ($categories as $category)
                                <a href="{{ route('product-category', ['category_slug' => $category->slug]) }}"
                                    class="nav-item nav-link">{{ $category->name }}</a>
                            @empty
                            @endforelse
                        </div>
                    </nav>
                </div>
                <div class="col-lg-9">
                    <nav class="px-0 py-3 navbar navbar-expand-lg bg-dark navbar-dark py-lg-0">
                        <a href="" class="text-decoration-none d-block d-lg-none">
                            <span class="px-2 h1 text-uppercase text-dark bg-light">Easy</span>
                            <span class="px-2 h1 text-uppercase text-light bg-primary ml-n1">Buy</span>
                        </a>
                        <button type="button" class="navbar-toggler" data-toggle="collapse"
                            data-target="#navbarCollapse">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                            <div class="py-0 mr-auto navbar-nav">
                                <a href="/" class="nav-item nav-link active">Home</a>
                                <a href="/shop" class="nav-item nav-link">Shop</a>
                                <!-- <a href="/details" class="nav-item nav-link">Shop Detail</a> -->
                                <div class="nav-item dropdown">
                                    <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">Pages <i
                                            class="mt-1 fa fa-angle-down"></i></a>
                                    <div class="m-0 border-0 dropdown-menu bg-primary rounded-0">
                                        <a href="/cart" class="dropdown-item">Shopping Cart</a>
                                        <a href="/checkout" class="dropdown-item">Checkout</a>
                                    </div>
                                </div>
                                <a href="/contact" class="nav-item nav-link">Contact</a>
                            </div>
                            <div class="py-0 ml-auto navbar-nav d-none d-lg-block">
                                @if (Route::has('login'))
                                    @auth
                                        @if (Auth::user()->userType === 'ADM')
                                            <!-- Admin User -->
                                            <a href="" class="px-0 btn">
                                                <i class="fa fa-trash text-primary" aria-hidden="true"></i>
                                                <span class="border badge text-secondary border-secondary rounded-circle"
                                                    style="padding-bottom: 2px;">0</span>
                                            </a>
                                        @endauth
                                    @endif

                                @endif
                                @livewire('add-to-wishlist')
                                @livewire('add-to-cart')

                            </div>
                        </div>
                    </nav>
                </div>
            </div>
        </div>
        <!-- Navbar End -->

        {{ $slot }}

        <!-- Footer Start -->
        <div class="pt-5 mt-5 container-fluid bg-dark text-secondary">
            <div class="pt-5 row px-xl-5">
                <div class="pr-3 mb-5 col-lg-4 col-md-12 pr-xl-5">
                    <h5 class="mb-4 text-secondary text-uppercase">Get In Touch</h5>
                    <p class="mb-4">Lorem ipsum dolor sit amet consectetur adipisicing elit. Nostrum ipsam excepturi reprehenderit corporis nisi pariatur, illo repellendus maiores fugit eos ut ipsa error dolore autem et totam nulla fugiat itaque?</p>
                    <p class="mb-2"><i class="mr-3 fa fa-map-marker-alt text-primary"></i>{{ $settings->address1 }}</p>
                    <p class="mb-2"><i class="mr-3 fa fa-envelope text-primary"></i>{{ $settings->email }}</p>
                    <p class="mb-0"><i class="mr-3 fa fa-phone-alt text-primary"></i>{{ $settings->phone1 }}</p>
                </div>
                <div class="col-lg-8 col-md-12">
                    <div class="row">
                        <div class="mb-5 col-md-4">
                            <h5 class="mb-4 text-secondary text-uppercase">Quick Shop</h5>
                            <div class="d-flex flex-column justify-content-start">
                                <a class="mb-2 text-secondary" href="#"><i
                                        class="mr-2 fa fa-angle-right"></i>Home</a>
                                <a class="mb-2 text-secondary" href="#"><i class="mr-2 fa fa-angle-right"></i>Our
                                    Shop</a>
                                <a class="mb-2 text-secondary" href="#"><i class="mr-2 fa fa-angle-right"></i>Shop
                                    Detail</a>
                                <a class="mb-2 text-secondary" href="#"><i
                                        class="mr-2 fa fa-angle-right"></i>Shopping Cart</a>
                                <a class="mb-2 text-secondary" href="#"><i
                                        class="mr-2 fa fa-angle-right"></i>Checkout</a>
                                <a class="text-secondary" href="#"><i class="mr-2 fa fa-angle-right"></i>Contact
                                    Us</a>
                            </div>
                        </div>
                        <div class="mb-5 col-md-4">
                            <h5 class="mb-4 text-secondary text-uppercase">My Account</h5>
                            <div class="d-flex flex-column justify-content-start">
                                <a class="mb-2 text-secondary" href="#"><i
                                        class="mr-2 fa fa-angle-right"></i>Home</a>
                                <a class="mb-2 text-secondary" href="#"><i class="mr-2 fa fa-angle-right"></i>Our
                                    Shop</a>
                                <a class="mb-2 text-secondary" href="#"><i class="mr-2 fa fa-angle-right"></i>Shop
                                    Detail</a>
                                <a class="mb-2 text-secondary" href="#"><i
                                        class="mr-2 fa fa-angle-right"></i>Shopping Cart</a>
                                <a class="mb-2 text-secondary" href="#"><i
                                        class="mr-2 fa fa-angle-right"></i>Checkout</a>
                                <a class="text-secondary" href="#"><i class="mr-2 fa fa-angle-right"></i>Contact
                                    Us</a>
                            </div>
                        </div>
                        <div class="mb-5 col-md-4">
                            <h5 class="mb-4 text-secondary text-uppercase">Newsletter</h5>
                            <p>Duo stet tempor ipsum sit amet magna ipsum tempor est</p>
                            <form action="">
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Your Email Address">
                                    <div class="input-group-append">
                                        <button class="btn btn-primary">Sign Up</button>
                                    </div>
                                </div>
                            </form>
                            <h6 class="mt-4 mb-3 text-secondary text-uppercase">Follow Us</h6>
                            <div class="d-flex">
                                <a class="mr-2 btn btn-primary btn-square" href="{{ $settings->twiter }}"><i
                                        class="fab fa-twitter"></i></a>
                                <a class="mr-2 btn btn-primary btn-square" href="{{ $settings->facebook }}"><i
                                        class="fab fa-facebook-f"></i></a>
                                <a class="mr-2 btn btn-primary btn-square" href="{{ $settings->pinterest }}"><i
                                        class="fab fa-pinterest"></i></a>
                                <a class="btn btn-primary btn-square" href="{{ $settings->instagram }}"><i class="fab fa-instagram"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="py-4 row border-top mx-xl-5" style="border-color: rgba(256, 256, 256, .1) !important;">
                <div class="col-md-6 px-xl-0">
                    <p class="text-center mb-md-0 text-md-left text-secondary">
                        &copy; <a class="text-primary" href="#">www.easybuy.com</a>. All Rights Reserved. Designed
                        by
                        <a class="text-primary" href="https://htmlcodex.com">HTML Codex</a>
                    </p>
                </div>
                <div class="text-center col-md-6 px-xl-0 text-md-right">
                    <img class="img-fluid" src="storage/products/payments.png" alt="">
                </div>
            </div>
        </div>
        <!-- Footer End -->

        <script src="https://cdn.tiny.cloud/1/lbmh4fiynmd2qxet1qnigem1y6s1mgute67g1pmij1ktc0al/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>

        @stack('scripts')
        @livewireScripts
    </body>

    </html>
