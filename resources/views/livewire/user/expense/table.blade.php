<div class="card">
    <div class="card-body">
        @if(in_array(config('app.roles')['expense_export'], json_decode(auth()->user()->roles)) || in_array(config('app.roles')['expense_add'], json_decode(auth()->user()->roles)))
        <div class="mg-b-7">
            <div class="text-right">
                @if(in_array(config('app.roles')['expense_export'], json_decode(auth()->user()->roles)))
                <a href="{{url('export/expense?from_date='.$from_date.'&to_date='.$to_date)}}" target="_blank" class="btn btn-info btn-sm wd-90"><i class="fa fa-file-excel"></i> &nbsp;Export</a>&nbsp;
                @endif
                @if(in_array(config('app.roles')['expense_add'], json_decode(auth()->user()->roles)))
                <a href="/expense/add" class="btn btn-primary btn-sm wd-90"><i class="fa fa-plus-circle"></i> Add New</a>
                @endif
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

        <div class="row filter-div">
            <div class="col-md-3">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">From</span>
                    </div>
                    <input type="text" class="form-control" id="datepicker1" wire:model="filter_from_date" onchange="setFromDate(this.value)" autocomplete="off">
                </div>
            </div>

            <div class="col-md-3 pt-10-mini">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">To</span>
                    </div>
                    <input type="text" class="form-control" id="datepicker2" wire:model="filter_to_date" onchange="setToDate(this.value)" autocomplete="off">
                </div>
            </div>

            <div class="col-md-1 offset-5 pt-10-mini text-right">
                <button class="btn btn-danger" wire:click="filterReset">Reset</button>
            </div>

        </div>

        <div class="table-responsive">
            <table class="table-width-expense table table-striped table-bordered table-hover">
                <thead>
                <tr class="bg-lightblue">
                    <th class="th-4p th-40px text-center" style="padding:12px !important;">#</th>
                    <th class="th-20p th-100px">Date</th>
                    <th class="th-50p th-200px">Purpose</th>
                    <th class="text-center th-15p th-100px">Amount</th>
                    <th class="th-11p th-80px text-center">Action</th>
                </tr>
                </thead>

                <tbody>
                    @foreach($expenses as $expense)
                        <tr>
                            <td class="text-center">
                                @if($filter_from_date == "" || $filter_to_date == "")
                                    {{ $loop->iteration + $expenses->firstItem() - 1 }}
                                @else
                                    {{ $loop->iteration}}
                                @endif
                            </td>
                            <td>{{ date('d M Y',strtotime($expense->date)) }}</td>
                            <td>{{ $expense->purpose }}</td>
                            <td class="text-right">
                                @if($settings->allow_decimal_number == true)
                                    {{ number_format($expense->amount, 2, '.', '') }}
                                @else
                                    {{ $expense->amount }}
                                @endif
                            </td>
                            <td class="text-center">
                                @if(in_array(config('app.roles')['expense_update'], json_decode(auth()->user()->roles)) || in_array(config('app.roles')['expense_delete'], json_decode(auth()->user()->roles)))
                                <button class="btn btn-warning btn-xs dropdown-toggle force-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Action
                                </button>

                                @if($filter_from_date == "" && $filter_to_date == "")
                                    @php $current_page = $expenses->currentPage(); @endphp
                                @else
                                    @php $current_page = 1; @endphp
                                @endif

                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    @if(in_array(config('app.roles')['expense_update'], json_decode(auth()->user()->roles)))
                                    <a class="dropdown-item pointer tx-14" href="/expense/update/{{$current_page}}/{{$expense->id}}">Update</a>
                                    <div class="dropdown-divider"></div>
                                    @endif
                                    @if(in_array(config('app.roles')['expense_delete'], json_decode(auth()->user()->roles)))
                                    <a class="dropdown-item pointer tx-14" wire:click="delete('{{$expense->id}}','{{$current_page}}')">Delete</a>
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
            @if($filter_from_date == "" || $filter_to_date == "")
                {{ $expenses->links() }}
            @endif
        </div>
    </div>
</div>

<script>
    function setFromDate(value){
        @this.set('filter_from_date', value);
    }

    function setToDate(value){
        @this.set('filter_to_date', value);
    }
</script>
