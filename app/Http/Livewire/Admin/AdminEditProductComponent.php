<?php

namespace App\Http\Livewire\Admin;

use App\Models\Category;
use App\Models\Product;
use Livewire\WithFileUploads;
use Livewire\Component;
use Illuminate\Support\Str;
use Exception;
use Illuminate\Support\Carbon;
use Intervention\Image\Facades\Image;

class AdminEditProductComponent extends Component
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
    public $newImage;
    public $product_id;



    function mount($product_slug){
        $product = Product::where('slug', $product_slug)->first();
        // dd($product_slug);
        // dd($product);

        $this->name = $product->name;
        $this->slug = $product->slug;
        $this->short_description = $product->short_description;
        $this->description = $product->description;
        $this->price = $product->regular_price;
        $this->discount = $product->discount;
        $this->SKU = $product->SKU;
        $this->stock_status = $product->stock_status;
        $this->featurd = $product->featurd;
        $this->quantity = $product->quantity;
        $this->image = $product->image;
        $this->category_id = $product->category_id;
        $this->product_id = $product->id;
    }
    function generateSlug(){
        $this->slug = Str::slug($this->name);
        if($this->slug == ""){
        throw new Exception("All fields must be filled");
        }
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
            'category_id' => 'required',
        ]);
    }

    function updateProduct(){
        $this->validate([
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
            'category_id' => 'required',
        ]);

        $product = Product::find($this->product_id);
        $product->name = $this->name;
        $product->slug = $this->slug;
        $product->short_description = $this->short_description;
        $product->description = $this->description;
        $product->regular_price = $this->price;


        $discount_value               =  $this->price * $this->discount / 100;
        $product->discount            =  $this->discount;
        $product->sale_price          =  $this->price - $discount_value;
        // dd($product->sale_price);
        $product->SKU = $this->SKU;
        $product->stock_status = $this->stock_status;
        $product->featurd = $this->featurd;
        $product->quantity = $this->quantity;
        if($this->newImage){
            unlink('storage/products/'.$this->image);
            $photo = $this->newImage;
            $image_name = now()->timestamp .".".$photo->extension();
            $img = Image::make($photo);
            $img->resize(500, 500);
            $img->save('storage/products/'.$image_name);
            $product->image               =  $image_name;
        }
        $product->category_id = $this->category_id;
        // dd($this->image);

        $product->save();
        session()->flash('productUpdated', 'Product Updated successfully!');
    }
    public function render()
    {
        $categories = Category::all();
        return view('livewire.admin.admin-edit-product-component', ['categories'=>$categories])->layout('layouts.base');
    }
}
