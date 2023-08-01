<?php

namespace App\Http\Livewire;

use App\Models\Coupon;
use Livewire\Component;

class OffersComponent extends Component
{
    public $couponCode;

    function ApplyCoupon(){
        $this->couponCode;
        $coupon = Coupon::where('coupon_code', $this->couponCode)->first();
        if(! $coupon){
            session()->flash('error', "Coupon is invalid...");
        }
        else{
            dd($coupon);

        }
    }
    public function render()
    {
        $coupons = Coupon::where('visible_user', 1)->get();
        return view('livewire.offers-component', ['coupons' => $coupons])->layout('layouts.base');
    }
}
