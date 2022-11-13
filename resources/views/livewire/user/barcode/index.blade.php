<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark page-title">Barcode</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                        <li class="breadcrumb-item active">Barcode</li>
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
                    <div class="card-header">
                      <h3 class="card-title"><i class="fa fa-print"></i> &nbsp;Print</h3>
                    </div>
                    <div class="card-body">
                        <form wire:submit.prevent="inputValidation">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Category</label>
                                    <select wire:model="filter_category" wire:change="onchangeCategory" class="form-control">
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

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Product</label>
                                    <input list="products" class="form-control" wire:model="filter_product" wire:change="onchangeProduct" placeholder="select product">
                                    <datalist id="products">
                                        @foreach($product_collection as $row)
                                            <option value="{{$row->product_name}}">
                                        @endforeach
                                    </datalist>
                                    @error('filter_product')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>No of Print</label>
                                    <input type="text" class="form-control" wire:model="no_of_print" placeholder="max 100">
                                    @error('no_of_print')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-1 pd-t-28">
                                <input type="submit" class="btn btn-primary" value="Print"/>
                            </div>
                        </div>
                        </form>
                    </div>
                  </div>
                </div>
            </div>
        </div>
    </section>
</div>
