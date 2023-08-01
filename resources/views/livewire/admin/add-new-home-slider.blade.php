<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card col-md-8 offset-2">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-8">
                            <h4>Add Slider</h4>
                        </div>
                        <div class="col-md-4">
                            <a href="{{ route('admin.homeslider') }}" class="btn btn-primary">All Sliders</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    @if (session()->has('sliderAdded'))
                        <div class="alert alert-success col-md-12 text-center" role="alert" id="alert1"></div>
                        <script>
                            setTimeout(function() {
                                let div = document.getElementById('alert1');
                                div.innerText = "{{ session()->get('sliderAdded') }}";
                            }, 10);

                            setTimeout(function() {
                                let div = document.getElementById('alert1');
                                div.style.display = "none";
                            }, 2500);
                        </script>
                    @endif
                    <form action="" class="form-horizontal" enctype="multipart/form-data"
                        wire:submit.prevent="addSlider">
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input id="title" class="form-control" type="text" name="title" placeholder="title"
                                wire:model="title">
                            @error('title')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="subtitle">Sub Title</label>
                            <input id="subtitle" class="form-control" type="text" name="subtitle"
                                placeholder="sub title" wire:model="subtitle">
                            @error('subtitle')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="price">Price</label>
                            <input id="price" class="form-control" type="text" name="price" placeholder="price"
                                wire:model="price">
                            @error('price')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="link">Link</label>
                            <input id="link" class="form-control" type="text" name="link" placeholder="link"
                                wire:model="link">
                            @error('link')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="form-group ">
                            <label class="" for="status">Status</label>
                            <select name="category" id="category" class="form-control" wire:model="status">
                                <option value="0">inActive</option>
                                <option value="1">Active</option>
                            </select>
                            @error('status')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="image">image</label>
                            <input id="image" class="form-control" type="file" name="image" placeholder="image"
                                wire:model="image">
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
                            <button class="btn btn-success">Add</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
