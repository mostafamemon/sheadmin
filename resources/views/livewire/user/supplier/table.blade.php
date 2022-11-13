<div class="card">
    <div class="card-body">
        @if(in_array(config('app.roles')['supplier_export'], json_decode(auth()->user()->roles)) || in_array(config('app.roles')['supplier_add'], json_decode(auth()->user()->roles)))
        <div class="mg-b-7">
            <div class="text-right">
                @if(in_array(config('app.roles')['supplier_export'], json_decode(auth()->user()->roles)))
                <a href="{{url('export/supplier')}}" target="_blank" class="btn btn-info btn-sm wd-90"><i class="fa fa-file-excel"></i> &nbsp;Export</a>&nbsp;
                @endif
                @if(in_array(config('app.roles')['supplier_add'], json_decode(auth()->user()->roles)))
                <a href="/supplier/add" class="btn btn-primary btn-sm wd-90"><i class="fa fa-plus-circle"></i> Add New</a>
                @endif
            </div>
        </div>
        @endif

        @if(session()->has("message"))
            <div class="flash alert alert-success-custom alert-dismissible fade show" role="alert">
                <strong>Well done!</strong> {{ session('message') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        <div class="table-responsive">
            <table class="table-width-customer table table-striped table-bordered table-hover">
                <thead>
                <tr class="bg-lightblue">
                    <th class="th-4p th-40px text-center" style="padding:12px !important;">#</th>
                    <th class="th-15p th-250px">Name</th>
                    <th class="th-10p th-130px text-center">Phone</th>
                    <th class="th-13p th-130px text-center">Email</th>
                    <th class="th-20p th-300px">Address</th>
                    <th class="text-center th-10p th-100px">Transaction</th>
                    <th class="text-center th-10p th-100px">Dues</th>
                    <th class="text-center th-10p th-100px">Advance</th>
                    <th class="th-10p th-80px text-center">Action</th>
                </tr>
                </thead>

                <tbody>
                @foreach($suppliers as $supplier)
                    @php
                        $last_transaction     = explode("_",get_supplier_last_transaction($supplier->id));
                        $total_transaction    = $last_transaction[0];
                        $current_dues         = $last_transaction[1];
                        $current_advance      = $last_transaction[2];
                    @endphp
                    <tr>
                        <td class="text-center">{{ $loop->iteration + $suppliers->firstItem() - 1 }}</td>
                        <td>{{ $supplier->name }}</td>
                        <td class="text-center">{{ $supplier->phone }}</td>
                        <td>{{ $supplier->email }}</td>
                        <td>{{ $supplier->address }}</td>
                        <td class="text-center">
                            @if($total_transaction != "" && $total_transaction != null)
                                @if($settings->allow_decimal_number == true)
                                    {{ number_format($total_transaction, 2, '.', '') }}
                                @else
                                    {{ $total_transaction }}
                                @endif
                            @else
                                @if($settings->allow_decimal_number == true)
                                    0.00
                                @else
                                    0
                                @endif
                            @endif
                        </td>
                        <td class="text-center">
                            @if($current_dues != "" && $current_dues != null)
                                @if($settings->allow_decimal_number == true)
                                    {{ number_format($current_dues, 2, '.', '') }}
                                @else
                                    {{ $current_dues }}
                                @endif
                            @else
                                @if($settings->allow_decimal_number == true)
                                    0.00
                                @else
                                    0
                                @endif
                            @endif
                        </td>
                        <td class="text-center">
                            @if($current_advance != "" && $current_advance != null)
                                @if($settings->allow_decimal_number == true)
                                    {{ number_format($current_advance, 2, '.', '') }}
                                @else
                                    {{ $current_advance }}
                                @endif
                            @else
                                @if($settings->allow_decimal_number == true)
                                    0.00
                                @else
                                    0
                                @endif
                            @endif
                        </td>
                        <td class="text-center">
                            @if(in_array(config('app.roles')['supplier_update'], json_decode(auth()->user()->roles)) || in_array(config('app.roles')['supplier_delete'], json_decode(auth()->user()->roles)))
                            <button class="btn btn-warning btn-xs dropdown-toggle force-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Action
                            </button>

                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                @if(in_array(config('app.roles')['supplier_update'], json_decode(auth()->user()->roles)))
                                <a class="dropdown-item pointer tx-14" href="/supplier/update/{{$suppliers->currentPage()}}/{{$supplier->id}}">Update</a>
                                <div class="dropdown-divider"></div>
                                @endif
                                @if(in_array(config('app.roles')['supplier_delete'], json_decode(auth()->user()->roles)))
                                <a class="dropdown-item pointer tx-14" wire:click="delete('{{$supplier->id}}','{{$suppliers->currentPage()}}')">Delete</a>
                                @endif
                            </div>
                            @else
                                <i class="fa fa-ban" aria-hidden="true"></i>
                            @endif
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

        <div class="pd-t-10">
            {{ $suppliers->links() }}
        </div>
    </div>
</div>
