<div>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <!-- <h1>sliders(Admin)</h1> -->
                <!-- add new slider  -->
                <a href="{{ route('admin.AddSlider') }}" class="btn btn-success mb-2">Add Slider</a>
                <!-- add new slider end -->
                @if(session()->has('sliderDeleted'))
                <div class="alert alert-success col-md-12 text-center" role="alert" id="alert1"></div>
                <script>
                    setTimeout(function() {
                        let div = document.getElementById('alert1');
                        div.innerText = "{{session()->get('sliderDeleted')}}";
                        location.reload();
                    }, 10);

                    setTimeout(function() {
                        let div = document.getElementById('alert1');
                        div.style.display = "none";
                    }, 2500);
                </script>
                @endif
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="col-md-12 bg-warning">All Sliders</h3>
                    </div>
                    <div class="panel-body">
                        <table class="table table-stripped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Image</th>
                                    <th>Title</th>
                                    <th>Sub Title</th>
                                    <th>Price</th>
                                    <th>Link</th>
                                    <th>Status</th>
                                    <th>Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                               @forelse ($sliders as $slider)
                                   <tr>
                                    <td class="col-md-1">{{ $slider->id }}</td>
                                    <td class="col-md-1"><img src="{{ asset('storage/products/sliders/'.$slider->image) }}" alt="" style="width: 50px; height: 50px; border-radius:50%;"></td>
                                    <td class="col-md-2">{{ $slider->title }}</td>
                                    <td class="col-md-2">{{ $slider->subtitle }}</td>
                                    <td class="col-md-1">${{ $slider->price }}</td>
                                    <td class="col-md-1">{{ $slider->link }}</td>
                                    <td class="col-md-1">{{ $slider->status == 1 ? 'Active' : 'inActive' }}</td>
                                    <td class="col-md-1">{{ $slider->created_at }}</td>
                                    <td class="col-md-2">
                                        <a href="{{ route('admin.edithomeslider', $slider->id) }}" class="btn btn-info">Edit</a>
                                        <a href="" class="btn btn-danger" wire:click.prevent="deleteSlider({{$slider->id}})">Delete</a>
                                    </td>
                                   </tr>
                               @empty
                                   <tr>
                                    <td colspan="9" class="text-center">No sliders here.....!</td>
                                   </tr>
                               @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            {{ $sliders->links('layouts.pagination') }}
        </div>
    </div>
</div>