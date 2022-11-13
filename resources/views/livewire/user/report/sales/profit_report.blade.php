<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark page-title">Profit Report</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                        <li class="breadcrumb-item active">Profit Report</li>
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
                            <a href="{{url('export/report-sales-profit?from_date='.$from_date.'&to_date='.$to_date)}}" target="_blank" class="btn btn-secondary btn-sm wd-90"><i class="fa fa-file-excel"></i> &nbsp;Export</a>&nbsp;
                            @endif
                            @if(in_array(config('app.roles')['report_print'], json_decode(auth()->user()->roles)))
                            <a href="{{url('print/report-sales-profit?from_date='.$from_date.'&to_date='.$to_date)}}" target="_blank" class="btn btn-info btn-sm wd-90"><i class="fa fa-print"></i> &nbsp;Print</a>&nbsp;
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
                                <th class="th-3p th-40px text-center" style="padding:12px !important;">#</th>
                                <th class="th-10p th-100px text-center">Date</th>
                                <th class="th-10p th-100px text-center">Invoice No</th>
                                <th class="th-10p th-100px text-center">Sale</th>
                                <th class="th-9p th-80px text-center">VAT</th>
                                <th class="th-9p th-100px text-center">Others</th>
                                <th class="th-10p th-100px text-center">Total</th>
                                <th class="th-9p th-100px text-center">Discount</th>
                                <th class="th-10p th-100px text-center">Profit</th>
                                <th class="th-9p th-100px text-center">Return</th>
                                <th class="th-11p th-100px text-center">Return Profit</th>
                            </tr>
                            </thead>

                            <tbody>
                            @php
                                $grand_sale         = 0;
                                $grand_vat          = 0;
                                $grand_others       = 0;
                                $grand_total        = 0;
                                $grand_discount     = 0;
                                $grand_profit       = 0;
                                $grand_return       = 0;
                                $grand_return_profit= 0;
                            @endphp

                            @foreach($sales as $sale)
                                @php
                                    $grand_sale         = $grand_sale + $sale->total_amount;
                                    $grand_vat          = $grand_vat + $sale->vat;
                                    $grand_others       = $grand_others + $sale->other_charge_amount;
                                    $grand_total        = $grand_total + $sale->grand_total;
                                    $grand_discount     = $grand_discount + $sale->discount;
                                    $grand_profit       = $grand_profit + $sale->profit;
                                    $grand_return       = $grand_return + $sale->return_amount;
                                    $grand_return_profit= $grand_return_profit + $sale->return_profit;
                                @endphp
                                <tr>
                                    <td class="text-center" style="padding:12px !important;">{{$loop->iteration}}</td>
                                    <td class="text-center">{{date('d-m-Y',strtotime($sale->date_only))}}</td>
                                    <td class="text-center">{{$sale->invoice_no}}</td>
                                    <td class="text-right">
                                        @if($settings->allow_decimal_number == true)
                                            {{ number_format($sale->total_amount, 2, '.', '') }}
                                        @else
                                            {{ $sale->total_amount }}
                                        @endif
                                    </td>
                                    <td class="text-right">
                                        @if($settings->allow_decimal_number == true)
                                            {{ number_format($sale->vat, 2, '.', '') }}
                                        @else
                                            {{ $sale->vat }}
                                        @endif
                                    </td>
                                    <td class="text-right">
                                        @if($settings->allow_decimal_number == true)
                                            {{ number_format($sale->other_charge_amount, 2, '.', '') }}
                                        @else
                                            {{ $sale->other_charge_amount }}
                                        @endif
                                    </td>
                                    <td class="text-right">
                                        @if($settings->allow_decimal_number == true)
                                            {{ number_format($sale->grand_total, 2, '.', '') }}
                                        @else
                                            {{ $sale->grand_total }}
                                        @endif
                                    </td>
                                    <td class="text-right">
                                        @if($settings->allow_decimal_number == true)
                                            {{ number_format($sale->discount, 2, '.', '') }}
                                        @else
                                            {{ $sale->discount }}
                                        @endif
                                    </td>
                                    <td class="text-right">
                                        @if($settings->allow_decimal_number == true)
                                            {{ number_format($sale->profit, 2, '.', '') }}
                                        @else
                                            {{ $sale->profit }}
                                        @endif
                                    </td>
                                    <td class="text-right">
                                        @if($settings->allow_decimal_number == true)
                                            {{ number_format($sale->return_amount, 2, '.', '') }}
                                        @else
                                            {{ $sale->return_amount }}
                                        @endif
                                    </td>
                                    <td class="text-right">
                                        @if($settings->allow_decimal_number == true)
                                            {{ number_format($sale->return_profit, 2, '.', '') }}
                                        @else
                                            {{ $sale->return_profit }}
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                            <tr>
                                <td colspan="3" class="text-bold text-right">Grand Total</td>
                                <td class="text-bold text-right">
                                    @if($settings->allow_decimal_number == true)
                                        {{ number_format($grand_sale, 2, '.', '') }}
                                    @else
                                        {{ $grand_sale }}
                                    @endif
                                </td>
                                <td class="text-bold text-right">
                                    @if($settings->allow_decimal_number == true)
                                        {{ number_format($grand_vat, 2, '.', '') }}
                                    @else
                                        {{ $grand_vat }}
                                    @endif
                                </td>
                                <td class="text-bold text-right">
                                    @if($settings->allow_decimal_number == true)
                                        {{ number_format($grand_others, 2, '.', '') }}
                                    @else
                                        {{ $grand_others }}
                                    @endif
                                </td>
                                <td class="text-bold text-right">
                                    @if($settings->allow_decimal_number == true)
                                        {{ number_format($grand_total, 2, '.', '') }}
                                    @else
                                        {{ $grand_total }}
                                    @endif
                                </td>
                                <td class="text-bold text-right">
                                    @if($settings->allow_decimal_number == true)
                                        {{ number_format($grand_discount, 2, '.', '') }}
                                    @else
                                        {{ $grand_discount }}
                                    @endif
                                </td>
                                <td class="text-bold text-right">
                                    @if($settings->allow_decimal_number == true)
                                        {{ number_format($grand_profit, 2, '.', '') }}
                                    @else
                                        {{ $grand_profit }}
                                    @endif
                                </td>
                                <td class="text-bold text-right">
                                    @if($settings->allow_decimal_number == true)
                                        {{ number_format($grand_return, 2, '.', '') }}
                                    @else
                                        {{ $grand_return }}
                                    @endif
                                </td>
                                <td class="text-bold text-right">
                                    @if($settings->allow_decimal_number == true)
                                        {{ number_format($grand_return_profit, 2, '.', '') }}
                                    @else
                                        {{ $grand_return_profit }}
                                    @endif
                                </td>
                            </tr>
                            </tbody>
                        </table>

                        <table class="table-width-expense table table-striped table-bordered table-hover">
                            <tbody>
                                @php $grand_expense = getExpense($from_date,$to_date); @endphp
                                <tr>
                                    <td>Total Profit: <b>{{$grand_profit}}</b></td>
                                    <td>Total Return Profit: <b>{{$grand_return_profit}}</b></td>
                                    <td>Total Expense: <b>{{$grand_expense }}</b></td>
                                    <td>Net Profit: <b>{{$grand_profit - $grand_return_profit - $grand_expense }}</b></td>
                                </tr>
                            </tbody>
                        </table>
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
