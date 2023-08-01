<?php

namespace App\Http\Livewire\Admin;

use App\Models\Coupon;
use Livewire\Component;

class AddCouponComponent extends Component
{
    public $code;
    public $type;
    public $coupon_value;
    public $cart_value;
    public $visible;

    function update($fields)
    {
        $this->validateOnly($fields, [
            'code' => 'required | unique:code',
            'type' => 'required',
            'coupon_value' => 'required',
            'cart_value' => 'required'
        ]);
    }
    function storeCoupon(){
        $this->validate([
            'code' => 'required | unique:coupons,coupon_code',
            'type' => 'required',
            'coupon_value' => 'required',
            'cart_value' => 'required'
        ]);
        $coupon = new Coupon();
        $coupon->coupon_code = $this->code;
        $coupon->type = $this->type;
        $coupon->value = $this->coupon_value;
        $coupon->cart_value = $this->cart_value;
        $coupon->visible_user = $this->visible;
        $coupon->save();
        session()->flash('categoryAdded', 'Category Created successfully!');
    }
    public function render()
    {
        return view('livewire.admin.add-coupon-component')->layout('layouts.base');
    }
}
