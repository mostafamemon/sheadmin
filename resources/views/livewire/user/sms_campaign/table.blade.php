<div class="card">
    <div class="card-body">
        <div class="mg-b-7">
            <div class="text-right">
                <a href="/send-sms" class="btn btn-primary btn-sm"><i class="fa fa-envelope"></i> &nbsp;Send SMS</a>
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

        <div class="table-responsive">
            <table class="table-width-customer table table-striped table-bordered table-hover">
                <thead>
                <tr class="bg-lightblue">
                    <th class="th-4p th-40px text-center" style="padding:12px !important;">#</th>
                    <th class="th-20p th-250px text-center">Campaign Date</th>
                    <th class="th-50p th-130px">SMS Body</th>
                    <th class="th-10p th-130px text-center">Total Receiver</th>
                    <th class="th-15p th-80px text-center">Details</th>
                </tr>
                </thead>

                <tbody>
                @foreach($campaigns as $campaign)
                    <tr>
                        <td class="text-center">{{ $loop->iteration + $campaigns->firstItem() - 1 }}</td>
                        <td class="text-center">{{ date('d M, Y',strtotime($campaign->date)) }}</td>
                        <td>{{$campaign->sms_body}}</td>
                        <td class="text-center">{{$campaign->total_receivers}}</td>
                        <td class="text-center">
                            <a class="btn btn-success btn-xs" href="/sms-campaign/receivers/{{$campaigns->currentPage()}}/{{$campaign->id}}">Receivers</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

        <div class="pd-t-10">
            {{ $campaigns->links() }}
        </div>
    </div>
</div>
