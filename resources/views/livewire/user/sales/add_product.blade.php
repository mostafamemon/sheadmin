<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark page-title">Sales</h1>
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
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-lightblue">
                        @if(session()->has("message"))
                            <div class="flash alert alert-success-custom alert-dismissible fade show" role="alert">
                                <strong>Well done!</strong> {{ session('message') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif
                        <div class="card-header">
                            <h3 class="card-title"><i class="fa fa-plus-circle"></i> &nbsp;Add Product</h3>
                        </div>
                        <form wire:submit.prevent="store" style="margin-bottom:0px">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label class="multi-row-input">Category</label>
                                            <select wire:model="category_id" class="form-control">
                                                <option value="" style="color:green !important;font-weight:bold;">- none -</option>
                                                @for($ctg_i = 0; $ctg_i < count($categories); $ctg_i++)
                                                    @if(count($categories[$ctg_i]['sub_category']) == 0)
                                                        <option value="{{$categories[$ctg_i]['category_id']}}">{{$categories[$ctg_i]['category_name']}}</option>
                                                    @else
                                                        <optgroup label="{{$categories[$ctg_i]['category_name']}}">
                                                            @for($j = 0; $j < count($categories[$ctg_i]['sub_category']); $j++)
                                                                <option value="{{$categories[$ctg_i]['sub_category'][$j]['category_id']}}">{{$categories[$ctg_i]['sub_category'][$j]['category_name']}}</option>
                                                            @endfor
                                                        </optgroup>
                                                    @endif
                                                @endfor
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label class="multi-row-input">Product Name</label>
                                            <input type="text" class="form-control" wire:model.lazy="product_name">
                                            @error('product_name')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label class="multi-row-input">In Stock</label>
                                            <div class="input-group">
                                                <input type="text" class="form-control" wire:model.lazy="quantity">
                                                <select class="form-control" wire:model="unit">
                                                    <option value="pcs">pcs</option>
                                                    <option value="box">box</option>
                                                    <option value="carton">carton</option>
                                                    <option value="gram">gram</option>
                                                    <option value="kg">kg</option>
                                                    <option value="ltr">ltr</option>
                                                    <option value="ml">ml</option>
                                                    <option value="metre">metre</option>
                                                    <option value="mon">mon</option>
                                                    <option value="packet">packet</option>
                                                    <option value="sack">sack</option>
                                                    <option value="ton">ton</option>
                                                </select>
                                            </div>
                                            @error('quantity')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label class="multi-row-input">Price <small>(per unit)</small></label>
                                            <div class="input-group">
                                                <input type="text" class="form-control" wire:model.lazy="purchase_price" placeholder="buy">
                                                <input type="text" class="form-control" wire:model.lazy="sale_price" placeholder="sale">
                                            </div>
                                            @error('purchase_price')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                            @error('sale_price')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    @if($settings->custom_barcode)
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label class="multi-row-input">Barcode</label>
                                                <input type="text" class="form-control" wire:model.lazy="barcode">
                                                @error('barcode')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    @endif

                                    @if($settings->custom_warn_at)
                                        <div class="col-md-1">
                                            <div class="form-group">
                                                <label class="multi-row-input">Warn At</label>
                                                <input type="text" class="form-control" wire:model.lazy="warn_at">
                                                @error('warn_at')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <div class="card-footer">
                                <div class="float-left">
                                    <a href="/sales" class="btn btn-warning"><i class="fa fa-chevron-left tx-14"></i> Back</a>
                                </div>

                                <div class="float-right">
                                    <input type="submit" class="btn btn-primary wd-100" value="Submit"/>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
