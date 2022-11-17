<div class="row">
    <div class="col-md-12">
        <div class="card card-lightblue">
            <div class="card-header">
                <h3 class="card-title"><i class="fa fa-plus-circle"></i> &nbsp;Update Category</h3>
            </div>
            <form wire:submit.prevent="update" style="margin-bottom:0px">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Category Name</label>
                                <input type="text" class="form-control" wire:model.lazy="category_name" autocomplete="off">
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="form-group">
                                <label>Search Bar Display</label>
                                <div class="form-check" style="padding-top:5px">
                                    <input class="form-check-input" wire:model="search_bar_display" type="checkbox" value="" id="search_bar_display" checked>
                                    <label class="form-check-label" for="search_bar_display">
                                        Enable
                                    </label>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-2">
                            <div class="form-group">
                                <label>Top Menu Display</label>
                                <div class="form-check" style="padding-top:5px">
                                    <input class="form-check-input" wire:model="top_menu_display" type="checkbox" value="" id="top_menu_display" checked>
                                    <label class="form-check-label" for="top_menu_display">
                                        Enable
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="form-group">
                                <label>Home Page Display</label>
                                <div class="form-check" style="padding-top:5px">
                                    <input class="form-check-input" wire:model="home_page_display" type="checkbox" value="" id="home_page_display" checked>
                                    <label class="form-check-label" for="home_page_display">
                                        Enable
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <div class="form-check">
                                    <div class="mb-3">
                                        <label for="formFile" class="form-label">Banner (430x632)</label>
                                        <input class="form-control" type="file" wire:model="category_banner">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-footer">
                    <div class="float-left">
                        <a href="/category" class="btn btn-warning"><i class="fa fa-chevron-left tx-14"></i> Back</a>
                    </div>

                    <div class="float-right">
                        <input type="submit" class="btn btn-primary wd-100" value="Submit"/>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
