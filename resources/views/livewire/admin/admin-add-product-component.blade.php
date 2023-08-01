<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card col-md-8 offset-2">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-8">
                            <h4>Add Product</h4>
                        </div>
                        <div class="col-md-4">
                            <a href="{{ route('admin.products') }}" class="btn btn-primary">All products</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    @if (session()->has('productAdded'))
                        <div class="alert alert-success col-md-12 text-center" role="alert" id="alert1"></div>
                        <script>
                            setTimeout(function() {
                                let div = document.getElementById('alert1');
                                div.innerText = "{{ session()->get('productAdded') }}";
                            }, 10);

                            setTimeout(function() {
                                let div = document.getElementById('alert1');
                                div.style.display = "none";
                            }, 2500);
                        </script>
                    @endif
                    <form action="" class="form-horizontal" enctype="multipart/form-data"
                        wire:submit.prevent="storeProduct">
                        <div class="form-group">
                            <label for="name">product Name</label>
                            <input id="name" class="form-control" type="text" name="cat_name"
                                placeholder="Product name.." wire:model="name" wire:keyup="generateSlug">
                            @error('name')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="slug">slug</label>
                            <input id="slug" class="form-control" type="text" name="cat_slug"
                                placeholder="Slug name.." wire:model="slug" disabled>
                            @error('slug')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group" wire:ignore>
                            <label for="short_description">short description</label>
                            <textarea id="short_description" class="form-control" type="text" name="short_description"
                                placeholder="short description" wire:model="short_description"></textarea>
                            @error('short_description')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group" wire:ignore>
                            <label for="description">description</label>
                            <textarea id="description" class="form-control" type="text" name="description" placeholder="description"
                                wire:model="description"></textarea>
                            @error('description')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="price">regular price</label>
                            <input id="price" class="form-control" type="text" name="price"
                                placeholder="regular price" wire:model="price">
                            @error('price')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="discount">Discount</label>
                            <input id="discount" class="form-control" type="text" name="discount"
                                placeholder="discount" wire:model="discount">
                            @error('discount')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="SKU">SKU</label>
                            <input id="SKU" class="form-control" type="text" name="cat_slug" placeholder="SKU"
                                wire:model="SKU">
                            @error('SKU')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="stock_status">stock status</label>
                            <select name="stock_status" id="stock_status" class="form-control"
                                wire:model="stock_status">
                                <option value="inStock">inStock</option>
                                <option value="outOfStock">out of stock</option>
                            </select>
                            @error('stock_status')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="featurd">featurd</label>
                            <select name="featurd" id="featurd" class="form-control" wire:model="featurd">
                                <option value="0">No</option>
                                <option value="1">Yes</option>
                            </select>
                            @error('featurd')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="quantity">quantity</label>
                            <input id="quantity" class="form-control" type="number" name="quantity"
                                placeholder="quantity" wire:model="quantity">
                            @error('quantity')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="image">image</label>
                            <input id="image" class="form-control" type="file" name="image"
                                placeholder="image" wire:model="image">
                            @error('image')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                            @if ($image)
                                Photo Preview:
                                <img src="{{ $image->temporaryUrl() }}" width="100px">
                            @endif
                            <div wire:loading wire:target="image">Uploading...</div>

                        </div>



                        <div class="form-group">
                            <label for="category">category</label>
                            <select name="category" id="category" class="form-control" wire:model="category_id">
                                <option value="0">select category</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="form-group">
                            <button class="btn btn-success">Add</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@push('scripts')
    <script>
        $(function() {
            tinymce.init({
                selector: '#short_description',
                plugins: 'a11ychecker advcode casechange export formatpainter image editimage linkchecker autolink lists checklist media mediaembed pageembed permanentpen powerpaste table advtable tableofcontents tinycomments tinymcespellchecker',
                toolbar: 'a11ycheck addcomment showcomments casechange checklist code export formatpainter image editimage pageembed permanentpen table tableofcontents',
                toolbar_mode: 'floating',
                tinycomments_mode: 'embedded',
                tinycomments_author: 'Author name',
                setup: function(editor) {
                    editor.on('init change', function() {
                        editor.save();
                    });
                    editor.on('change', function(e) {
                        @this.set('short_description', editor.getContent());
                    });
                },
            });
            tinymce.init({
                selector: '#description',
                plugins: 'a11ychecker advcode casechange export formatpainter image editimage linkchecker autolink lists checklist media mediaembed pageembed permanentpen powerpaste table advtable tableofcontents tinycomments tinymcespellchecker',
                toolbar: 'a11ycheck addcomment showcomments casechange checklist code export formatpainter image editimage pageembed permanentpen table tableofcontents',
                toolbar_mode: 'floating',
                tinycomments_mode: 'embedded',
                tinycomments_author: 'Author name',
                setup: function(editor) {
                    editor.on('init change', function() {
                        editor.save();
                    });
                    editor.on('change', function(e) {
                        @this.set('description', editor.getContent());
                        console.log(editor.getContent);
                    });
                },
            });

        });
    </script>
@endpush
