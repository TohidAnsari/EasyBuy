<?php

namespace App\Http\Livewire\Admin;

use App\Models\Category;
use Livewire\Component;
use Livewire\WithPagination;

class CategorisComponent extends Component
{
    use WithPagination;
    function deleteCategory($id){
        $category = Category::find($id);
        if(!empty($category)){
            $category->delete();
            session()->flash('ctegoryDeleted', 'Category '.$category->name.' deleted successfully');
            
        }

    }
    public function render()
    {
        $categories = Category::paginate(5);
        return view('livewire.admin.categoris-component', ['categories'=>$categories])->layout('layouts.base');
    }
}
