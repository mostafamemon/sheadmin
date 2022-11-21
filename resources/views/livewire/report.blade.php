<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark page-title">Report</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                        <li class="breadcrumb-item active">Report</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
        <div class="card">
            <div class="card-body">
            <form wire:submit.prevent="filter">
                <div class="row filter-div">
                    <div class="col-md-2">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Phone</span>
                            </div>
                            <input type="text" class="form-control" wire:model.lazy="filter_phone" autocomplete="off">
                        </div>
                    </div>

                    <div class="col-md-2 pt-10-mini">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Order No</span>
                            </div>
                            <input type="text" class="form-control" wire:model.lazy="filter_order_no" autocomplete="off">
                        </div>
                    </div>

                    <div class="col-md-2 pt-10-mini">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Date</span>
                            </div>
                            <input type="date" class="form-control" wire:model.lazy="filter_date" autocomplete="off">
                        </div>
                    </div>

                    <div class="col-md-2 pt-10-mini">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Status</span>
                            </div>
                            <select class="form-control" wire:model="filter_status">
                                <option value="PENDING">Pending</option>
                                <option value="PAID">Paid</option>
                                <option value="PROCESSING">Processing</option>
                                <option value="SHIPPED">Shipped</option>
                                <option value="DELIVERED">Delivered</option>
                                <option value="CANCELLED">Cancelled</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-1">
                        <input type="submit" class="btn btn-danger wd-100" value="Filter"/>
                    </div>
                </div>
            </form>

                <div class="table-responsive">
                    <table class="table-width-expense table table-striped table-bordered table-hover">
                        <thead>
                        <tr class="bg-lightblue">
                            <th class="text-center" style="padding:12px !important;">#</th>
                            <th class="text-center">Order No</th>
                            <th class="text-center">Order Date</th>
                            <th>Customer Info</th>
                            <th class="text-center">Status</th>
                            <th>Price</th>
                            <th>Delivery</th>
                            <th>Total</th>
                        </tr>
                        </thead>

                        <tbody>
                            @foreach($orders as $order)
                                <tr>
                                    <td class="text-center">{{ $loop->iteration }}</td>
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
                            @endforeach
                        </tbody>

                    </table>
                </div>

                <div class="pd-t-10">
                </div>
            </div>
        </div>
    </section>
</div>