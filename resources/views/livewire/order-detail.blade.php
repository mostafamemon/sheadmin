<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark page-title">Order</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                        <li class="breadcrumb-item active">Order</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table-width-expense table table-striped table-bordered table-hover">
                        <thead>
                        <tr>
                            <th class="text-center">Order No</th>
                            <th class="text-center">Order Date</th>
                            <th>Customer Info</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Price</th>
                            <th class="text-center">Delivery</th>
                            <th class="text-center">Total</th>
                        </tr>
                        </thead>

                        <tbody>
                                <tr>
                                    <td class="text-center">{{ str_pad($order->id, 8, '0', STR_PAD_LEFT) }}</td>
                                    <td class="text-center">{{ date('d M, Y',strtotime($order->order_date_time)) }}</td>
                                    <td>
                                        <div>{{ $order->name }}</div>
                                        <div style="padding-top:5px">{{ $order->phone }}</div>
                                        <div style="padding-top:5px">
                                        @if($order->location == "outside_dhaka")
                                            <span class="badge" style="background-color:red;color:white">Outside Dhaka</span>
                                        @else
                                            <span class="badge" style="background-color:green;color:white">Inside Dhaka</span>
                                        @endif
                                        </div>
                                        <div style="padding-top:5px">{{ $order->address}}</div>
                                    </td>
                                    <td class="text-center">
                                        @if($order->status == "PENDING")
                                            <span class="badge" style="background-color:yellow;color:black">PENDING</span>
                                        @elseif($order->status == "PAID")
                                            <span class="badge" style="background-color:#D1F2EB;color:black">PAID</span>
                                        @elseif($order->status == "PROCESSING")
                                            <span class="badge" style="background-color:#5DADE2;color:white">PROCESSING</span>
                                        @elseif($order->status == "SHIPPED")
                                            <span class="badge" style="background-color:#D2B4DE;color:black">SHIPPED</span>
                                        @elseif($order->status == "DELIVERED")
                                            <span class="badge" style="background-color:green;color:white">DELIVERED</span>
                                        @elseif($order->status == "CANCELLED")
                                            <span class="badge" style="background-color:black;color:white">CANCELLED</span>
                                        @endif
                                    </td>
                                    <td class="text-center">{{ $order->total }}</td>
                                    <td class="text-center">{{ $order->delivery_charge }}</td>
                                    <td class="text-center">{{ $order->grand_total }}</td>
                                </tr>
                        </tbody>

                    </table>
                </div>

                <div class="table-responsive">
                    <table class="table-width-expense table table-striped table-bordered table-hover">
                        <thead>
                        <tr class="bg-lightblue">
                            <th class="text-center">#</th>
                            <th>Product</th>
                            <th class="text-center">Unit Price</th>
                            <th class="text-center">Quantity</th>
                            <th class="text-center">Total</th>
                        </tr>
                        </thead>

                        <tbody>
                            @foreach($order_details as $detail)
                            <tr>
                              <td class="text-center">{{ $loop->iteration }}</td>   
                              <td>{{ get_product_name($detail->product_id) }}</td>  
                              <td class="text-center">{{ $detail->unit_price }}</td>  
                              <td class="text-center">{{ $detail->quantity }}</td>  
                              <td class="text-center">{{ $detail->grand_total }}</td>  
                            </tr>
                            @endforeach
                        </tbody>

                    </table>
                </div>
            </div>
        </div>
    </section>
</div>