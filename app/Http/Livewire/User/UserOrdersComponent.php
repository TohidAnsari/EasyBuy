<?php

namespace App\Http\Livewire\User;

use Livewire\Component;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Livewire\WithPagination;
use App\Models\Transaction;
use Illuminate\Support\Facades\DB;

class UserOrdersComponent extends Component
{
    use WithPagination;

    function UpdateOrderStatus($order_id, $status){
        $order = Order::find($order_id);
        $order->status = $status;

        if($order->status == 'canceled'){
            $order->canceled_date = DB::raw('CURRENT_DATE');

            $transaction = Transaction::where('order_id', $order_id)->first();
            $transaction->status = 'declined';
            $transaction->canceled_date = DB::raw('CURRENT_DATE');
            $transaction->save();
        }
        $order->save();
        session()->flash('Order_message', 'Order has been canceled Successfully.!');
    }

    public function render()
    {
        $orders = Order::where('user_id', Auth::user()->id)->orderBy('created_at', 'DESC')->paginate(10);
        return view('livewire.user.user-orders-component', ['orders' => $orders])->layout('layouts.base');
    }
}
