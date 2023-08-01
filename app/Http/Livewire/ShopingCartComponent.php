<?php

namespace App\Http\Livewire;

use App\Models\Coupon;
use Gloudemans\Shoppingcart\Facades\Cart;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class ShopingCartComponent extends Component
{
    public $couponCode;
    public $discount;
    public $tax_with_discount;
    public $sub_total_with_discount;
    public $total_with_discount;
    public $subTotal;

    function increaseQuantity($rowId){
        $product = Cart::instance('addtocart')->get($rowId);
        $qty = $product->qty + 1;
        Cart::instance('addtocart')->update($rowId, $qty);
        $this->emitTo('add-to-cart', 'refreshComponent');
    }
    function decreaseQuantity($rowId){
        $product = Cart::instance('addtocart')->get($rowId);
        $qty = $product->qty - 1;
        Cart::instance('addtocart')->update($rowId, $qty);
        $this->emitTo('add-to-cart', 'refreshComponent');


    }
    function removeProduduct($rowId){
        Cart::instance('addtocart')->remove($rowId);
        session()->flash('deleted', 'Product Removed from cart.');
        $this->emitTo('add-to-cart', 'refreshComponent');
    }

    function ApplyCoupon(){
        $this->couponCode;
        $this->subTotal = str_replace(',', '', Cart::instance('addtocart')->subtotal());
        $coupon = Coupon::where('coupon_code', $this->couponCode)->where('cart_value', '<=', $this->subTotal)->first();
        // dd($coupon);
        // dd();
        if(! $coupon){
            session()->flash('error', "Coupon is invalid...");
        }
        else
        {
            session()->put('coupon', [
                'code' => $coupon->coupon_code,
                'type' => $coupon->type,
                'value'=> $coupon->value,
                'cart_value' => $coupon->cart_value
            ]);
            // dd(session('coupon'));
        }
    }

    function calculateDiscount(){
        $this->subTotal = str_replace(',', '', Cart::instance('addtocart')->subtotal());
        // dd($this->subTotal);
        if(session()->has('coupon')){
            if(session()->get('coupon')['type'] == 'fixed'){
                $this->discount = session()->get('coupon')['cart_value'];
            }
            else{
                $this->discount = number_format((float)$this->subTotal * (float)session()->get('coupon')['value'] / 100, 2);
            }
            $this->sub_total_with_discount = $this->subTotal - $this->discount;
            $this->tax_with_discount = number_format(((float)$this->sub_total_with_discount * (float)config('cart.tax')) / 100, 2);
            $this->total_with_discount = number_format($this->sub_total_with_discount + $this->tax_with_discount, 2);
        }
    }

    public function checkout(){
        if(Auth::check()){
            return redirect()->route('product.checkout');
        }
        else{
            return redirect()->route('login');
        }
    }

    public function setAmountForCheckout(){
        if(Cart::instance('addtocart')->count() > 0){
            session()->forget('checkout');
        }
        if(session()->has('coupon')){
            session()->put('checkout', [
                'discount' => $this->discount,
                'subTotal' => $this->sub_total_with_discount,
                'tax'      => $this->tax_with_discount,
                'total'    => $this->total_with_discount,
            ]);
        }
        else{
            session()->put('checkout', [
                'discount' => 0,
                'subTotal' => Cart::instance('addtocart')->subtotal(),
                'tax'      => Cart::instance('addtocart')->tax(),
                'total'    => Cart::instance('addtocart')->total(),
            ]);
        }
    }

    public function render()
    {
        if(session()->has('coupon')){
            if($this->subTotal < session()->get('coupon')['value']){
                session()->forget('coupon');
            }
            else{
                $this->calculateDiscount();
            }
        }
        $this->setAmountForCheckout();
        return view('livewire.shoping-cart-component')->layout('layouts.base');
    }
}
