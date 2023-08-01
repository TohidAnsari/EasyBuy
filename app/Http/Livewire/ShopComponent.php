<?php

namespace App\Http\Livewire;

use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Livewire\Component;
use Livewire\WithPagination;

class ShopComponent extends Component
{
    use WithPagination;

    public $sorting;
    public $pagesize;
    public $price_all;
    public $price_100;
    public $price_200;
    public $price_500;
    public $price_1000;
    public $price_1000A;

    public function store($product_id, $product_name, $product_price){
        Cart::instance('addtocart')->add($product_id, $product_name, 1, $product_price)->associate("App\Models\Product");
        session()->flash('success_message', 'Product Added to cart');
        // return redirect("/shop");
        $this->emitTo('add-to-cart', 'refreshComponent');
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

    function mount(){
        $this->sorting = 'default';
        $this->pagesize = 9;

    }

    public function render()
    {
        if($this->sorting == "newest"){
            $products = Product::orderBy('created_at', 'DESC')->paginate($this->pagesize);
        }
        elseif($this->sorting == 'price'){
            $products = Product::orderBy('regular_price', 'ASC')->paginate($this->pagesize);
        }
        elseif($this->sorting == 'priceDesc'){
            $products = Product::orderBy('regular_price', 'DESC')->paginate($this->pagesize);
        }


        elseif($this->price_100){
            $products = Product::whereBetween('regular_price', [0 , $this->price_100])->paginate($this->pagesize);
        }
        elseif($this->price_200){
            $products = Product::whereBetween('regular_price', [100, $this->price_200])->paginate($this->pagesize);
        }
        elseif($this->price_500){
            $products = Product::whereBetween('regular_price', [200, $this->price_500])->paginate($this->pagesize);
        }
        elseif($this->price_1000){
            $products = Product::whereBetween('regular_price', [500, $this->price_1000])->paginate($this->pagesize);
        }
        elseif($this->price_1000A){
            // dd($this->price_1000A);
            $products = Product::where('regular_price', '>=', $this->price_1000A)->paginate($this->pagesize);
        }
        else{
            $products = Product::paginate($this->pagesize);
        }
        return view('livewire.shop-component', ['products'=>$products])->layout('layouts.base');

    }
}
