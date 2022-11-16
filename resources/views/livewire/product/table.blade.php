<div class="card">
    <div class="card-body">
        <div class="mg-b-38">
            <div class="float-right">
                <a href="/product/add" class="btn btn-primary btn-sm wd-90"><i class="fa fa-plus-circle"></i> Add New</a>
            </div>
        </div>

        @if(session()->has("message"))
            <div class="flash alert alert-success-custom alert-dismissible fade show" role="alert">
                <strong>Well done!</strong> {{ session('message') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        <div class="row filter-div">
            <div class="col-md-2 pt-10-mini">
                <input type="text" wire:model.lazy="filter_by_name" class="form-control-filter" placeholder="product name"/>
            </div>
            <div class="col-md-2">
                <select wire:model="filter_by_category" wire:change="getFilterSubCategory" class="form-control-filter">
                    <option value="all">all category</option>
                    @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2">
                <select wire:model="filter_by_subcategory" class="form-control-filter">
                    <option value="all">all subcategory</option>
                    @foreach($sub_categories as $sub_category)
                    <option value="{{ $sub_category->id }}">{{ $sub_category->sub_category_name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2">
                <select wire:model="filter_by" class="form-control-filter">
                    <option value="all">all</option>
                    <option value="in_stock">In Stock</option>
                    <option value="out_of_stock">Out of Stock</option>
                    <option value="hot_product">Hot Product</option>
                    <option value="new_arrival">New Arrival</option>
                    <option value="top_selling">Top Selling</option>
                    <option value="best_rated">Best Rated</option>
                    <option value="clearense">Clearense</option>
                </select>
            </div>
            <div class="col-md-1 pt-10-mini">
                <button wire:click="filter" class="btn btn-danger wd-100 filter-button"><i class="fa fa-search"></i> Search</button>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table-width-product table table-striped table-bordered table-hover">
                <thead>
                    <tr class="bg-lightblue">
                        <th class="text-center" style="padding:12px !important;">#</th>
                        <th class="text-center">Image</th>
                        <th class="text-center">Product</th>
                        <th class="text-center">Category</th>
                        <th class="text-center">Sub Category</th>
                        <th class="text-center">Hot Product</th>
                        <th class="text-center">New Arrival</th>
                        <th class="text-center">Top Selling</th>
                        <th class="text-center">Best Rated</th>
                        <th class="text-center">Clearense</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($products as $product)
                    <tr>
                        <td class="text-center" style="padding:12px !important;">{{ $loop->iteration }}</td>
                        <td class="text-center">
                            @if($product->product_page_main_image != "")
                                <img src="{{ asset('storage/'.str_replace('public/', '', $product->product_page_main_image)) }}" height="50"/>
                            @else
                                <img src="{{ asset('images/image-placeholder.jpeg') }}" height="50"/>
                            @endif
                        </td>
                        <td>{{ $product->product_name }}</td>
                        <td>
                            @if($product->category_id != 0 && $product->category_id != "")
                                {{ get_category_name($product->category_id) }}
                            @endif
                        </td>
                        <td>
                            @if($product->sub_category_id != 0 && $product->sub_category_id != "")
                                {{ get_sub_category_name($product->sub_category_id) }}
                            @endif
                        </td>
                        <td class="text-center">
                            @if($product->hot_product)
                                <span class="badge badge-success">Enable</span>
                            @else
                                <span class="badge badge-danger">Disable</span>
                            @endif
                        </td>
                        <td class="text-center">
                            @if($product->new_arrival)
                                <span class="badge badge-success">Enable</span>
                            @else
                                <span class="badge badge-danger">Disable</span>
                            @endif
                        </td>
                        <td class="text-center">
                            @if($product->top_selling)
                                <span class="badge badge-success">Enable</span>
                            @else
                                <span class="badge badge-danger">Disable</span>
                            @endif
                        </td>
                        <td class="text-center">
                            @if($product->best_rated)
                                <span class="badge badge-success">Enable</span>
                            @else
                                <span class="badge badge-danger">Disable</span>
                            @endif
                        </td>
                        <td class="text-center">
                            @if($product->clearense)
                                <span class="badge badge-success">Enable</span>
                            @else
                                <span class="badge badge-danger">Disable</span>
                            @endif
                        </td>
                        <td class="text-center">
                            <button class="btn btn-warning btn-xs dropdown-toggle force-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Action
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item pointer tx-14" href="/product/update/{{$product->id}}">Update</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item pointer tx-14" wire:click="delete({{$product->id}})">Delete</a>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
