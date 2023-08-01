<?php

namespace App\Http\Livewire\Admin;

use App\Models\Coupon;
use Livewire\Component;

class EditCouponComponent extends Component
{

    public $code;
    public $type;
    public $coupon_value;
    public $cart_value;
    public $visible;
    public $coupon_id;

    function mount($coupon_id){
        $coupon = Coupon::find($coupon_id);
        $this->code             =   $coupon->coupon_code;
        $this->type             =   $coupon->type;
        $this->coupon_value     =   $coupon->value;
        $this->cart_value       =   $coupon->cart_value;
        $this->visible          =   $coupon->visible_user;
        $this->coupon_id        =   $coupon->id;
        // dd($coupon_id);
    }
    function update($fields)
    {
        $this->validateOnly($fields, [
            'code' => 'required | unique:code',
            'type' => 'required',
            'coupon_value' => 'required',
            'cart_value' => 'required'
        ]);
    }
    function editCoupon(){
        $this->validate([
            'type' => 'required',
            'coupon_value' => 'required',
            'cart_value' => 'required'
        ]);
        $coupon = Coupon::find($this->coupon_id);
        // dd($coupon);
        $coupon->coupon_code = $this->code;
        $coupon->type = $this->type;
        $coupon->value = $this->coupon_value;
        $coupon->cart_value = $this->cart_value;
        $coupon->visible_user = $this->visible;
        $coupon->save();
        session()->flash('Coupon', 'Coupon updated successfully!');
    }

    public function render()
    {
        return view('livewire.admin.edit-coupon-component')->layout('layouts.base');
    }
}
