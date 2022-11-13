<div class="card">
    <div class="card-body">
        @if(in_array(config('app.roles')['product_update'], json_decode(auth()->user()->roles)) || in_array(config('app.roles')['product_add'], json_decode(auth()->user()->roles)) || in_array(config('app.roles')['product_export'], json_decode(auth()->user()->roles)))
        <div class="mg-b-38">
            @if(in_array(config('app.roles')['product_update'], json_decode(auth()->user()->roles)))
            <div class="float-left">
                <a href="/product/bulk-update" class="btn btn-warning btn-sm wd-90"><i class="fa fa-edit"></i> &nbsp;Bulk</a>
            </div>
            @endif

            @if(in_array(config('app.roles')['product_add'], json_decode(auth()->user()->roles)) || in_array(config('app.roles')['product_export'], json_decode(auth()->user()->roles)))
            <div class="float-right">
                @if(in_array(config('app.roles')['product_export'], json_decode(auth()->user()->roles)))
                <a href="{{url('export/product')}}" target="_blank" class="btn btn-info btn-sm wd-90"><i class="fa fa-file-excel"></i> &nbsp;Export</a>&nbsp;
                @endif
                @if(in_array(config('app.roles')['product_add'], json_decode(auth()->user()->roles)))
                <a href="/product/add" class="btn btn-primary btn-sm wd-90"><i class="fa fa-plus-circle"></i> Add New</a>
                @endif
            </div>
            @endif
        </div>
        @endif

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
                <select wire:model="filter_category" class="form-control-filter">
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
            <div class="col-md-2 pt-10-mini">
                <input type="text" wire:model.lazy="filter_barcode" class="form-control-filter" placeholder="barcode"/>
            </div>
            <div class="col-md-2 pt-10-mini">
                <input type="text" wire:model.lazy="filter_name" class="form-control-filter" placeholder="product name"/>
            </div>
            <div class="col-md-1 pt-10-mini">
                <button class="btn btn-danger wd-100 filter-button"><i class="fa fa-search"></i> Search</button>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table-width-product table table-striped table-bordered table-hover">
                <thead>
                    <tr class="bg-lightblue">
                        <th class="th-4p th-40px text-center" style="padding:12px !important;">#</th>
                        <th class="th-23p th-200px">Category</th>
                        <th class="th-27p th-250px">Product Name</th>
                        <th class="th-11p th-100px text-center">In Stock</th>
                        <th class="th-13p th-100px text-center">Purchase Price</th>
                        <th class="th-13p th-100px text-center">Sale Price</th>
                        <th class="th-9p th-80px text-center">Action</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($products as $product)
                    <tr>
                        <td class="text-center">
                            @if($filter_category == "all" && $filter_barcode == "" && $filter_name == "")
                            {{ $loop->iteration + $products->firstItem() - 1 }}
                            @else
                                {{$loop->iteration}}
                            @endif
                        </td>
                        <td>@if($product->category_id != ""){{ getCategoryName($product->category_id) }}@endif</td>
                        <td>{{$product->product_name}}</td>
                        <td class="text-right">{{$product->quantity}} <small>{{$product->unit}}</small></td>
                        <td class="text-right">
                            @if($settings->allow_decimal_number == true)
                                {{ number_format($product->purchase_price, 2, '.', '') }}
                            @else
                                {{$product->purchase_price}}
                            @endif
                        </td>
                        <td class="text-right">
                            @if($settings->allow_decimal_number == true)
                                {{ number_format($product->sale_price, 2, '.', '') }}
                            @else
                                {{$product->sale_price}}
                            @endif
                        </td>
                        <td class="text-center">
                            @if(in_array(config('app.roles')['product_update'], json_decode(auth()->user()->roles)) || in_array(config('app.roles')['product_delete'], json_decode(auth()->user()->roles)))
                            <div class="dropdown">
                                <button class="btn btn-warning btn-xs dropdown-toggle force-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                  Action
                                </button>

                                @if($filter_category == "all" && $filter_barcode == "" && $filter_name == "")
                                    @php $current_page = $products->currentPage(); @endphp
                                @else
                                    @php $current_page = 1; @endphp
                                @endif


                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    @if(in_array(config('app.roles')['product_update'], json_decode(auth()->user()->roles)))
                                      <a class="dropdown-item pointer tx-14" href="/product/update/{{$current_page}}/{{$product->id}}">Update</a>
                                      <div class="dropdown-divider"></div>
                                    @endif
                                    @if(in_array(config('app.roles')['product_delete'], json_decode(auth()->user()->roles)))
                                      <a class="dropdown-item pointer tx-14" wire:click="delete('{{$product->id}}','{{ $current_page }}')">Delete</a>
                                    @endif
                                </div>
                            </div>
                            @else
                                <i class="fa fa-ban" aria-hidden="true"></i>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        @if($filter_category == "all" && $filter_barcode == "" && $filter_name == "")
        <div class="pd-t-10">
            {{ $products->links() }}
        </div>
        @endif
    </div>
</div>
