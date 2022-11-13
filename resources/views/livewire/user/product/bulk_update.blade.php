<div class="card">
    <div class="card-body">
        @if(session()->has("message"))
            <div class="flash alert alert-success-custom alert-dismissible fade show" role="alert">
                <strong>Well done!</strong> {{ session('message') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        <div class="row filter-div">
            <div class="col-md-2">
                <select wire:model="filter_category" class="form-control">
                    <option value="all" style="color:green !important;font-weight:bold;">all category</option>
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
            <div class="col-md-2 offset-md-8 text-right pt-10-mini">
                <a href="/product" class="btn btn-warning"><i class="fa fa-chevron-left tx-14"></i> Back</a>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table-width-bulk-product-update table table-striped table-bordered table-hover">
                <thead>
                    <tr class="bg-lightblue">
                        <th class="th-4p th-40px text-center" style="padding:12px !important;">#</th>
                        <th class="th-23p th-200px">Category</th>
                        <th class="th-25p th-250px">Product Name</th>
                        <th class="th-15p th-150px text-center">Current</th>
                        <th class="th-11p th-80px text-center">Stock</th>
                        <th class="th-11p th-80px text-center">Buy Price</th>
                        <th class="th-11p th-80px text-center">Sale Price</th>
                    </tr>
                </thead>

                <tbody>
                    @php $sl = 1; @endphp
                    @foreach($bulk_update_products as $product)
                    <tr>
                        <td class="text-center">{{$sl++}}</td>
                        <td>@if($product->category_id != ""){{ getCategoryName($product->category_id) }}@endif</td>
                        <td>{{$product->product_name}}</td>
                        <td>
                            Stock <span class="mg-l-4 text-bold"><span style="font-weight:500">:</span> {{$product->quantity}} <small>{{$product->unit}}</small></span><br>
                            Buy <span class="mg-l-15 text-bold"><span style="font-weight:500">:</span> {{$product->purchase_price}}</span><br>
                            Sale <span class="mg-l-11 text-bold"><span style="font-weight:500">:</span> {{$product->sale_price}}</span>
                        </td>
                        <td class="text-center">
                            <input type="number" wire:model.lazy="bulk_update_quantity.{{$product->id}}" class="form-control text-center"/>
                        </td>
                        <td class="text-center">
                            <input type="number" wire:model.lazy="bulk_update_purchase.{{$product->id}}" class="form-control text-center"/>
                        </td>
                        <td class="text-center">
                            <input type="number" wire:model.lazy="bulk_update_sale.{{$product->id}}" class="form-control text-center"/>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="card-footer">
        <div class="float-right">
          <button wire:click="bulk_update" class="btn btn-primary wd-100">Update</button>
        </div>
      </div>
</div>
