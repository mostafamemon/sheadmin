    <div class="row">
        <div class="col-md-12">
            <div class="card card-lightblue">
                <div class="card-header">
                    <h3 class="card-title"><i class="fa fa-plus-circle"></i> &nbsp;Add Product</h3>
                </div>
                <form wire:submit.prevent="store" style="margin-bottom:0px">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Product Name</label>
                                    <input type="text" class="form-control" wire:model.lazy="product_name" autocomplete="off">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Category</label>
                                    <select class="form-control" wire:model="category_id" wire:change="getSubCategory()">
                                        <option value="" selected>-- select category --</option>
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Sub Category </label>
                                    <select class="form-control" wire:model="sub_category_id">
                                        <option value="" selected>-- select subcategory --</option>
                                        @foreach($sub_categories as $sub_category)
                                            <option value="{{ $sub_category->id }}">{{ $sub_category->sub_category_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>In Stock</label>
                                    <div class="form-check" style="padding-top:5px">
                                        <input class="form-check-input" wire:model="in_stock" type="checkbox" value="" id="in_stock">
                                        <label class="form-check-label" for="in_stock">
                                            Available
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Short Description</label>
                                    <textarea class="form-control" wire:model.lazy="short_description" style="height:100px"></textarea>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Long Description</label>
                                    <textarea class="form-control" wire:model.lazy="long_description" style="height:100px"></textarea>
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Hot Product</label>
                                    <div class="form-check" style="padding-top:5px">
                                        <input class="form-check-input" wire:model="hot_product" type="checkbox" value="" id="hot_product">
                                        <label class="form-check-label" for="hot_product">
                                            Enable
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>New Arrival</label>
                                    <div class="form-check" style="padding-top:5px">
                                        <input class="form-check-input" wire:model="new_arrival" type="checkbox" value="" id="new_arrival">
                                        <label class="form-check-label" for="new_arrival">
                                            Enable
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Top Selling</label>
                                    <div class="form-check" style="padding-top:5px">
                                        <input class="form-check-input" wire:model="top_selling" type="checkbox" value="" id="top_selling">
                                        <label class="form-check-label" for="top_selling">
                                            Enable
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Best Rated</label>
                                    <div class="form-check" style="padding-top:5px">
                                        <input class="form-check-input" wire:model="best_rated" type="checkbox" value="" id="best_rated">
                                        <label class="form-check-label" for="best_rated">
                                            Enable
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Clearense</label>
                                    <div class="form-check" style="padding-top:5px">
                                        <input class="form-check-input" wire:model="clearense" type="checkbox" value="" id="clearense">
                                        <label class="form-check-label" for="clearense">
                                            Enable
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-2">
                            <div class="form-group">
                                <div class="form-check">
                                    <div class="mb-3">
                                        <label for="formFile" class="form-label">Large Image</label>
                                        <input class="form-control" type="file" wire:model="product_page_main_image">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <div class="form-check">
                                    <div class="mb-3">
                                        <label for="formFile" class="form-label">Extra Images 1</label>
                                        <input class="form-control" type="file" wire:model="product_page_other_image_1">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <div class="form-check">
                                    <div class="mb-3">
                                        <label for="formFile" class="form-label">Extra Images 2</label>
                                        <input class="form-control" type="file" wire:model="product_page_other_image_2">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <div class="form-check">
                                    <div class="mb-3">
                                        <label for="formFile" class="form-label">Extra Images 3</label>
                                        <input class="form-control" type="file" wire:model="product_page_other_image_3">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <div class="form-check">
                                    <div class="mb-3">
                                        <label for="formFile" class="form-label">Extra Images 4</label>
                                        <input class="form-control" type="file" wire:model="product_page_other_image_4">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <div class="form-check">
                                    <div class="mb-3">
                                        <label for="formFile" class="form-label">Hot Product Image</label>
                                        <input class="form-control" type="file" wire:model="hot_product_image">
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
