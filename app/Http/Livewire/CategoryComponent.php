<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Livewire\Component;
use Livewire\WithPagination;

class CategoryComponent extends Component
{
    use WithPagination;
    public $sorting;
    public $pagesize;
    public $category_slug;

    public function store($product_id, $product_name, $product_price){
        Cart::instance('addtocart')->add($product_id, $product_name, 1, $product_price)->associate("App\Models\Product");
        session()->flash('success_message', 'Product Added to cart');
        // return redirect()->back();
        $this->emitTo('add-to-cart', 'refreshComponent');
    }

    function mount($category_slug){
        $this->sorting = 'default';
        $this->pagesize = 9;
        $this->category_slug = $category_slug;
    }

    public function render()
    {
        $category = Category::where('slug', $this->category_slug)->first();
        $category_id = $category->id;
        $category_name = $category->name;

        if($this->sorting == "newest"){

            $products = Product::where('category_id', $category_id)->orderBy('created_at', 'DESC')->paginate($this->pagesize);

        }
        elseif($this->sorting == 'price'){

            $products = Product::where('category_id', $category_id)->orderBy('regular_price', 'ASC')->paginate($this->pagesize);

        }
        elseif($this->sorting == 'priceDesc'){

            $products = Product::where('category_id', $category_id)->orderBy('regular_price', 'DESC')->paginate($this->pagesize);

        }


        // elseif($this->sorting == 'rating'){
        //     $products = Product::orderBy('regular_price', 'ASC')->paginate($this->pagesize);
        //     return view('livewire.shop-component', ['products'=>$products])->layout('layouts.base');
        // }
        else{
            $products = Product::where('category_id', $category_id)->paginate($this->pagesize);
        }
        return view('livewire.category-component', ['products'=>$products, 'category_id'=>$category_id, 'category_name'=> $category_name])->layout('layouts.base');

    }
}
