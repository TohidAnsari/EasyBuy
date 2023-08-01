<div class="container">
    <div class="row">
        {{-- <div class="col-md-12"> --}}
            @if (session()->has('Order_message'))
                <div class="alert alert-success">
                    {{ session()->get('Order_message') }}
                </div>
            @endif


                <select class=" col-md-12 bg-primary btn btn-lg btn-primary text-left" wire:model="orders_type">
                  <option value="allOrders" selected>All Orders</option>
                  <option value="orderdOrders">Orderd Orders</option>
                  <option value="deliverdOrders">Delivered Orders</option>
                  <option value="canceledOrders">Canceled Orders </option>
                </select>

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
                            <a href="{{ route('admin.orderDetails', ['order_id' => $order->id]) }}" class="btn btn-sm btn-success" title="View Order"><i class="fa fa-eye" aria-hidden="true"></i></a>
                            <div class="dropdown">
                                <a class="btn btn-primary btn-sm ml-1 dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                                  status
                                </a>

                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                  <li><a class="dropdown-item" href="#" wire:click.prevent="UpdateOrderStatus({{ $order->id }}, 'delivered')">delivered</a></li>
                                </ul>
                            </div>
                            </div>
                        </td>
                </tr>
                @empty
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="text-center">
                                <h1>No Orderes Now</h1>
                                </div>
                        </div>
                    </div>
                </div>
                @endforelse
            </tbody>
        </table>
        {{ $orders->links('layouts.pagination')}}
    </div>
</div>
</div >
