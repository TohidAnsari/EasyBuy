<div>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                @if (session()->has('homeCategoryUpdated'))
                    <div class="alert alert-success col-md-12 text-center" role="alert" id="alert1"></div>
                    <script>
                        setTimeout(function() {
                            let div = document.getElementById('alert1');
                            div.innerText = "{{ session()->get('homeCategoryUpdated') }}";
                        }, 10);

                        setTimeout(function() {
                            let div = document.getElementById('alert1');
                            div.style.display = "none";
                        }, 2500);
                    </script>
                @endif
                <div class="card">
                    <div class="card-header">
                        <h3>
                            Manage home categories
                        </h3>
                    </div>
                    <div class="card-body">
                        <form action="" wire:submit.prevent="updateHomepageCategories">
                            <div class="form-group" id="select_category">
                                <label for="category_name">Choose Categories</label>
                                <select name="categories[]" id="category_name" class="form-control sale_categories"
                                    multiple="multiple" wire:model="number_of_categories">
                                    @forelse ($categories as $category)
                                        <option value="{{ $category->id }}"> {{ $category->name }} </option>
                                    @empty
                                        <h3>No Categoties Found....!</h3>
                                    @endforelse
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="count">No of Categories</label>
                                <input type="text" name="no_of_cat" id="count" class="form-control"
                                    wire:model="number_of_products">
                            </div>
                            <div class="form-group">
                                <button class="btn btn-success" type="submit">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@push('scripts')
    <script>
        $('#category_name').select2();
        category_name = document.getElementById('category_name');
        category_name =
        // console.log(data);
    </script>
@endpush
