<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark page-title">Dashboard</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                    <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-lightblue">
                        <div class="inner" style="padding-left:15px;">
                            <h3 style="padding-top:5px;">{{$pending_orders}}</h3>
                            <p style="margin-top:-5px;">Production Company</p>
                        </div>
                        <div class="icon"></div>
                    </div>
                </div>

                <div class="col-lg-3 col-6">
                    <div class="small-box bg-pink">
                        <div class="inner" style="padding-left:15px;">
                            <h3 style="padding-top:5px;">{{$todays_order}}</h3>
                            <p style="margin-top:-5px;">Today's Order</p>
                        </div>
                        <div class="icon"></div>
                    </div>
                </div>

                <div class="col-lg-3 col-6">
                    <div class="small-box text-white" style="background-color: #1CAF9A">
                        <div class="inner" style="padding-left:15px;">
                            <h3 style="padding-top:5px;">{{$todays_sale}}</h3>
                            <p style="margin-top:-5px;">Today's Sale</p>
                        </div>
                        <div class="icon"></div>
                    </div>
                </div>

                <div class="col-lg-3 col-6">
                    <div class="small-box bg-maroon">
                        <div class="inner" style="padding-left:15px;">
                            <h3 style="padding-top:5px;">{{$this_month_sale}}</h3>
                            <p style="margin-top:-5px;">This Month Sale</p>
                        </div>
                        <div class="icon"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>