<?php

namespace App\Http\Livewire\Admin;

use App\Models\Coupon;
use Livewire\Component;
use Livewire\WithPagination;

class AllCouponsComponent extends Component
{
    use WithPagination;
    public function deleteCoupon($coupon_id){
        $coupon = Coupon::find($coupon_id);
        if(!empty($coupon)){
            $coupon->delete();
            session()->flash('couponDeleted', 'Coupon Deleted Successfully...!');
        }
    }
    public function render()
    {
        $coupons = Coupon::paginate(5);
        return view('livewire.admin.all-coupons-component', ['coupons'=>$coupons])->layout('layouts.base');
    }
}
