<div class="row">
    <div class="col-md-12">
        <div class="card card-lightblue">
            <div class="card-header">
                <h3 class="card-title"><i class="fa fa-plus-circle"></i> &nbsp;Add Expense</h3>
            </div>
            <form wire:submit.prevent="store" style="margin-bottom:0px">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Date</label>
                                <input type="text" class="form-control" id="datepicker1" wire:model="date" onchange="setDate(this.value)" autocomplete="off">
                                @error('date')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Amount</label>
                                <input type="text" class="form-control" wire:model.lazy="amount">
                                @error('amount')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Purpose</label>
                                <input type="text" class="form-control" wire:model.lazy="purpose">
                                @error('purpose')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-footer">
                    <div class="float-left">
                        <a href="/expense" class="btn btn-warning"><i class="fa fa-chevron-left tx-14"></i> Back</a>
                    </div>

                    <div class="float-right">
                        <input type="submit" class="btn btn-primary wd-100" value="Submit"/>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function setDate(value){
        @this.set('date', value);
    }
</script>
