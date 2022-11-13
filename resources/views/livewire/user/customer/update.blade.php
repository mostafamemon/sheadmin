<div class="row">
    <div class="col-md-12">
        <div class="card card-lightblue">
            <div class="card-header">
                <h3 class="card-title"><i class="fa fa-edit"></i> &nbsp;Update Customer</h3>
            </div>
            <form wire:submit.prevent="update" style="margin-bottom:0px">
                <div class="card-body">
                    @php $row_count = 1; @endphp

                    <div class="row">
                        <div class="col-md-2">
                            <div class="form-group">
                                <label class="multi-row-input">Name</label>
                                <input type="text" class="form-control" wire:model.lazy="name">
                                @error('name')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="form-group">
                                <label class="multi-row-input">Phone</label>
                                <input type="text" class="form-control" wire:model.lazy="phone">
                                @error('phone')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="form-group">
                                <label class="multi-row-input">Email</label>
                                <input type="text" class="form-control" wire:model.lazy="email">
                                @error('email')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="form-group">
                                <label class="multi-row-input">Address</label>
                                <input type="text" class="form-control" wire:model.lazy="address">
                                @error('address')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="form-group">
                                <label class="multi-row-input">Transaction</label>
                                <input type="text" class="form-control" wire:model.lazy="transaction">
                                @error('transaction')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-1">
                            <div class="form-group">
                                <label class="multi-row-input">Dues</label>
                                <input type="text" class="form-control" wire:model.lazy="dues">
                                @error('dues')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-1">
                            <div class="form-group">
                                <label class="multi-row-input">Advance</label>
                                <input type="text" class="form-control" wire:model.lazy="advance">
                                @error('advance')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-footer">
                    <div class="float-left">
                        <a href="/customer?page={{$pre_page}}" class="btn btn-warning"><i class="fa fa-chevron-left tx-14"></i> Back</a>
                    </div>

                    <div class="float-right">
                        <input type="submit" class="btn btn-primary wd-100" value="Submit"/>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
