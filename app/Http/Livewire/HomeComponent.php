<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\HomeCategory;
use App\Models\HomePageSlider;
use App\Models\Product;
use App\View\Components\Products;
use Livewire\Component;
use Livewire\WithPagination;
use Gloudemans\Shoppingcart\Facades\Cart;
class HomeComponent extends Component
{
    use WithPagination;

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
        $slides = HomePageSlider::where('status', 1)->get();
        $latest_products = Product::orderBy('created_at', 'DESC')->paginate(8);
        $featurd_products = Product::where('featurd', 1)->paginate(8);

        $category = HomeCategory::find(1);
        $cats = explode(',', $category->sale_categories);
        $categories = Category::whereIn('id', $cats)->with('products')->get();
        $product_number = $category->no_of_products;

        return view('livewire.home-component', ['latest_products'=>$latest_products, 'featurd_products' => $featurd_products, 'slides' => $slides, 'categories' => $categories, 'product_number' => $product_number])->layout('layouts.base');
    }
}
