<?php

/*------------------------------------------------------
--------------------------------------------------------
-------------------- Imports For Admin -----------------
--------------------------------------------------------
------------------------------------------------------*/

use App\Http\Livewire\Admin\AdminOrderDetailsComponent;
use App\Http\Livewire\Admin\AdminOredersComponent;
use App\Http\Livewire\Admin\AddCouponComponent;
use App\Http\Livewire\Admin\AddNewHomeSlider;
use App\Http\Livewire\Admin\AdminAddCategoryComponent;
use App\Http\Livewire\Admin\AdminAddHomeSlider;
use App\Http\Livewire\Admin\AdminAddProductComponent;
use App\Http\Livewire\Admin\AdminEditCategoryComponent;
use App\Http\Livewire\Admin\AdminEditProductComponent;
use App\Http\Livewire\Admin\CategorisComponent;
use App\Http\Livewire\Admin\AdminDashboard;
use App\Http\Livewire\Admin\AdminEditHomeSlider;
use App\Http\Livewire\Admin\AdminHomeCategoryComponent;
use App\Http\Livewire\Admin\AdminHomeSlider;
use App\Http\Livewire\Admin\AdminSalesComponent;
use App\Http\Livewire\Admin\AllCouponsComponent;
use App\Http\Livewire\Admin\EditCouponComponent;
use App\Http\Livewire\Admin\ProductComponent;
use App\Http\Livewire\Admin\AdminContactComponent;
use App\Http\Livewire\Admin\AdminSettingsComponent;

/*------------------------------------------------------
--------------------------------------------------------
-------------------- Imports For User ------------------
--------------------------------------------------------
------------------------------------------------------*/
use App\Http\Livewire\User\UserOrdersComponent;
use App\Http\Livewire\User\UserOrderDetailsComponent;
use App\Http\Livewire\User\UserReviewComponent;
use App\Http\Livewire\User\UserChangePasswordComponent;


/*------------------------------------------------------
--------------------------------------------------------
-------------------- Other Main Imports ----------------
--------------------------------------------------------
------------------------------------------------------*/
use App\Http\Livewire\CategoryComponent;
use App\Http\Livewire\CheckoutComponent;
use App\Http\Livewire\ContactComponent;
use App\Http\Livewire\HeaderSearchResultsComponent;
use App\Http\Livewire\HomeComponent;
use App\Http\Livewire\MyWishlistComponent;
use App\Http\Livewire\OffersComponent;
use App\Http\Livewire\ShopComponent;
use App\Http\Livewire\ThankYouComponent;
use App\Http\Livewire\ShopDetailsComponent;
use App\Http\Livewire\ShopingCartComponent;
use App\Http\Livewire\User\UserDashboard;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\AuthAdmin;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


/*---------------------------------------------------------------------------
|----------------------------------------------------------------------------
|----------------------------- Routes For All Users -------------------------
|----------------------------------------------------------------------------
|--------------------------------------------------------------------------*/

Route::get('/', HomeComponent::class);
Route::get('/checkout', CheckoutComponent::class)->name('product.checkout');
Route::get('/shop', ShopComponent::class)->name('product.shop');
Route::get('/details/{slug}', ShopDetailsComponent::class)->name('product.details');
Route::get('/contact', ContactComponent::class)->name('contact');
Route::get('/cart', ShopingCartComponent::class)->name('product.cart');
Route::get('/wishlist', MyWishlistComponent::class)->name('product.wishlist');
Route::get('/Product-category/{category_slug}', CategoryComponent::class)->name('product-category');
Route::get('/Search', HeaderSearchResultsComponent::class)->name('product-search');
Route::get('/thank-you', ThankYouComponent::class)->name('thank-you');




// Route::get('/offers-and-coupons', OffersComponent::class)->name('product.offers');
/*---------------------------------------------------------------------------
|----------------------------------------------------------------------------
|----------------------------- Routes For Admin Users -----------------------
|----------------------------------------------------------------------------
|--------------------------------------------------------------------------*/

Route::middleware(['auth:sanctum', 'verified', 'authadmin'])->group(function () {

    Route::get('admin/dashboard',  AdminDashboard::class)->name('admin.dashboard');
    // managing categories
    Route::get('admin/categories',  CategorisComponent::class)->name('admin.categories');
    Route::get('admin/category/add',  AdminAddCategoryComponent::class)->name('admin.addcategory');
    Route::get('admin/category/edit/{slug}',  AdminEditCategoryComponent::class)->name('admin.editcategory');

    // managing products
    Route::get('/admin/products', ProductComponent::class)->name('admin.products');
    Route::get('/admin/products/add', AdminAddProductComponent::class)->name('admin.addproducts');
    Route::get('/admin/products/edit/{product_slug}', AdminEditProductComponent::class)->name('admin.editproducts');

    // managing sliders
    Route::get('/admin/slider', AdminHomeSlider::class)->name('admin.homeslider');
    Route::get('/admin/slider/add', AddNewHomeSlider::class)->name('admin.addnewslide');
    Route::get('/admin/slider/add', AddNewHomeSlider::class)->name('admin.AddSlider');
    Route::get('/admin/slider/edit/{slider_id}', AdminEditHomeSlider::class)->name('admin.edithomeslider');

    // managing home category
    Route::get('/admin/home-categories', AdminHomeCategoryComponent::class)->name('admin.homecategories');

    // managing Sales Timers
    Route::get('/admin/sales-timers', AdminSalesComponent::class)->name('admin.salesTimers');

    // managing coupons
    Route::get('/admin/all-coupons', AllCouponsComponent::class)->name('admin.allcoupons');
    Route::get('/admin/add-coupons', AddCouponComponent::class)->name('admin.addcoupons');
    Route::get('/admin/edit-coupons/{coupon_id}', EditCouponComponent::class)->name('admin.editcoupon');

    //orders and Details
    Route::get('/admin/orders', AdminOredersComponent::class)->name('admin.orders');
    Route::get('/admin/order-details/{order_id}', AdminOrderDetailsComponent::class)->name('admin.orderDetails');

    //Contacts
    Route::get('/admin/contact', AdminContactComponent::class)->name('admin.contact');

    //Page Settings
    Route::get('/admin/settings', AdminSettingsComponent::class)->name('admin.settings');
});



/*---------------------------------------------------------------------------
|----------------------------------------------------------------------------
|------------------------- Routes For Logged in Users -----------------------
|----------------------------------------------------------------------------
|--------------------------------------------------------------------------*/

Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get('user/dashboard', UserDashboard::class)->name('user.dashboard');
    Route::get('user/orders', UserOrdersComponent::class)->name('user.orders');
    Route::get('user/orders-details/{order_id}', UserOrderDetailsComponent::class)->name('user.orderDetails');
    Route::get('user/rate-review/{order_item_id}', UserReviewComponent::class)->name('user.ratereviews');
    Route::get('user/change-password', UserChangePasswordComponent::class)->name('user.changepassword');
});
