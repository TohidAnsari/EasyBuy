<?php

namespace App\Http\Livewire\Admin;

use App\Models\Category;
use App\Models\HomeCategory;
use Livewire\Component;
use Livewire\WithFileUploads;

class AdminHomeCategoryComponent extends Component
{
    use WithFileUploads;
    public $number_of_categories = [];
    public $number_of_products;
    public $image;
    function mount(){
        $category = HomeCategory::find(1);
        $this->number_of_categories = explode(',', $category->sale_categories);
        $this->number_of_products = "$category->no_of_products";
        // dd($number_of_products);
    }
    
    function updateHomepageCategories(){
        $category = HomeCategory::find(1);
        $category->sale_categories = implode(',', $this->number_of_categories);
        $category->no_of_products = $this->number_of_products;
        $category->save();
        session()->flash('homeCategoryUpdated', 'Home Page Categories Updated successfully...!');
    }

    public function render()
    {
        $categories = Category::all();
        return view('livewire.admin.admin-home-category-component', ['categories' => $categories])->layout('layouts.base');
    }
}
