<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark page-title">Supplier Transaction</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                        <li class="breadcrumb-item active">Supplier Transaction</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div wire:loading.delay class="loading">Loading&#8230;</div>
        <div class="container-fluid">
            <div class="card">
                <div class="card-body">
                    @if(in_array(config('app.roles')['report_export'], json_decode(auth()->user()->roles)) || in_array(config('app.roles')['report_print'], json_decode(auth()->user()->roles)))
                    <div class="mg-b-7">
                        <div class="text-right">
                            @if(in_array(config('app.roles')['report_export'], json_decode(auth()->user()->roles)))
                            <a href="{{url('export/report-supplier-transaction?from_date='.$from_date.'&to_date='.$to_date)}}" target="_blank" class="btn btn-secondary btn-sm wd-90"><i class="fa fa-file-excel"></i> &nbsp;Export</a>&nbsp;
                            @endif
                            @if(in_array(config('app.roles')['report_print'], json_decode(auth()->user()->roles)))
                            <a href="{{url('print/report-supplier-transaction?from_date='.$from_date.'&to_date='.$to_date)}}" target="_blank" class="btn btn-info btn-sm wd-90"><i class="fa fa-print"></i> &nbsp;Print</a>&nbsp;
                            @endif
                        </div>
                    </div>
                    @endif
                    @error('more_than_month')
                    <div class="flash alert alert-warning alert-dismissible fade show" role="alert">
                        {{ $message }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    @enderror

                    <div class="row filter-div">
                        <div class="col-md-3">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">From</span>
                                </div>
                                <input type="text" class="form-control" id="datepicker1" wire:model="from_date" onchange="setFromDate(this.value)" autocomplete="off">
                            </div>
                            @error('from_date')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-3 pt-10-mini">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">To</span>
                                </div>
                                <input type="text" class="form-control" id="datepicker2" wire:model="to_date" onchange="setToDate(this.value)" autocomplete="off">
                            </div>
                            @error('to_date')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-1 pt-10-mini">
                            <button class="btn btn-info wd-100" wire:click="generate_report"><i class="fa fa-search"></i> Search</button>
                        </div>

                        <div class="col-md-1 offset-4 pt-10-mini text-right">
                            <button class="btn btn-danger" wire:click="filterReset">Reset</button>
                        </div>

                    </div>

                    <div class="table-responsive">
                        <table class="table-width-expense table table-striped table-bordered table-hover">
                            <thead>
                            <tr class="bg-lightblue">
                                <th class="th-4p th-40px text-center" style="padding:12px !important;">#</th>
                                <th class="th-20p th-100px">Supplier Name</th>
                                <th class="th-13p th-80px text-center">Phone</th>
                                <th class="th-40p th-80px">Address</th>
                                <th class="th-11p th-200px text-center">Total Purchase</th>
                                <th class="th-11p th-200px text-center">Purchase Amount</th>
                            </tr>
                            </thead>

                            <tbody>
                            @php $grand_total_purchase = 0; $grand_total_amount = 0; @endphp
                            @foreach($purchases as $purchase)
                                @php
                                    $grand_total_purchase = $grand_total_purchase + $purchase->total_purchase;
                                    $grand_total_amount = $grand_total_amount + $purchase->purchase_amount;
                                @endphp
                                <tr>
                                    <td class="text-center" style="padding:12px !important;">{{$loop->iteration}}</td>
                                    <td>{{$purchase->name}}</td>
                                    <td class="text-center">{{$purchase->phone}}</td>
                                    <td>{{$purchase->address}}</td>
                                    <td class="text-center">{{$purchase->total_purchase}}</td>
                                    <td class="text-right">
                                        @if($settings->allow_decimal_number == true)
                                            {{ number_format($purchase->purchase_amount, 2, '.', '') }}
                                        @else
                                            {{ $purchase->purchase_amount }}
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                            <tr>
                                <td colspan="4" class="text-bold text-right">Grand Total</td>
                                <td class="text-bold text-center">{{$grand_total_purchase}}</td>
                                <td class="text-bold text-right">
                                    @if($settings->allow_decimal_number == true)
                                        {{ number_format($grand_total_amount, 2, '.', '') }}
                                    @else
                                        {{ $grand_total_amount }}
                                    @endif
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="pd-t-10">
                    </div>
                </div>
            </div>

            <script>
                function setFromDate(value){
                    @this.set('from_date', value);
                }

                function setToDate(value){
                    @this.set('to_date', value);
                }
            </script>

        </div>
    </section>
</div>
