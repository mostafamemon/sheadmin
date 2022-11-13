<div class="row">
    <div class="col-md-12">
      <div class="card card-lightblue">
        <div class="card-header">
          <h3 class="card-title"><i class="fa fa-plus-circle"></i> &nbsp;Add Product</h3>
        </div>
        <form wire:submit.prevent="store" style="margin-bottom:0px">
          <div class="card-body">
            @php $row_count = 1; @endphp

            <div class="row">
                <div class="col-md-2">
                    <div class="form-group">
                        <label class="multi-row-input">Category &nbsp;<a href="/product/category/{{$current_page}}"><i class="fa fa-plus-circle"></i> Add</a></label>
                        <select wire:model="category_id.0" class="form-control">
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
                        <input type="text" class="form-control" wire:model.lazy="product_name.0">
                        @error('product_name.0')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="col-md-2">
                    <div class="form-group">
                        <label class="multi-row-input">In Stock</label>
                        <div class="input-group">
                            <input type="text" class="form-control" wire:model.lazy="quantity.0">
                            <select class="form-control" wire:model="unit.0">
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
                        @error('quantity.0')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="col-md-2">
                    <div class="form-group">
                        <label class="multi-row-input">Price <small>(per unit)</small></label>
                        <div class="input-group">
                            <input type="text" class="form-control" wire:model.lazy="purchase_price.0" placeholder="buy">
                            <input type="text" class="form-control" wire:model.lazy="sale_price.0" placeholder="sale">
                        </div>
                        @error('purchase_price.0')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                        @error('sale_price.0')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                @if($settings->custom_barcode)
                <div class="col-md-2">
                    <div class="form-group">
                        <label class="multi-row-input">Barcode</label>
                        <input type="text" class="form-control" wire:model.lazy="barcode.0">
                        @error('barcode.0')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                @endif

                @if($settings->custom_warn_at)
                <div class="col-md-1">
                    <div class="form-group">
                        <label class="multi-row-input">Warn At</label>
                        <input type="text" class="form-control" wire:model.lazy="warn_at.0">
                        @error('warn_at.0')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                @endif

                <div class="col-md-1 mg-t-22">
                    @if($row_count < $max_row && $row_count == $i)
                    <a class="btn btn-success add-remove-btn" wire:click="addRow({{$i}})"><i class="fa fa-plus-circle"></i></a>
                    @endif
                </div>
            </div>

            @foreach($inputs as $key => $value)
                @php $row_count = $row_count + 1; @endphp

                <div class="row">
                    <div class="col-md-2">
                        <div class="form-group">
                            <label class="multi-row-input">Category &nbsp;<a href="/product/category/{{$current_page}}"><i class="fa fa-plus-circle"></i> Add</a></label>
                            <select wire:model="category_id.{{$value}}" class="form-control">
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
                            <input type="text" class="form-control" wire:model.lazy="product_name.{{$value}}">
                            @error('product_name.'.$value)
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-2">
                        <div class="form-group">
                            <label class="multi-row-input">In Stock</label>
                            <div class="input-group">
                                <input type="text" class="form-control" wire:model.lazy="quantity.{{$value}}">
                                <select class="form-control" wire:model="unit.{{$value}}">
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
                            @error('quantity.'.$value)
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-2">
                        <div class="form-group">
                            <label class="multi-row-input">Price <small>(per unit)</small></label>
                            <div class="input-group">
                                <input type="text" class="form-control" wire:model.lazy="purchase_price.{{$value}}" placeholder="buy">
                                <input type="text" class="form-control" wire:model.lazy="sale_price.{{$value}}" placeholder="sale">
                            </div>
                            @error('purchase_price.'.$value)
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                            @error('sale_price.'.$value)
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    @if($settings->custom_barcode)
                    <div class="col-md-2">
                        <div class="form-group">
                            <label class="multi-row-input">Barcode</label>
                            <input type="text" class="form-control" wire:model.lazy="barcode.{{$value}}">
                            @error('barcode.'.$value)
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    @endif

                    @if($settings->custom_warn_at)
                    <div class="col-md-1">
                        <div class="form-group">
                            <label class="multi-row-input">Warn At</label>
                            <input type="text" class="form-control" wire:model.lazy="warn_at.{{$value}}">
                            @error('warn_at.'.$value)
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    @endif

                    <div class="col-md-1 mg-t-22">
                        @if($row_count < $max_row && $row_count == $i)
                        <a class="btn btn-success add-remove-btn" wire:click="addRow({{$i}})"><i class="fa fa-plus-circle"></i></a>
                        @endif
                        @if($row_count == $i)
                        <a class="btn btn-danger add-remove-btn" wire:click="removeRow('{{$key}}')"><i class="fa fa-minus-circle"></i></a>
                        @endif
                    </div>
                </div>
            @endforeach
          </div>

          <div class="card-footer">
            <div class="float-left">
              <a href="/product" class="btn btn-warning"><i class="fa fa-chevron-left tx-14"></i> Back</a>
            </div>

            <div class="float-right">
              <input type="submit" class="btn btn-primary wd-100" value="Submit"/>
            </div>
          </div>
        </form>
      </div>
    </div>
</div>
