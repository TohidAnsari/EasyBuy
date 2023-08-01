<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Gloudemans\Shoppingcart\Facades\Cart;

class MyWishlistComponent extends Component
{
    public function store($product_id, $product_name, $product_price){
        Cart::instance('addtocart')->add($product_id, $product_name, 1, $product_price)->associate("App\Models\Product");
        foreach(Cart::instance('addtowishlist')->content() as $item){
            if($item->id == $product_id){
                Cart::instance('addtowishlist')->remove($item->rowId);
                $this->emitTo('add-to-cart', 'refreshComponent');
                $this->emitTo('add-to-wishlist', 'refreshComponent');
                session()->flash('movedToCart', 'Product Moved to Cart');
                return;
            }
        }
    }

    public function removeFromWishlist($id){
        foreach(Cart::instance('addtowishlist')->content() as $item){
            if($item->id == $id){
                Cart::instance('addtowishlist')->remove($item->rowId);
                $this->emitTo('add-to-wishlist', 'refreshComponent');
                return;
            }
            // dd($item->id);
        }
    }
    public function render()
    {
        return view('livewire.my-wishlist-component')->layout('layouts.base');
    }
}
