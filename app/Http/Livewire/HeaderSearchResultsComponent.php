<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class HeaderSearchResultsComponent extends Component
{
    use WithPagination;
    public $sorting;
    public $pagesize;
    public $search;
    public $productCategory;
    public $productCategory_id;
    public function store($product_id, $product_name, $product_price){
        Cart::instance('addtocart')->add($product_id, $product_name, 1, $product_price)->associate("App\Models\Product");
        session()->flash('success_message', 'Product Added to cart');
        return redirect("/shop");
    }

    function mount(){
        $this->sorting = 'default';
        $this->pagesize = 9;
        $this->fill(request()->only('search', 'productCategory_id', 'productCategory'));
    }

    public function render()
    {

        if($this->sorting == "newest"){
            $products = Product::where('name', 'LIKE', '%'.$this->search.'%')->orderBy('created_at', 'DESC')->paginate($this->pagesize);

        }
        elseif($this->sorting == 'price'){

            $products = Product::where('name', 'LIKE', '%'.$this->search. '%')->orderBy('regular_price', 'ASC')->paginate($this->pagesize);

        }
        elseif($this->sorting == 'priceDesc'){

            $products = Product::where('name', 'LIKE', '%'.$this->search. '%')->orderBy('regular_price', 'DESC')->paginate($this->pagesize);

        }
        else{
            $products = Product::where('name', 'LIKE', '%'.$this->search. '%')->paginate($this->pagesize);
        }
        return view('livewire.header-search-results-component', ['products'=>$products, 'search'=>$this->search])->layout('layouts.base');

    }
}
