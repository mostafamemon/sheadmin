<div class="card">
    <div class="card-body">
        @if(in_array(config('app.roles')['user_add'], json_decode(auth()->user()->roles)))
        <div class="mg-b-7">
            <div class="text-right">
                <a href="/user/add" class="btn btn-primary btn-sm wd-90"><i class="fa fa-plus-circle"></i> Add New</a>
            </div>
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

        <div class="table-responsive">
            <table class="table-width-expense table table-striped table-bordered table-hover">
                <thead>
                <tr class="bg-lightblue">
                    <th class="th-4p th-40px text-center" style="padding:12px !important;">#</th>
                    <th class="th-15p th-100px">Name</th>
                    <th class="th-15p th-200px">Designation</th>
                    <th class="text-center th-15p th-100px">Phone</th>
                    <th class="text-center th-15p th-100px">Email</th>
                    <th class="text-center th-10p th-100px">Language</th>
                    <th class="text-center th-10p th-100px">Status</th>
                    <th class="th-11p th-80px text-center">Action</th>
                </tr>
                </thead>

                <tbody>
                    @foreach($users as $user)
                        <tr>
                            <td class="text-center">{{ $loop->iteration + $users->firstItem() - 1 }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->designation }}</td>
                            <td>{{ $user->phone }}</td>
                            <td>{{ $user->email }}</td>
                            <td class="text-center"><span class="badge badge-info">{{ $user->language }}</span></td>
                            <td class="text-center">
                                @if($user->status == 1)
                                <span class="badge badge-success">Active</span>
                                @else
                                <span class="badge badge-danger">Inactive</span>
                                @endif
                            </td>
                            <td class="text-center">
                                @if(in_array(config('app.roles')['user_update'], json_decode(auth()->user()->roles)) || in_array(config('app.roles')['user_delete'], json_decode(auth()->user()->roles)))
                                <button class="btn btn-warning btn-xs dropdown-toggle force-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Action
                                </button>

                                @php $current_page = $users->currentPage(); @endphp

                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    @if(in_array(config('app.roles')['user_update'], json_decode(auth()->user()->roles)))
                                    <a class="dropdown-item pointer tx-14" href="/user/update/{{$current_page}}/{{$user->id}}">Update</a>
                                    <div class="dropdown-divider"></div>
                                    @endif
                                    @if(in_array(config('app.roles')['user_delete'], json_decode(auth()->user()->roles)))
                                    <a class="dropdown-item pointer tx-14" wire:click="delete('{{$user->id}}','{{$current_page}}')">Delete</a>
                                    @endif
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

        <div class="pd-t-10">
            {{ $users->links() }}
        </div>
    </div>
</div>
