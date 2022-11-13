<div class="row">
    <div class="col-md-12">
      <div class="card card-lightblue">
        <div class="card-header">
          <h3 class="card-title pd-t-5"><i class="fa fa-plus-circle"></i> &nbsp;Add Category</h3>
          <div class="float-right">
            @if($pre_page == "add")
            <a href="/product/{{$pre_page}}" class="btn btn-light btn-sm wd-100" style="color:black;font-weight:bold;"><i class="fa fa-chevron-left tx-11"></i> Back</a>
            @elseif($pre_page == "home")
            <a href="/product" class="btn btn-light btn-sm wd-100" style="color:black;font-weight:bold;"><i class="fa fa-chevron-left tx-11"></i> Back</a>
            @else
            <a href="/product/update/{{$pre_page}}/{{$product_id}}" class="btn btn-light btn-sm wd-100" style="color:black;font-weight:bold;"><i class="fa fa-chevron-left tx-11"></i> Back</a>
            @endif
          </div>
        </div>
        <form wire:submit.prevent="addCategory">
          <div class="card-body">
            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <label>Parent Category</label>
                        <select class="form-control" wire:model="parent_id">
                            <option value="0">none</option>
                            @foreach($parent_categories as $category)
                              <option value="{{$category->id}}">{{$category->category_name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label>Category Name</label>
                        <input type="text" class="form-control" wire:model.lazy="category_name">
                        @error('category_name')
                          <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                @if($settings->vat_calculation == "CATEGORY_BASED")
                @if($parent_id == 0)
                <div class="col-md-2">
                  <div class="form-group">
                      <label>VAT (%)</label>
                      <input type="text" class="form-control" wire:model.lazy="vat_percentage">
                      @error('vat_percentage')
                        <span class="text-danger">{{ $message }}</span>
                      @enderror
                  </div>
                </div>
                @endif
                @endif

                <div class="col-md-1 pd-t-28">
                    <input type="submit" class="btn btn-primary wd-100" value="Submit"/>
                </div>
            </div>

            <div class="table-responsive">
              <table class="table-width-category table table-striped table-bordered table-hover">
                  <thead>
                    <tr>
                      <th class="text-center">#</th>
                      <th>Category</th>
                      <th>Sub Category</th>
                      @if($settings->vat_calculation == "CATEGORY_BASED")
                      <th class="text-center">VAT(%)</th>
                      @endif
                      <th class="text-center">Action</th>
                    </tr>
                  </thead>

                  <tbody>
                    @php $sl = 0; @endphp
                    @for($i = 0; $i < count($categories); $i++)
                      @php $sl = $sl + 1; @endphp

                      @if(count($categories[$i]['sub_category']) == 0)
                        <tr>
                          <td class="text-center">{{$sl}}</td>
                          <td>{{$categories[$i]['category_name']}}</td>
                          <td></td>
                          @if($settings->vat_calculation == "CATEGORY_BASED")
                          <td class="text-center">{{$categories[$i]['vat_percentage']}} <small>%</small></td>
                          @endif
                          <td class="text-center">
                            <button class="btn btn-danger btn-xs" wire:click="deleteCategory('{{$categories[$i]['category_id']}}')">Delete</button>
                          </td>
                        </tr>
                      @else
                        <tr>
                          <td class="text-center">{{$sl}}</td>
                          <td>{{$categories[$i]['category_name']}}</td>
                          <td></td>
                          @if($settings->vat_calculation == "CATEGORY_BASED")
                          <td class="text-center">{{$categories[$i]['vat_percentage']}} <small>%</small></td>
                          @endif
                          <td class="text-center">
                            <button class="btn btn-danger btn-xs" wire:click="deleteCategory('{{$categories[$i]['category_id']}}')">Delete</button>
                          </td>
                        </tr>
                        @php $sl = $sl + 1; @endphp
                          @for($j = 0; $j < count($categories[$i]['sub_category']); $j++)
                            @php $sl = $sl + 1; @endphp
                              <tr>
                                <td class="text-center">{{$sl}}</td>
                                <td>{{$categories[$i]['sub_category'][$j]['parent_name']}}</td>
                                <td>{{$categories[$i]['sub_category'][$j]['category_name']}}</td>
                                  @if($settings->vat_calculation == "CATEGORY_BASED")
                                <td class="text-center">{{$categories[$i]['sub_category'][$j]['vat_percentage']}} <small>%</small></td>
                                  @endif
                                <td class="text-center">
                                  <button class="btn btn-danger btn-xs" wire:click="deleteCategory('{{$categories[$i]['sub_category'][$j]['category_id']}}')">Delete</button>
                                </td>
                              </tr>
                          @endfor
                      @endif
                    @endfor
                  </tbody>
              </table>
            </div>

          </div>

        </form>
      </div>
    </div>
</div>
