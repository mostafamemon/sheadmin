<div class="row">
    <div class="col-md-12">
        <div class="card card-lightblue">
            <div class="card-header">
                <h3 class="card-title"><i class="fa fa-plus-circle"></i> &nbsp;Update Sub Category</h3>
            </div>
            <form wire:submit.prevent="update" style="margin-bottom:0px">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Parent Category</label>
                                <select class="form-control" wire:model="category_id">
                                    <option value="">-- select category --</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}" @if($sub_category_id == $category->id) selected @endif>{{ $category->category_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <div class="form-check">
                                    <div class="mb-3">
                                        <label for="formFile" class="form-label">Sub Category Name</label>
                                        <input class="form-control" type="text" wire:model.lazy="sub_category_name">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-footer">
                    <div class="float-left">
                        <a href="/sub-category" class="btn btn-warning"><i class="fa fa-chevron-left tx-14"></i> Back</a>
                    </div>

                    <div class="float-right">
                        <input type="submit" class="btn btn-primary wd-100" value="Submit"/>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
