<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark page-title">Purchase &nbsp;<button class="btn btn-sm btn-dark" data-toggle="modal" data-target="#modal-danger">RESET</button></h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                        <li class="breadcrumb-item active">Purchase</li>
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
                                <label class="mg-b-0">Product Name &nbsp;&nbsp;<a href="/add-product/purchase"><i class="fa fa-plus-circle"></i> Add New</a></label>
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

                                <tbody>
                                    @php $pending_purchases = getPendingPurchase(); @endphp
                                    @foreach($pending_purchases as $key => $purchase)
                                        <tr>
                                            <td class=" text-center th-4p th-40px" style="padding:12px !important;">{{$loop->iteration}}</td>
                                            <td class="th-36p th-250px">{{$purchase['product_name']}}</td>
                                            <td class=" text-right th-15p th-130px">
                                                @if($edit_key === $key)
                                                    <input type="text" class="form-control-shrink text-center" wire:model.lazy="edit_quantity"/>
                                                    @error('edit_quantity')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                @else
                                                    {{$purchase['quantity']}} {{$purchase['unit']}}
                                                @endif
                                            </td>
                                            <td class=" text-right th-15p th-300px">
                                                @if($edit_key === $key)
                                                    <input type="text" class="form-control-shrink text-center" wire:model.lazy="edit_unit_price"/>
                                                    @error('edit_unit_price')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                @else
                                                    @if($settings->allow_decimal_number == true)
                                                        {{ number_format($purchase['unit_price'], 2, '.', '') }}
                                                    @else
                                                        {{ $purchase['unit_price'] }}
                                                    @endif
                                                @endif
                                            </td>
                                            <td class="text-right th-15p th-100px">
                                                @if($settings->allow_decimal_number == true)
                                                    {{ number_format($purchase['total'], 2, '.', '') }}
                                                @else
                                                    {{ $purchase['total'] }}
                                                @endif
                                            </td>
                                            <td class="text-center th-15p th-100px">
                                                @if($edit_key === $key)
                                                    <button class="btn btn-success btn-sm" wire:click="editCache({{$key}})"><i class="fa fa-check-circle"></i></button>
                                                @else
                                                    <button class="btn btn-warning btn-sm" wire:click="setEditKey({{$key}})"><i class="fa fa-edit"></i></button>
                                                @endif

                                                @if($delete_key === $key)
                                                    <button class="btn btn-danger btn-xs" wire:click="deleteFromCache()">Confirm?</button>
                                                @else
                                                    <button class="btn btn-danger btn-sm" wire:click="setDeleteKey({{$key}})"><i class="fa fa-trash-alt"></i></button>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
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
                            <input type="text" class="form-control" id="total_amount" wire:model="total_amount" readonly>
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
                            <div class="input-group pd-t-10">
                                <input type="text" class="form-control" wire:model="dues" id="dues" readonly>
                                <div class="input-group-append">
                                    <span class="input-group-text bg-danger border-danger">Dues</span>
                                </div>
                            </div>
                        </div>

                        <div id="advance_div" class="@if($advance == 0 || $advance == "") hidden @endif">
                            <div class="input-group pd-t-10">
                                <input type="text" class="form-control" wire:model="advance" id="advance" readonly>
                                <div class="input-group-append">
                                    <span class="input-group-text bg-gradient-cyan border-info">Advance</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card card-body">
                        <label>SUPPLIER INFO</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text wd-80" id="basic-addon3">Phone</span>
                            </div>
                            <input type="text" class="form-control" wire:model.lazy="supplier_phone" wire:keydown.enter="search_supplier" autocomplete="off">
                            <div class="input-group-append">
                                <button class="btn btn-info" type="button" wire:click="search_supplier"><i class="fa fa-search"></i></button>
                            </div>
                        </div>
                        @error('supplier_phone')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror

                        <div class="input-group pd-t-10">
                            <div class="input-group-prepend">
                                <span class="input-group-text wd-80" id="basic-addon3">Name</span>
                            </div>
                            <input type="text" class="form-control" wire:model.lazy="supplier_name" autocomplete="off">
                        </div>
                        @error('supplier_name')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror

                        <div class="input-group pd-t-10">
                            <div class="input-group-prepend">
                                <span class="input-group-text wd-80" id="basic-addon3">Address</span>
                            </div>
                            <input type="email" class="form-control" wire:model.lazy="supplier_address" autocomplete="off">
                        </div>
                        @error('supplier_address')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror

                        <div class="input-group pd-t-10">
                            <div class="input-group-prepend">
                                <span class="input-group-text wd-80" id="basic-addon3">Email</span>
                            </div>
                            <input type="email" class="form-control" wire:model.lazy="supplier_email" autocomplete="off">
                        </div>
                        @error('supplier_email')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <button class="btn btn-primary btn-block h-50p" wire:click="purchase">PURCHASE</button>
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

