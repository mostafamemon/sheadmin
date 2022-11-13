<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark page-title">Settings</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                        <li class="breadcrumb-item active">Settings</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            @if(session()->has("message"))
                <div class="flash alert alert-success-custom alert-dismissible fade show" role="alert">
                    <strong>Well done!</strong> {{ session('message') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

            <div class="row">
                <div class="col-md-3">
                    <div class="card card-primary" style="transition: all 0.15s ease 0s; height: inherit; width: inherit;">
                        <div class="card-header">
                            <h3 class="card-title">Daily Target</h3>

                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i></button>
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                            </div>
                        </div>

                        <div class="card-body">
                            <div>
                                <label>Daily Sales Target</label>
                                <input type="text" wire:model.lazy="daily_sales_target" class="form-control"/>
                                @error('daily_sales_target')
                                <div class="text-danger mg-b-5" style="font-size:13px">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="pd-t-10">
                                <label>Daily Expense Budget</label>
                                <input type="text" wire:model.lazy="daily_expense_budget" class="form-control"/>
                                @error('daily_expense_budget')
                                <div class="text-danger mg-b-5" style="font-size:13px">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="card card-primary" style="transition: all 0.15s ease 0s; height: inherit; width: inherit;">
                        <div class="card-header">
                            <h3 class="card-title">General Settings</h3>

                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i></button>
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                            </div>
                        </div>

                        <div class="card-body">
                            <div>
                                <label>Invoice Note</label>
                                <input type="text" wire:model.lazy="invoice_note" class="form-control"/>
                                @error('invoice_note')
                                <div class="text-danger mg-b-5" style="font-size:13px">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="pd-t-10">
                                <label>Other Charge Default Text</label>
                                <input type="text" wire:model.lazy="other_charge_title" class="form-control"/>
                                @error('other_charge_title')
                                <div class="text-danger mg-b-5" style="font-size:13px">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card-footer">
            <div class="text-center">
                <button wire:click="update" class="btn btn-primary wd-100">Update</button>
            </div>
        </div>
    </section>
</div>
