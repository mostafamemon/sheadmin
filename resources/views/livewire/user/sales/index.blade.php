<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark page-title">Sales &nbsp;<button class="btn btn-sm btn-dark" data-toggle="modal" data-target="#modal-danger">RESET</button></h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                        <li class="breadcrumb-item active">Sales</li>
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

            @error('become-stock-out')
                <div class="row">
                    <div class="col-md-12">
                        <div class="flash alert alert-warning alert-dismissible fade show" role="alert">
                            {{ $message }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    </div>
                </div>
            @enderror

            <div class="row bg-white m-0 mb-2">
                <div class="col-md-3 pd-10">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text wd-100 bg-secondary border-secondary" id="basic-addon3">Stamp Text</span>
                        </div>
                        <input type="text" class="form-control" id="invoice_stamp_note" wire:model.lazy="invoice_stamp_note">
                    </div>
                </div>

                <div class="col-md-3 pd-10">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text wd-100 bg-gradient-olive border-success" id="basic-addon3">Sale</span>
                        </div>
                        <input type="text" class="form-control" id="total_amount" wire:model="total_amount" readonly>
                    </div>
                </div>

                <div class="col-md-3 pd-10">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text wd-100 bg-info border-info" id="basic-addon3">VAT</span>
                        </div>
                        <input type="text" class="form-control" id="vat" value="{{ $vat }}" readonly>
                    </div>
                </div>

                <div class="col-md-3 pd-10">
                    <div class="input-group">
                        <input type="text" class="form-control text-center" wire:model.lazy="other_charge_title">
                        <input type="text" class="form-control" id="other_charge_amount" wire:model.lazy="other_charge_amount" oninput="otherChargeOnchange()" autocomplete="off">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-9">
                    <div class="card card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <label class="mg-b-0">Barcode</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" wire:model="barcode" wire:keydown.enter="addByBarcode">
                                    <div class="input-group-append">
                                        <button wire:click="addByBarcode()" class="btn btn-info" type="button"><i class="fa fa-search"></i></button>
                                    </div>
                                </div>
                                @error('barcode')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-8 pd-t-10">
                                <label class="mg-b-0">Product Name &nbsp;&nbsp;<a href="/add-product/sales"><i class="fa fa-plus-circle"></i> Add New</a></label>
                                <input list="products" class="form-control" wire:model.lazy="product_name" wire:change="getUnitPrice">
                                <datalist id="products">
                                    @foreach($products as $product)
                                        <option value="{{$product->product_name}}">
                                    @endforeach
                                </datalist>
                                @error('product_name')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-2 pd-t-10">
                                <label class="mg-b-0">Quantity</label>
                                <input type="text" class="form-control" wire:model.lazy="quantity">
                                @error('quantity')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-2 pd-t-10">
                                <label class="mg-b-0">Unit Price</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" wire:model.lazy="unit_price" wire:keydown.enter="addByName">
                                    <div class="input-group-append">
                                        <button class="btn btn-success" wire:click="addByName" type="button"><i class="fa fa-plus-circle"></i></button>
                                    </div>
                                </div>
                                @error('unit_price')
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
                                    <th class="th-36p th-250px">Name</th>
                                    <th class=" text-center th-15p th-130px">Quantity</th>
                                    <th class=" text-center th-15p th-300px">Unit Price</th>
                                    <th class="text-center th-15p th-100px">Total</th>
                                    <th class="text-center th-15p th-100px">Action</th>
                                </tr>
                                </thead>

                                @livewire('pending-sales')
                            </table>
                        </div>

                    </div>
                </div>

                <div class="col-md-3">
                    <div class="card card-body">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text wd-80 bg-gradient-gray border-secondary" id="basic-addon3">Total</span>
                            </div>
                            <input type="text" class="form-control" id="grand_total" wire:model="grand_total" readonly>
                        </div>

                        <div class="input-group pd-t-10">
                            <div class="input-group-prepend">
                                <span class="input-group-text wd-80 bg-gradient-gray border-secondary" id="basic-addon3">Discount</span>
                            </div>
                            <input type="number" class="form-control" id="discount" wire:model.lazy="discount" oninput="discountOnchange()" autocomplete="off">
                        </div>
                        @error('discount')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror

                        <div class="input-group pd-t-10">
                            <div class="input-group-prepend">
                                <span class="input-group-text wd-80 bg-gradient-gray border-secondary" id="basic-addon3">Payable</span>
                            </div>
                            <input type="text" class="form-control" id="payable" wire:model="payable" readonly>
                        </div>

                        <div class="input-group pd-t-10">
                            <div class="input-group-prepend">
                                <span class="input-group-text wd-80 bg-gradient-olive border-success" id="basic-addon3">Paid</span>
                            </div>
                            <input type="number" class="form-control" wire:model.lazy="paid" id="paid" oninput="paidOnchange()" autocomplete="off">
                        </div>
                        @error('paid')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror

                        <div id="dues_div" class="@if($dues == 0 || $dues == "") hidden @endif">
                            <div class="input-group pd-t-15">
                                <input type="text" class="form-control" wire:model="dues" id="dues" readonly>
                                <div class="input-group-append">
                                    <span class="input-group-text bg-danger border-danger">Dues</span>
                                </div>
                            </div>
                        </div>

                        <div id="advance_div" class="@if($advance == 0 || $advance == "") hidden @endif">
                            <div class="input-group pd-t-15">
                                <input type="text" class="form-control" wire:model="advance" id="advance" readonly>
                                <div class="input-group-append">
                                    <span class="input-group-text bg-gradient-cyan border-info">Advance</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card card-body">
                        <label>CUSTOMER INFO</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text wd-80" id="basic-addon3">Phone</span>
                            </div>
                            <input type="text" class="form-control" wire:model.lazy="customer_phone" wire:keydown.enter="search_customer" autocomplete="off">
                            <div class="input-group-append">
                                <button class="btn btn-info" type="button" wire:click="search_customer"><i class="fa fa-search"></i></button>
                            </div>
                        </div>
                        @error('customer_phone')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror

                        <div class="input-group pd-t-10">
                            <div class="input-group-prepend">
                                <span class="input-group-text wd-80" id="basic-addon3">Name</span>
                            </div>
                            <input type="text" class="form-control" wire:model.lazy="customer_name" autocomplete="off">
                        </div>
                        @error('customer_name')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror

                        <div class="input-group pd-t-10">
                            <div class="input-group-prepend">
                                <span class="input-group-text wd-80" id="basic-addon3">Address</span>
                            </div>
                            <input type="text" class="form-control" wire:model.lazy="customer_address" autocomplete="off">
                        </div>
                        @error('customer_address')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror

                        <div class="input-group pd-t-10">
                            <div class="input-group-prepend">
                                <span class="input-group-text wd-80" id="basic-addon3">Email</span>
                            </div>
                            <input type="email" class="form-control" wire:model.lazy="customer_email" autocomplete="off">
                        </div>
                        @error('customer_email')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <button class="btn btn-primary btn-block h-50p" wire:click="sales">SALE</button>
                </div>
            </div>
        </div>
    </section>

    <div class="modal fade" id="modal-danger">
        <div class="modal-dialog">
            <div class="modal-content bg-danger">
                <div class="modal-footer justify-content-between">
                    Are you confirm to reset?
                    <button type="button" wire:click="resetSales()" class="btn btn-outline-light" data-dismiss="modal">Confirm</button>
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
        var grand_total     = parseFloat($('#grand_total').val());
        var discount        = $('#discount').val();

        if(discount == "") {
            discount = 0;
        } else {
            discount = parseFloat(discount);
        }

        var payable         = grand_total - discount;
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

    function otherChargeOnchange() {
        var other_charge_amount     = $('#other_charge_amount').val();
        var total_amount            = parseFloat($('#total_amount').val());
        var vat                     = parseFloat($('#vat').val());
        var grand_total             = parseFloat($('#grand_total').val());
        var discount                = parseFloat($('#discount').val());
        if(other_charge_amount == "") {
            other_charge_amount = 0;
        } else {
            other_charge_amount     = parseFloat(other_charge_amount);
        }
        grand_total         = total_amount + vat + other_charge_amount;
        var payable         = grand_total - discount;
        var paid            = payable;

        @this.set('grand_total', grand_total);
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

