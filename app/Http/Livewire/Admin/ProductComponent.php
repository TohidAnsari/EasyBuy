<?php

namespace App\Http\Livewire\Admin;

use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;

class ProductComponent extends Component
{
    use WithPagination;
    function deleteProduct($id)
    {
        $product = Product::find($id);
        if (!empty($product)) {
            $product_image = $product->image;
            // dd($product_image);
            unlink('storage/products/'.$product_image);
            $product->delete();
            session()->flash('productDeleted', 'Product ' . $product->name . ' deleted successfully');
        }
    }
    public function render()
    {
        $products = Product::paginate(10);
        return view('livewire.admin.product-component', ['products' => $products])->layout('layouts.base');
    }
}
