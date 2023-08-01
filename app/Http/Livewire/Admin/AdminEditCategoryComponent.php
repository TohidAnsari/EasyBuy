<?php

namespace App\Http\Livewire\Admin;

use App\Models\Category;
use Exception;
use Livewire\Component;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use Livewire\WithFileUploads;
use Illuminate\Support\Carbon;

class AdminEditCategoryComponent extends Component
{
    use WithFileUploads;
    public $category_id;
    public $category_slug;
    public $name;
    public $slug;
    public $image;
    public $newImage;
    function mount($slug)
    {
        $this->category_slug = $slug;
        $category = Category::where('slug', $slug)->first();
        $this->category_id = $category->id;
        $this->name = $category->name;
        $this->image = $category->thumbnail;
    }
    function generateSlug()
    {
        $this->slug = Str::slug($this->name);
        if ($this->slug == "") {
            throw new Exception("All fields must be filled");
        }
    }
    function update($fields)
    {
        $this->validateOnly($fields, [
            'name' => 'required | unique:name',
            'slug' => 'required',
        ]);
    }
    function updateCategory()
    {
        // $this->validate([
        //     'name' => 'required | unique:name',
        //     'slug' => 'required',
        // ]);
        $category = Category::find($this->category_id);
        $category->name = $this->name;
        $category->slug = $this->slug;
        if ($this->newImage) {
            unlink('storage/products/HomeCategory/' . $this->image);
            $photo = $this->newImage;
            $image_name = now()->timestamp .".".$photo->extension();
            $img = Image::make($photo);
            $img->resize(500, 500);
            $img->save('storage/products/HomeCategory/'.$image_name);
            $category->thumbnail               =  $image_name;
        }
        $category->save();
        session()->flash('categoryUpdated', 'Category Updated successfully!');
        try {
        } catch (Exception $th) {
            $th->getMessage();
        }
    }

    public function render()
    {
        return view('livewire.admin.admin-edit-category-component')->layout('layouts.base');
    }
}
