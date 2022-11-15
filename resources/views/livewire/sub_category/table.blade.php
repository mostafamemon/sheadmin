<div class="card">
    <div class="card-body">
        <div class="mg-b-38">
            <div class="float-right">
                <a href="/sub-category/add" class="btn btn-primary btn-sm wd-90"><i class="fa fa-plus-circle"></i> Add New</a>
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
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                    @endforeach
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
                        <th class="text-center">Sub Category</th>
                        <th class="text-center">Category</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($sub_categories as $sub_category)
                    <tr>
                        <td class="text-center" style="padding:12px !important;">{{ $loop->iteration }}</td>
                        <td>{{ $sub_category->sub_category_name }}</td>
                        <td>{{ $sub_category->category->category_name }}</td>
                        <td class="text-center">
                            <button class="btn btn-warning btn-xs dropdown-toggle force-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Action
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item pointer tx-14" href="/sub-category/update/{{$sub_category->id}}">Update</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item pointer tx-14" wire:click="delete({{$sub_category->id}})">Delete</a>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
