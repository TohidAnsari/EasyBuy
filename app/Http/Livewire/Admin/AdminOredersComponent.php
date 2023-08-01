<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Order;
use App\Models\Transaction;
use Illuminate\Support\Facades\DB;


class AdminOredersComponent extends Component
{
    use WithPagination;

    public $orders_type;

    function UpdateOrderStatus($order_id, $status){
        $order = Order::find($order_id);
        $order->status = $status;

        if($order->status == 'delivered'){
            $order->delivered_date = DB::raw('CURRENT_DATE');

            $transaction = Transaction::where('order_id', $order_id)->first();
            $transaction->status = 'approved';
            $transaction->delivered_date = DB::raw('CURRENT_DATE');
            $transaction->save();
        }
        $order->save();

        session()->flash('Order_message', 'Status Successfully Updated..!');
    }

    public function render()
    {
        if($this->orders_type == 'allOrders'){
            $orders = Order::orderBy('created_at', 'DESC')->paginate(10);
        }
        elseif($this->orders_type == 'orderdOrders'){
            $orders = Order::where('status', 'ordered')->orderBy('created_at', 'DESC')->paginate(10);
        }
        elseif($this->orders_type == 'deliverdOrders'){
            $orders = Order::where('status', 'delivered')->orderBy('created_at', 'DESC')->paginate(10);
        }
        elseif($this->orders_type == 'canceledOrders'){
           $orders = Order::where('status', 'canceled')->orderBy('created_at', 'DESC')->paginate(10);
        }
        else{
            $orders = Order::orderBy('created_at', 'DESC')->paginate(10);
        }
        return view('livewire.admin.admin-oreders-component', ['orders' => $orders])->layout('layouts.base');
    }
}
