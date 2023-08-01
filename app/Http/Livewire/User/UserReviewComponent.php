<?php

namespace App\Http\Livewire\User;

use Livewire\Component;
use App\Models\OrderItem;
use App\Models\Reviews;


class UserReviewComponent extends Component
{
    public $order_item_id;
    public $rating;
    public $message;
    public $name;
    public $email;


    public function mount($order_item_id){
        $this->order_item_id = $order_item_id;
    }

    function update($fields)
    {
        $this->validateOnly($fields, [
            'rating'    => 'required',
            'message'   => 'required',
            'name'      => 'required',
            'email'     => 'required'
        ]);
    }

    public function addReview(){
        // dd($this->rating);
        $this->validate([
            'rating'    => 'required',
            'message'   => 'required',
            'name'      => 'required',
            'email'     => 'required'
        ]);
        $review = new Reviews();
        $review->rating = $this->rating;
        $review->comment = $this->message;
        $review->order_item_id = $this->order_item_id;
        $review->name = $this->name;
        $review->email = $this->email;
        // dd($review);
        $review->save();
        $order_item = OrderItem::find($this->order_item_id);
        $order_item->rs_status = true;
        $order_item->save();
        session()->flash('review', 'Thanks For Your Review');

    }

    public function render()
    {
        $product = OrderItem::find($this->order_item_id);
        return view('livewire.user.user-review-component', ['product' => $product])->layout('layouts.base');
    }
}
