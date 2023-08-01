<div>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <!-- <h1>Categories(Admin)</h1> -->
                <!-- add new category  -->
                <a href="{{ route('admin.addcategory') }}" class="btn btn-success mb-2">Add Category</a>
                <!-- add new category end -->
                @if(session()->has('ctegoryDeleted'))
                <div class="alert alert-success col-md-12 text-center" role="alert" id="alert1"></div>
                <script>
                    setTimeout(function() {
                        let div = document.getElementById('alert1');
                        div.innerText = "{{session()->get('ctegoryDeleted')}}";
                    }, 10);

                    setTimeout(function() {
                        let div = document.getElementById('alert1');
                        div.style.display = "none";
                    }, 2500);
                </script>
                @endif
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="col-md-12 bg-warning">All Categories</h3>
                    </div>
                    <div class="panel-body">
                        <table class="table table-stripped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Slug</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach($categories as $category)
                                <tr>
                                    <td class="col-md-1">{{ $category->id }}</td>
                                    <td class="col-md-4"> <img src="{{ asset('storage/products/HomeCategory/'.$category->thumbnail) }}" alt="" style="width: 50px; height: 50px; border-radius: 50%;"> {{ $category->name }}</td>
                                    <td class="col-md-4">{{ $category->slug }}</td>
                                    <td class="col-md-3">
                                        <!-- <a href="" class="btn btn-success">View</a> -->
                                        <a href="{{ route('admin.editcategory', ['slug'=>$category->slug]) }}" class="btn btn-info">Edit</a>
                                        <a href="" class="btn btn-danger" onclick="confirm('Do you wanna delete this category?') || event.stopImmediatePropagation(); event.preventDefault();" wire:click.prevent="deleteCategory({{ $category->id }})">Delete</a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            {{ $categories->links('layouts.pagination') }}
        </div>
    </div>
</div>