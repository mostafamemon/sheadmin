<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark page-title">Customer</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                        <li class="breadcrumb-item active">Customer</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
        <div class="card">
            <div class="card-body">
            <form wire:submit.prevent="filter">
                <div class="row filter-div">
                    <div class="col-md-3">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Phone</span>
                            </div>
                            <input type="text" class="form-control" wire:model.lazy="filter_phone" autocomplete="off">
                        </div>
                    </div>

                    <div class="col-md-3 pt-10-mini">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Name</span>
                            </div>
                            <input type="text" class="form-control" wire:model.lazy="filter_name" autocomplete="off">
                        </div>
                    </div>

                    <div class="col-md-1">
                        <input type="submit" class="btn btn-danger wd-100" value="Filter"/>
                    </div>
                </div>
            </form>

                <div class="table-responsive">
                    <table class="table-width-expense table table-striped table-bordered table-hover">
                        <thead>
                        <tr class="bg-lightblue">
                            <th class="text-center" style="padding:12px !important;">#</th>
                            <th>Customer</th>
                            <th>Phone</th>
                            <th class="text-center">Email</th>
                            <th class="text-center">Location</th>
                            <th class="text-center">Address</th>
                        </tr>
                        </thead>

                        <tbody>
                            @foreach($users as $user)
                                <tr>
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->phone }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td class="text-center">
                                        @if($user->delivery_location == "outside_dhaka")
                                            <span class="badge" style="background-color:red;color:white">Outside Dhaka</span>
                                        @else
                                            <span class="badge" style="background-color:green;color:white">Inside Dhaka</span>
                                        @endif
                                    </td>
                                    <td>{{ $user->address }}</td>
                                </tr>
                            @endforeach
                        </tbody>

                    </table>
                </div>

                <div class="pd-t-10">
                </div>
            </div>
        </div>
    </section>
</div>