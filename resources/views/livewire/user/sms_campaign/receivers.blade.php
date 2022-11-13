<div class="card">
    <div class="card-body">
        <div class="mg-b-7">
            <div class="text-right">
                <a href="/sms-campaign?page={{$pre_page}}" class="btn btn-warning btn-sm wd-80"><i class="fa fa-chevron-left tx-14"></i> Back</a>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table-width-customer table table-striped table-bordered table-hover">
                <thead>
                <tr class="bg-lightblue">
                    <th class="th-4p th-40px text-center" style="padding:12px !important;">#</th>
                    <th class="th-10p th-130px text-center">Phone</th>
                    <th class="th-50p th-250px">Status</th>
                </tr>
                </thead>

                <tbody>
                @foreach($receivers as $receiver)
                    <tr>
                        <td class="text-center">{{ $loop->iteration + $receivers->firstItem() - 1 }}</td>
                        <td class="text-center">{{$receiver->phone}}</td>
                        <td>{{$receiver->status}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

        <div class="pd-t-10">
            {{ $receivers->links() }}
        </div>
    </div>
</div>
