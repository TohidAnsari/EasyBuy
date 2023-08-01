<div class="container">
    @if($orders->count() > 0)
    <div class="row">
        @if (session()->has('Order_message'))
            <div class="alert alert-success">
                {{ session()->get('Order_message') }}
            </div>
        @endif
        {{-- <div class="col-md-12"> --}}
            <h3 class="col-md-12 bg-primary">My Orders</h3>
            <table class="table table-stripped">
                <thead>
                    <tr>
                        <th>    #           </th>
                        <th>    User Id    </th>
                        <th>    SubTotal    </th>
                        <th>    Discount    </th>
                        <th>    Tax         </th>
                        <th>    Total       </th>
                        <th>    First Name  </th>
                        <th>    Last Name   </th>
                        <th>    Mobile      </th>
                        <th>    Email       </th>
                        <th>    Zip Code    </th>
                        <th>    Status      </th>
                        <th>    Order Date  </th>
                        <th>    Actions     </th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($orders as $key => $order)
                    <tr>
                        <td>    {{ ++$key }}            </td>
                        <td>    {{ $order->user_id}}   </td>
                        <td>    {{ $order->subtotal}}   </td>
                        <td>    ${{ $order->discount}}  </td>
                        <td>    ${{ $order->tax}}       </td>
                        <td>    {{ $order->total}}      </td>
                        <td>    {{ $order->first_name}} </td>
                        <td>    {{ $order->last_name}}  </td>
                        <td>    {{ $order->mobile}}     </td>
                        <td>    {{ $order->email}}      </td>
                        <td>    {{ $order->zip_code}}   </td>
                        <td>    {{ $order->status}}     </td>
                        <td>    {{ $order->created_at}} </td>
                        <td>
                            <div class="d-flex">
                            <a href="{{ route('user.orderDetails', ['order_id' => $order->id]) }}" class="btn btn-sm btn-success" title="View Order"><i class="fa fa-eye" aria-hidden="true"></i></a>
                            @if ($order->status == 'ordered')
                            <a href="#" class="btn btn-sm btn-danger ml-1" title="Cancel Order" wire:click.prevent="UpdateOrderStatus({{ $order->id }}, 'canceled')"><i class="fa fa-trash" aria-hidden="true"></i></a>
                            @endif
                        </div>
                        </td>
                </tr>
                @empty
                No orders here
                @endforelse
            </tbody>
        </table>
        {{ $orders->links('layouts.pagination')}}
    </div>
</div>
@else
<div class="container">
    <div class="row">
        <div class="text-center">
            <h3>
                You Haven't Ordered Anything..!
            </h3>
            <h4>Buy Somthing <a href="{{ route('product.shop') }}" class="btn btn-primary">Shop Now</a>
            </h4>
        </div>
    </div>
</div>
@endif
</div >
