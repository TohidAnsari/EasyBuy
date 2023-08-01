<div>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-head bg-primary p-1 pb-0">
                        <h4>Order Status</h4>
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <tr>
                                <th>Order Id</th>
                                <td>{{ $order->id }}</td>

                                <th>Order Date</th>
                                <td>{{ $order->created_at }}</td>

                                <th>Order Status</th>
                                <td>{{ $order->status }}</td>

                                @if ($order->status == 'delivered')
                                <th>Deleivery Date</th>
                                <td>{{ $order->delivered_date }}</td>

                                @elseif ($order->status == 'canceled')
                                <th>Cancelation Date</th>
                                <td>{{ $order->canceled_date }}</td>
                                @endif
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-head bg-primary p-1 pb-0">
                        <h4>Order Details</h4>
                    </div>

                    <div class="card-body">
                        <table class="table">
                        @foreach ($order->orderItems as $item)
                        <tr>
                            <td>
                                <img src="{{ asset('storage/products/' . $item->product->image) }}" alt=""
                                    style="width: 50px" /> <br> {{ $item->product->name }}
                            </td>
                            <td>
                                price : <b>${{ $item->product->sale_price }}</b>
                            </td>

                            <td>
                                <div>Total Price : <b>${{ $item->price * $item->quantity }}</b></div>
                            </td>
                        </tr>
                        @endforeach
                    </table>
                        <div class="">
                            <h5>Order Summary</h5>
                            <p class="summary-info">Discount : <b>${{ $order->discount }}</b></p>
                            <p class="summary-info">Subtotal : <b>${{ $order->subtotal }}</b></p>
                            <p class="summary-info">Tax : <b>${{ $order->tax }}</b></p>
                            <p class="summary-info">Shipping : <b>Free Shipping</b></p>
                            <p class="summary-info">Total : <b>${{ $order->total }}</b></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-head bg-primary p-1 pb-0">
                        <h4>Billing Details</h4>
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <th>First Name</th>
                                    <td>{{ $order->first_name }}</td>
                                    <th>Last Name</th>
                                    <td>{{ $order->last_name }}</td>
                                </tr>
                                <tr>
                                    <th>Phone</th>
                                    <td>{{ $order->mobile }}</td>
                                    <th>Email</th>
                                    <td>{{ $order->email }}</td>
                                </tr>
                                <tr>
                                    <th>Address 1</th>
                                    <td>{{ $order->line1 }}</td>
                                    <th>Address 2</th>
                                    <td>{{ $order->line2 }}</td>
                                </tr>
                                <tr>
                                    <th>Country</th>
                                    <td>{{ $order->country}}</td>
                                    <th>City</th>
                                    <td>{{ $order->city }}</td>
                                </tr>
                                <tr>
                                    <th>State</th>
                                    <td>{{ $order->province }}</td>
                                    <th>Zip Code</th>
                                    <td>{{ $order->zip_code }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        {{-- @dd($order->shipping, $order->is_shipping_different) --}}
        @if ($order->is_shipping_different)
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-head bg-primary p-1 pb-0">
                        <h4>Shipping Details</h4>
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <th>First Name</th>
                                    <td>{{ $order->shipping->first_name }}</td>
                                    <th>Last Name</th>
                                    <td>{{ $order->shipping->last_name }}</td>
                                </tr>
                                <tr>
                                    <th>Phone</th>
                                    <td>{{ $order->shipping->mobile }}</td>
                                    <th>Email</th>
                                    <td>{{ $order->shipping->email }}</td>
                                </tr>
                                <tr>
                                    <th>Address 1</th>
                                    <td>{{ $order->shipping->line1 }}</td>
                                    <th>Address 2</th>
                                    <td>{{ $order->shipping->line2 }}</td>
                                </tr>
                                <tr>
                                    <th>Country</th>
                                    <td>{{ $order->shipping->country}}</td>
                                    <th>City</th>
                                    <td>{{ $order->shipping->city }}</td>
                                </tr>
                                <tr>
                                    <th>State</th>
                                    <td>{{ $order->shipping->province }}</td>
                                    <th>Zip Code</th>
                                    <td>{{ $order->shipping->zip_code }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        @endif
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-head bg-primary p-1 pb-0">
                        <h4>Transaction Details</h4>
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <th>Transaction Mode</th>
                                    <td>{{ $order->transaction->mode }}</td>
                                </tr>
                                <tr>
                                    <th>Status</th>
                                    <td>{{ $order->transaction->status }}</td>
                                </tr>
                                <tr>
                                    <th>Transaction Date</th>
                                    <td>{{ $order->transaction->created_at }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
