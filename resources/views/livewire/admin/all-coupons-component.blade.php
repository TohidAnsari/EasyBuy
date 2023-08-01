<div>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <!-- <h1>Categories(Admin)</h1> -->
                <!-- add new category  -->
                <a href="{{ route('admin.addcoupons') }}" class="btn btn-success mb-2">Add Coupon</a>
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
                        <h3 class="col-md-12 bg-warning">All Coupons</h3>
                    </div>
                    <div class="panel-body">
                        <table class="table table-stripped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Coupon</th>
                                    <th>Coupon type</th>
                                    <th>Coupon value</th>
                                    <th>Cart value</th>
                                    <th>Visibility</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                @forelse($coupons as $key=>$coupon)
                                    <tr>
                                        <td> {{ ++$key }} </td>
                                        <td> {{ $coupon->coupon_code }} </td>
                                        <td> {{ $coupon->type == 'fixed'? $coupon->type : $coupon->type.' %'  }} </td>
                                        <td> {{ $coupon->value }} </td>
                                        <td> ${{ $coupon->cart_value }} </td>
                                        <td> {{ $coupon->visible_user == '0' ? 'Secrete' : 'Not Secrete'}} </td>
                                        <td>
                                            <a href="{{ route('admin.editcoupon', ['coupon_id'=>$coupon->id]) }}" class="btn btn-info">Edit</a>
                                        <a href="" class="btn btn-danger" onclick="confirm('Do you wanna delete this Coupon?') || event.stopImmediatePropagation(); event.preventDefault();" wire:click.prevent="deleteCoupon({{ $coupon->id }})">Delete</a>
                                        </td>
                                    </tr>
                                @empty
                                <td colspan="6" class="text-center">

                                    <h3>No Coupons...!</h3>
                                </td>

                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            {{ $coupons->links('layouts.pagination') }}
        </div>
    </div>
</div>
