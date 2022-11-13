@extends('layouts.master')

@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark page-title">Invoice Report</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                        <li class="breadcrumb-item active">Invoice Report</li>
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
                    <form method="POST">
                    @csrf

                        @if(count($sales) > 0)
                        @if(in_array(config('app.roles')['report_print'], json_decode(auth()->user()->roles)))

                        <div class="text-left pd-b-10">
                            <button class="btn btn-info"><i class="fa fa-print" onclick="printInvoice()"></i> Print</button>
                        </div>

                        @endif
                        @endif

                        @if(session()->has("error"))
                            <div class="mg-b-10 flash alert alert-danger alert-dismissible fade show" role="alert">
                                {{ session('error') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif

                        @if(session()->has("more_than_month"))
                            <div class="mg-b-10 flash alert alert-warning alert-dismissible fade show" role="alert">
                                {{ session('more_than_month') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif

                        <div class="row filter-div">
                            <div class="col-md-3">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text wd-70">From</span>
                                    </div>
                                    <input type="text" class="form-control" @if(count($sales) == 0) id="datepicker1" @endif name="from_date" value="{{$from_date}}" autocomplete="off" @if(count($sales) > 0) readonly @endif>
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
                                    <input type="text" class="form-control" @if(count($sales) == 0) id="datepicker2" @endif name="to_date" value="{{$to_date}}" autocomplete="off" @if(count($sales) > 0) readonly @endif>
                                </div>
                                @error('to_date')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-3 pt-10-mini">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text wd-100">Invoice No</span>
                                    </div>
                                    <input type="text" class="form-control" name="invoice_no" value="{{$invoice_no}}" autocomplete="off" @if(count($sales) > 0) readonly @endif>
                                </div>
                                @error('invoice_no')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-1 pt-10-mini">
                                @if(count($sales) == 0)
                                <button class="btn btn-info wd-100"><i class="fa fa-search"></i> Search</button>
                                @endif
                            </div>

                            <div class="col-md-1 offset-1 pt-10-mini text-right">
                                @if(count($sales) > 0)
                                <div onclick="refreshPage()" class="btn btn-danger">Reset</div>
                                @endif
                            </div>
                        </div>

                        <div class="table-responsive">
                        <table class="table-width-expense table table-striped table-bordered table-hover">
                            <thead>
                            <tr class="bg-lightblue">
                                <th class="th-10p th-40px text-center" style="padding:12px !important;">
                                    <a onclick="select_all()" class="btn btn-dark btn-xs">Select All</a>
                                </th>
                                <th class="th-15p th-100px text-center">Date</th>
                                <th class="th-15p th-100px text-center">Invoice No</th>
                                <th class="th-15p th-100px text-left">Customer Name</th>
                                <th class="th-15p th-100px text-center">Total</th>
                                <th class="th-15p th-100px text-center">Discount</th>
                                <th class="th-15p th-100px text-center">Payable</th>
                            </tr>
                            </thead>
                                <tbody>
                                @foreach($sales as $sale)
                                    <tr>
                                        <td class="text-center">
                                            <div class="icheck-success d-inline">
                                                <input type="checkbox" name="sales_ids[]" value="{{$sale->id}}" id="checkboxSuccess{{$sale->id}}" class="sales_id_checkbox">
                                                <label for="checkboxSuccess{{$sale->id}}"></label>
                                            </div>
                                        </td>
                                        <td class="text-center">{{date('d-m-Y',strtotime($sale->date_only))}}</td>
                                        <td class="text-center">{{$sale->invoice_no}}</td>
                                        <td class="text-left">{{$sale->customer->name}}</td>
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
                                                {{ number_format($sale->payable, 2, '.', '') }}
                                            @else
                                                {{ $sale->payable }}
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                        </table>
                    </div>
                    </form>
                </div>
            </div>

        </div>
    </section>
</div>
@endsection

<script>
    function select_all() {
        $('.sales_id_checkbox').attr("checked","checked");
    }

    function refreshPage() {
        window.location.href="/report-sales-invoice";
    }

    function printInvoice() {
        $( "#target" ).submit();
    }
</script>
