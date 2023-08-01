<?php

namespace App\Http\Livewire\Admin;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Carbon;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use Intervention\Image\Facades\Image;

class AdminAddProductComponent extends Component
{
    use WithFileUploads;
    public $name;
    public $slug;
    public $short_description;
    public $description;
    public $price;
    public $discount;
    public $SKU;
    public $stock_status;
    public $featurd;
    public $quantity;
    public $image;
    public $category_id;

    function mount()
    {
        $this->stock_status = 'inStock';
        $this->featurd = 0;
    }

    function generateSlug()
    {
        $this->slug = Str::slug($this->name);
    }
    function update($fields)
    {
        $this->validateOnly($fields, [
            'name' => 'required',
            'slug' => 'required',
            'short_description' => 'required',
            'description' => 'required',
            'price' => 'required',
            'discount' => 'required | numeric',
            'SKU' => 'required',
            'stock_status' => 'required',
            'featurd' => 'required',
            'quantity' => 'required | numeric',
            'image' => 'required',
            'category_id' => 'required'
        ]);
    }
    function storeProduct()
    {
        // dd("hello");
        $this->validate([
            'name' => 'required',
            'slug' => 'required',
            'short_description' => 'required',
            'description' => 'required',
            'price' => 'required | numeric',
            'discount' => 'required | numeric',
            'SKU' => 'required',
            'stock_status' => 'required',
            'featurd' => 'required',
            'quantity' => 'required | numeric',
            'image' => 'required',
            'category_id' => 'required'
        ]);
        $product = new Product();
        // dd($this->image);
        $product->name                =  $this->name;
        $product->slug                =  $this->slug;
        $product->short_description   =  $this->short_description;
        $product->description         =  $this->description;
        $product->regular_price       =  $this->price;
        $discount_value               =  $this->price * $this->discount / 100;
        $product->discount            =  $this->discount;
        $product->sale_price          =  $this->price - $discount_value;
        // dd($product->regular_price, $product->discount, $discount_value, $product->sale_price);
        $product->SKU                 =  $this->SKU;
        $product->stock_status        =  $this->stock_status;
        $product->featurd             =  $this->featurd;
        $product->quantity            =  $this->quantity;
        $photo = $this->image;
        $image_name = now()->timestamp .".".$photo->extension();
        $img = Image::make($photo);
        $img->resize(500, 500);
        $img->save('storage/products/'.$image_name);
        $product->image               =  $image_name;
        $product->category_id         =  $this->category_id;

        $product->save();
        session()->flash('productAdded', 'Product added to collections successfully!');
    }

    public function render()
    {
        $categories = Category::all();
        return view('livewire.admin.admin-add-product-component', ['categories' => $categories])->layout('layouts.base');
    }
}
