<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card card-default col-lg-6 offset-lg-3 col-md-6 offset-md-3 col-sm-6 offset-sm-3">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-8 col-lg-8 col-sm-8">
                            <h4>Update Category</h4>
                        </div>
                        <div class="col-md-4 col-lg-4 col-sm-4"><a href="{{ route('admin.categories') }}"
                                class="btn btn-primary">All Categories</a></div>
                    </div>
                    <div class="card-body">
                        @if (session()->has('categoryUpdated'))
                            <div class="alert alert-success col-md-12 text-center" role="alert" id="alert1"></div>
                            <script>
                                setTimeout(function() {
                                    let div = document.getElementById('alert1');
                                    div.innerText = "{{ session()->get('categoryUpdated') }}";
                                }, 10);

                                setTimeout(function() {
                                    let div = document.getElementById('alert1');
                                    div.style.display = "none";
                                }, 2500);
                            </script>
                        @endif
                        <form action="" class="form-horizontal" wire:submit.prevent="updateCategory">
                            <div class="form-group">
                                <label for="name">Category Name</label>
                                <input id="name" class="form-control" type="text" name="cat_name"
                                    placeholder="Category name.." wire:model="name" wire:keyup="generateSlug" required
                                    value="">
                                @error('name')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="slug">slug</label>
                                <input id="slug" class="form-control" type="text" name="cat_slug"
                                    placeholder="Slug name.." wire:model="slug" required disabled>
                                @error('slug')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="image">image</label>
                                <input id="image" class="form-control" type="file" name="image"
                                    placeholder="image" wire:model="newImage">
                                @if ($newImage)
                                    product Preview:
                                    <img src="{{ $newImage->temporaryUrl() }}" width="100px">
                                @else
                                    <img src="{{ asset('storage/products/HomeCategory/' . $image) }}" alt=""
                                        width="100px">
                                @endif
                                <div wire:loading wire:target="image">Uploading...</div>
                            </div>
                            <div class="form-group">
                                <button class="btn btn-success">Update</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
