<div class="row">
    <div class="col-md-12">
        <div class="card card-lightblue">
            <div class="card-header">
                <h3 class="card-title"><i class="fa fa-plus-circle"></i> &nbsp;Add Supplier</h3>
            </div>
            <form wire:submit.prevent="store" style="margin-bottom:0px">
                <div class="card-body">
                    @php $row_count = 1; @endphp

                    <div class="row">
                        <div class="col-md-2">
                            <div class="form-group">
                                <label class="multi-row-input">Name</label>
                                <input type="text" class="form-control" wire:model.lazy="name.0">
                                @error('name.0')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="form-group">
                                <label class="multi-row-input">Phone</label>
                                <input type="text" class="form-control" wire:model.lazy="phone.0">
                                @error('phone.0')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="form-group">
                                <label class="multi-row-input">Email</label>
                                <input type="text" class="form-control" wire:model.lazy="email.0">
                                @error('email.0')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="form-group">
                                <label class="multi-row-input">Address</label>
                                <input type="text" class="form-control" wire:model.lazy="address.0">
                                @error('address.0')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-1">
                            <div class="form-group">
                                <label class="multi-row-input">Transaction</label>
                                <input type="text" class="form-control" wire:model.lazy="total_transaction.0">
                                @error('total_transaction.0')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-1">
                            <div class="form-group">
                                <label class="multi-row-input">Dues</label>
                                <input type="text" class="form-control" wire:model.lazy="current_dues.0">
                                @error('current_dues.0')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-1">
                            <div class="form-group">
                                <label class="multi-row-input">Advance</label>
                                <input type="text" class="form-control" wire:model.lazy="current_advance.0">
                                @error('current_advance.0')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-1 mg-t-22">
                            @if($row_count < $max_row && $row_count == $i)
                                <a class="btn btn-success add-remove-btn" wire:click="addRow({{$i}})"><i class="fa fa-plus-circle"></i></a>
                            @endif
                        </div>
                    </div>

                    @foreach($inputs as $key => $value)
                        @php $row_count = $row_count + 1; @endphp

                        <div class="row">
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label class="multi-row-input">Name</label>
                                    <input type="text" class="form-control" wire:model.lazy="name.{{$value}}">
                                    @error('name.'.$value)
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="form-group">
                                    <label class="multi-row-input">Phone</label>
                                    <input type="text" class="form-control" wire:model.lazy="phone.{{$value}}">
                                    @error('phone.'.$value)
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="form-group">
                                    <label class="multi-row-input">Email</label>
                                    <input type="text" class="form-control" wire:model.lazy="email.{{$value}}">
                                    @error('email.'.$value)
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="form-group">
                                    <label class="multi-row-input">Address</label>
                                    <input type="text" class="form-control" wire:model.lazy="address.{{$value}}">
                                    @error('address.'.$value)
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-1">
                                <div class="form-group">
                                    <label class="multi-row-input">Transaction</label>
                                    <input type="text" class="form-control" wire:model.lazy="total_transaction.{{$value}}">
                                    @error('total_transaction.'.$value)
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-1">
                                <div class="form-group">
                                    <label class="multi-row-input">Dues</label>
                                    <input type="text" class="form-control" wire:model.lazy="current_dues.{{$value}}">
                                    @error('current_dues.'.$value)
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-1">
                                <div class="form-group">
                                    <label class="multi-row-input">Advance</label>
                                    <input type="text" class="form-control" wire:model.lazy="current_advance.{{$value}}">
                                    @error('current_advance.'.$value)
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-1 mg-t-22">
                                @if($row_count < $max_row && $row_count == $i)
                                    <a class="btn btn-success add-remove-btn" wire:click="addRow({{$i}})"><i class="fa fa-plus-circle"></i></a>
                                @endif
                                @if($row_count == $i)
                                    <a class="btn btn-danger add-remove-btn" wire:click="removeRow('{{$key}}')"><i class="fa fa-minus-circle"></i></a>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="card-footer">
                    <div class="float-left">
                        <a href="/supplier" class="btn btn-warning"><i class="fa fa-chevron-left tx-14"></i> Back</a>
                    </div>

                    <div class="float-right">
                        <input type="submit" class="btn btn-primary wd-100" value="Submit"/>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
