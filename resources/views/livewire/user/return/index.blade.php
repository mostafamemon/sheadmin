<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark page-title">Return</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                        <li class="breadcrumb-item active">Return</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            @if(session()->has("message"))
                <div class="row">
                    <div class="col-md-12">
                        <div class="flash alert alert-success-custom alert-dismissible fade show" role="alert">
                            <strong>Well done!</strong> {{ session('message') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    </div>
                </div>
            @endif

            <div class="row">
                <div class="col-md-12">
                    <div class="card card-body">
                        @error('previous_return')
                        <div class="flash alert alert-danger alert-dismissible fade show m-0 mb-1" role="alert">
                            <strong>Caution!</strong> {{ $message }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        @endif

                        <div class="row">
                            <div class="col-md-3">
                                <label class="mg-b-0">Invoice No</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" wire:model.lazy="invoice_no" wire:keydown.enter="searchInvoice">
                                    <div class="input-group-append">
                                        <button wire:click="searchInvoice()" class="btn btn-info" type="button"><i class="fa fa-search"></i></button>
                                    </div>
                                </div>
                                @error('invoice_no')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <hr>

                        <div class="table-responsive">
                            <table class="table-width-customer table table-striped table-bordered table-hover">
                                <thead>
                                    <tr class="bg-lightblue">
                                        <th class=" text-center th-4p th-40px" style="padding:12px !important;">#</th>
                                        <th class="th-30p th-250px">Name</th>
                                        <th class=" text-center th-12p th-130px">Quantity</th>
                                        <th class=" text-center th-12p th-300px">Unit Price</th>
                                        <th class="text-center th-15p th-100px">Total</th>
                                        <th class="text-center th-12p th-100px">
                                            <div class="custom-control custom-checkbox">
                                                <input class="custom-control-input" type="checkbox" id="customCheckbox1" value="1" wire:model="return_all" wire:click="return_all">
                                                <label for="customCheckbox1" class="custom-control-label" style="padding-top:4px">Return All</label>
                                            </div>
                                        </th>
                                        <th class="text-center th-15p th-100px">Return Quantity</th>
                                    </tr>
                                </thead>

                                <tbody>
                                @php $sl = 0 @endphp
                                @foreach($saleDetails as $key => $saleDetail)
                                    @php $sl = $sl + 1; @endphp
                                    <tr>
                                        <td class="text-center" style="padding:12px !important;">{{$loop->iteration}}</td>
                                        <td>{{$saleDetail->product->product_name}}</td>
                                        <td class="text-right">{{$saleDetail->quantity}} {{$saleDetail->product->unit}}</td>
                                        <td class="text-right">
                                            @if($settings->allow_decimal_number == true)
                                                {{ number_format($saleDetail->unit_price, 2, '.', '') }}
                                            @else
                                                {{ $saleDetail->unit_price }}
                                            @endif
                                        </td>
                                        <td class="text-right">
                                            @if($settings->allow_decimal_number == true)
                                                {{ number_format($saleDetail->total, 2, '.', '') }}
                                            @else
                                                {{ $saleDetail->total }}
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            <div class="icheck-success d-inline">
                                                <input type="checkbox" id="checkboxSuccess{{$sl}}" @if($is_return[$saleDetail->id] == 1) checked @endif wire:model="is_return.{{$saleDetail->id}}">
                                                <label for="checkboxSuccess{{$sl}}"></label>
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <button class="btn @if($return_quantity[$saleDetail->id] < $saleDetail->quantity) btn-success @else btn-danger @endif btn-sm" wire:click="increase({{$saleDetail->id}},{{$saleDetail->quantity}},{{$return_quantity[$saleDetail->id]}})"><i class="fa fa-plus-circle"></i></button>
                                                </div>
                                                <input type="number" max="{{$saleDetail->quantity}}" min="0" class="form-control text-center bg-white" value="{{$return_quantity[$saleDetail->id]}}" readonly>
                                                <div class="input-group-append">
                                                    <button class="btn @if($return_quantity[$saleDetail->id] > 0) btn-success @else btn-danger @endif btn-sm" wire:click="decrease({{$saleDetail->id}},{{$saleDetail->quantity}},{{$return_quantity[$saleDetail->id]}})"><i class="fa fa-minus-circle"></i></button>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>

                        @if(count($saleDetails) > 0)
                        <div class="card-footer">
                            <div class="text-center">
                                <button wire:click="submitReturn" class="btn btn-primary wd-100">Return</button>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="modal fade" id="modal-danger">
        <div class="modal-dialog">
            <div class="modal-content bg-danger">
                <div class="modal-footer justify-content-between">
                    Are you confirm to reset?
                    <button type="button" wire:click="resetPurchase()" class="btn btn-outline-light" data-dismiss="modal">Confirm</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

    <div wire:loading.delay class="loading">Loading&#8230;</div>
</div>

<script>
    function discountOnchange() {
        var total_amount    = parseFloat($('#total_amount').val());
        var discount        = $('#discount').val();

        if(discount == "") {
            return;
        } else {
            discount = parseFloat(discount);
        }

        var payable         = total_amount - discount;
        var paid            = payable;

    @this.set('payable', payable);
    @this.set('paid', paid);
    @this.set('dues', 0);
    @this.set('advance', 0);

        $('#payable').val(payable);
        $('#paid').val(paid);
        $('#dues').val(0);
        $('#advance').val(0);
        $('#dues_div').hide();
        $('#advance_div').hide();
    }

    function paidOnchange() {
        var payable    = parseFloat($('#payable').val());
        var paid       = $('#paid').val();
        if(paid == "") {
            return;
        } else {
            paid = parseFloat(paid);
        }

        if(payable > paid) {
            var dues = payable - paid
            $('#dues_div').show();
            $('#advance_div').hide();

            $('#dues').val(dues);
            $('#advance').val(0);
        }

        if(payable == paid) {
            $('#dues_div').hide();
            $('#advance_div').hide();

            $('#advance').val(0);
            $('#dues').val(0);
        }

        if(payable < paid) {
            var advance = paid - payable
            $('#dues_div').hide();
            $('#advance_div').show();

            $('#advance').val(advance);
            $('#dues').val(0);
        }
    @this.set('dues', dues);
    @this.set('advance', advance);
    }
</script>

