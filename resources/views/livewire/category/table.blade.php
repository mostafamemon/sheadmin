<div class="card">
    <div class="card-body">
        <div class="mg-b-38">
            <div class="float-right">
                <a href="/category/add" class="btn btn-primary btn-sm wd-90"><i class="fa fa-plus-circle"></i> Add New</a>
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
                <input type="text" wire:model.lazy="filter_name" class="form-control-filter" placeholder="category name"/>
            </div>
            <div class="col-md-2">
                <select wire:model="filter_by" class="form-control-filter">
                    <option value="all" style="color:green !important;font-weight:bold;">all</option>
                    <option value="show_in_search_bar" style="color:green !important;font-weight:bold;">Search Bar Display</option>
                    <option value="show_in_top_menu" style="color:green !important;font-weight:bold;">Top Menu Display</option>
                    <option value="show_in_home_page" style="color:green !important;font-weight:bold;">Home Page Display</option>
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
                        <th class="text-center">Banner</th>
                        <th class="text-center">Category</th>
                        <th class="text-center">Search Bar Display</th>
                        <th class="text-center">Top Menu Display</th>
                        <th class="text-center">Home Page Display</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($categories as $category)
                    <tr>
                        <td class="text-center" style="padding:12px !important;">{{ $loop->iteration }}</td>
                        <td class="text-center">
                            @if($category->category_banner != "")
                                <img src="{{ asset('storage/'.str_replace('public/', '', $category->category_banner)) }}" height="50"/>
                            @else
                                <img src="{{ asset('images/image-placeholder.jpeg') }}" height="50"/>
                            @endif
                        </td>
                        <td>{{ $category->category_name }}</td>
                        <td class="text-center">
                            @if($category->show_in_search_bar)
                                <span class="badge badge-success">Enable</span>
                            @else
                                <span class="badge badge-danger">Disable</span>
                            @endif
                        </td>
                        <td class="text-center">
                            @if($category->show_in_top_menu)
                                <span class="badge badge-success">Enable</span>
                            @else
                                <span class="badge badge-danger">Disable</span>
                            @endif
                        </td>
                        <td class="text-center">
                            @if($category->show_in_home_page)
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
                                <a class="dropdown-item pointer tx-14" href="/category/update/{{$category->id}}">Update</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item pointer tx-14" wire:click="delete({{$category->id}})">Delete</a>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
