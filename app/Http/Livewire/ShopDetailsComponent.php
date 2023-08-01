<?php

namespace App\Http\Livewire;

use App\Models\Product;
use Livewire\Component;
use Gloudemans\Shoppingcart\Facades\Cart;
class ShopDetailsComponent extends Component
{
    public $slug;
    public function mount($slug){
        $this->slug = $slug;
    }

    public function store($product_id, $product_name, $product_price){
        Cart::instance('addtocart')->add($product_id, $product_name, 1, $product_price)->associate("App\Models\Product");
        session()->flash('success_message', 'Product Added to cart');
        return redirect()->route('product.cart');
    }

    public function addToWishlist($product_id, $product_name, $product_price){
        Cart::instance('addtowishlist')->add($product_id, $product_name, 1, $product_price)->associate("App\Models\Product");
        // Cart::instance('addtowishlist')->destroy();
        session()->flash('addToWishlist', 'Product Added to wishlist');
        // return redirect("/shop");
        $this->emitTo('add-to-wishlist', 'refreshComponent');
    }

    public function removeFromWishlist($id){
        foreach(Cart::instance('addtowishlist')->content() as $item){
            if($item->id == $id){
                Cart::instance('addtowishlist')->remove($item->rowId);
                $this->emitTo('add-to-wishlist', 'refreshComponent');
                session()->flash('movedToCart', 'Product Moved to Cart');
                return;
            }
            // dd($item->id);
        }
    }

    public function render()
    {
        $product = Product::where('slug', $this->slug)->first();
        $related_products = Product::where('category_id', $product->category_id)->inRandomOrder()->limit(8)->get();

        return view('livewire.shop-details-component', ['product' => $product, 'related_product' => $related_products])->layout('layouts.base');
    }
}
