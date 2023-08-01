<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\Product;
use Livewire\Component;

class HeaderSearchComponent extends Component
{
    public $search;
    public $productCategory;
    public $productCategory_id;

    function mount(){
        $this->productCategory = 'All Category';
        $this->fill(request()->only('search', 'productCategory', 'productCategory_id'));

    }

    public function autocomplete(){
        $datas = Product::select('name')->where('name', 'LIKE', '%'.$this->search.'%')->get();
            return response()->json($datas);
    }

    public function render()
    {
        $categories = Category::all();
        return view('livewire.header-search-component', ['categories' => $categories]);
    }
}
