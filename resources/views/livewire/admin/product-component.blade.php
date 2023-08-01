<div class="container">
    <div class="row">
        <div class="col-md-12">
            <a href="{{ route('admin.addproducts') }}" class="btn btn-success mb-2">Add Product</a>
            <h3 class="col-md-12 bg-primary">All Products</h3>
            @if(session()->has('productDeleted'))
            <div class="alert alert-success col-md-12 text-center" role="alert" id="alert1"></div>
            <script>
                setTimeout(function() {
                    let div = document.getElementById('alert1');
                div.innerText = "{{ session()-> get('productDeleted')}}";
                }, 10);

                setTimeout(function() {
                    let div = document.getElementById('alert1');
                div.style.display = "none";
                }, 2500);
            </script>
            @endif
            <table class="table table-stripped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Stock</th>
                        <th>Price</th>
                        <th>Sale</th>
                        <th>Category</th>
                        <th>Date</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($products as $product)
                    <tr>
                        <td class="col-md-1">{{ $product-> id}}</td>
                        <td> <img src="{{asset('storage/products/'.$product->image) }}" alt="" style="height: 50px; width:50px; border-radius:50%;"></td>
                        <td class="col-md-3">{{ $product-> name}}</td>
                        <td class="col-md-1">{{ $product-> stock_status}}</td>
                        <td class="col-md-1">${{ $product-> regular_price}}</td>
                        <td class="col-md-1">${{ $product-> sale_price}}</td>
                        <td class="col-md-1">{{ $product-> category -> name}}</td>
                        <td class="col-md-2">{{ $product-> created_at}}</td>
                        <td class="col-md-3">
                            <a href="{{ route('admin.editproducts',  ['product_slug'=>$product->slug]) }}" class="btn btn-info">Edit</a>
                            <a href="" class="btn btn-danger" onclick="confirm('Do you wanna delete this product?') || event.stopImmediatePropagation(); event.preventDefault();" wire:click.prevent="deleteProduct({{ $product-> id}})" >Delete</a>
                    </td>
                </tr>
                @empty
                No Products here
                @endforelse
            </tbody>
        </table>
        {{ $products-> links('layouts.pagination')}}
    </div>
</div>
</div >