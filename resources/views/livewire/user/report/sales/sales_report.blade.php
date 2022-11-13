<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark page-title">Sales Report</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                        <li class="breadcrumb-item active">Sales Report</li>
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
                            <a href="{{url('export/report-sales?from_date='.$from_date.'&to_date='.$to_date.'&customer_phone='.$customer_phone)}}" target="_blank" class="btn btn-secondary btn-sm wd-90"><i class="fa fa-file-excel"></i> &nbsp;Export</a>&nbsp;
                            @endif
                            @if(in_array(config('app.roles')['report_print'], json_decode(auth()->user()->roles)))
                            <a href="{{url('print/report-sales?from_date='.$from_date.'&to_date='.$to_date.'&customer_phone='.$customer_phone)}}" target="_blank" class="btn btn-info btn-sm wd-90"><i class="fa fa-print"></i> &nbsp;Print</a>&nbsp;
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

                    @error('error')
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
                                    <span class="input-group-text wd-70">From</span>
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
                                    <span class="input-group-text wd-70">To</span>
                                </div>
                                <input type="text" class="form-control" id="datepicker2" wire:model="to_date" onchange="setToDate(this.value)" autocomplete="off">
                            </div>
                            @error('to_date')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-3 pt-10-mini">
                            <div class="input-group">
                                <div class="input-group-prepend wd-70">
                                    <span class="input-group-text">Phone</span>
                                </div>
                                <input type="text" class="form-control" wire:model.lazy="customer_phone" autocomplete="off">
                            </div>
                            @error('customer_phone')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-1 pt-10-mini">
                            <button class="btn btn-info wd-100"><i class="fa fa-search"></i> Search</button>
                        </div>

                        <div class="col-md-1 offset-1 pt-10-mini text-right">
                            <button class="btn btn-danger" wire:click="filterReset">Reset</button>
                        </div>

                    </div>

                    <div class="table-responsive">
                        <table class="table-width-expense table table-striped table-bordered table-hover">
                            <thead>
                            <tr class="bg-lightblue">
                                <th class="th-4p th-40px text-center" style="padding:12px !important;">#</th>
                                <th class="th-10p th-100px">Date</th>
                                <th class="th-10p th-100px text-center">Invoice No</th>
                                <th class="th-15p th-100px">Customer Name</th>
                                <th class="th-10p th-80px text-center">Phone</th>
                                <th class="th-32p th-80px">Address</th>
                                <th class="th-10p th-200px text-center">Sale</th>
                                <th class="th-10p th-200px text-center">Return</th>
                            </tr>
                            </thead>

                            <tbody>
                            @php $grand_total = 0; $grand_total_return = 0; @endphp
                            @foreach($sales as $sale)
                                @php
                                    $grand_total = $grand_total + $sale->payable_amount;
                                    $grand_total_return = $grand_total_return + $sale->return_amount;
                                @endphp
                                <tr>
                                    <td class="text-center" style="padding:12px !important;">{{$loop->iteration}}</td>
                                    <td>{{date('d M Y',strtotime($sale->date_only))}}</td>
                                    <td class="text-center">{{$sale->invoice_no}}</td>
                                    <td>{{$sale->customer->name}}</td>
                                    <td class="text-center">{{$sale->customer->phone}}</td>
                                    <td>{{$sale->customer->address}}</td>
                                    <td class="text-right">
                                        @if($settings->allow_decimal_number == true)
                                            {{ number_format($sale->payable_amount, 2, '.', '') }}
                                        @else
                                            {{ $sale->payable_amount }}
                                        @endif
                                    </td>
                                    <td class="text-right">
                                        @if($settings->allow_decimal_number == true)
                                            {{ number_format($sale->return_amount, 2, '.', '') }}
                                        @else
                                            {{ $sale->return_amount }}
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                            <tr>
                                <td colspan="6" class="text-bold text-right">Grand Total</td>
                                <td class="text-bold text-right">
                                    @if($settings->allow_decimal_number == true)
                                        {{ number_format($grand_total, 2, '.', '') }}
                                    @else
                                        {{ $grand_total }}
                                    @endif
                                </td>
                                <td class="text-bold text-right">
                                    @if($settings->allow_decimal_number == true)
                                        {{ number_format($grand_total_return, 2, '.', '') }}
                                    @else
                                        {{ $grand_total_return }}
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
