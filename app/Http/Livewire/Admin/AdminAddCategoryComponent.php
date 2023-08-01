<?php

namespace App\Http\Livewire\Admin;

use App\Models\Category;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use Intervention\Image\Facades\Image;
class AdminAddCategoryComponent extends Component
{
    use WithFileUploads;
    public $name;
    public $slug;
    public $image;
    function generateSlug(){
        $this->slug = Str::slug($this->name);
    }
    function update($fields)
    {
        $this->validateOnly($fields, [
            'name' => 'required',
            'slug' => 'required',
            'image' => 'required'
        ]);
    }
    function storeCategory(){
        $this->validate([
            'name' => 'required',
            'slug' => 'required',
            'image' => 'required'
        ]);
        $category = new Category();
        $category->name = $this->name;
        $category->slug = $this->slug;
        $photo = $this->image;
        $image_name = now()->timestamp .".".$photo->extension();

        $img = Image::make($photo);
        $img->resize(500, 500);
        $img->save('storage/products/HomeCategory/'.$image_name);
        $category->thumbnail               =  $image_name;
        $category->save();
        session()->flash('categoryAdded', 'Category Created successfully!');
    }
    public function render()
    {
        return view('livewire.admin.admin-add-category-component')->layout('layouts.base');
    }
}
