    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark page-title">Banner</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                        <li class="breadcrumb-item active">Banner</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <section class="content">
            <div class="container-fluid">
            <form wire:submit.prevent="update" style="margin-bottom:0px">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-lightblue">
                            <div class="card-header">
                                <h3 class="card-title"><i class="fa fa-plus-circle"></i> &nbsp;Banners</h3>
                            </div>   
                            <div class="row pd-t-10">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <div class="form-check">
                                            <div class="mb-3">
                                                <div>
                                                    @if($old_slider_1 != "") 
                                                        <img src="{{ asset('storage/'.str_replace('public/', '', $old_slider_1)) }}" height="100"/>
                                                    @else
                                                        <img src="{{ asset('images/image-placeholder.jpeg') }}" height="100"/>
                                                    @endif
                                                </div>
                                                <label for="formFile" class="form-label">Slider 1 (666x453)</label>
                                                <input class="form-control" type="file" wire:model="slider_1">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <div class="form-check">
                                            <div class="mb-3">
                                                <div>
                                                    @if($old_slider_2 != "") 
                                                        <img src="{{ asset('storage/'.str_replace('public/', '', $old_slider_2)) }}" height="100"/>
                                                    @else
                                                        <img src="{{ asset('images/image-placeholder.jpeg') }}" height="100"/>
                                                    @endif
                                                </div>
                                                <label for="formFile" class="form-label">Slider 2 (666x453)</label>
                                                <input class="form-control" type="file" wire:model="slider_2">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <div class="form-check">
                                            <div class="mb-3">
                                                <div>
                                                    @if($old_slider_3 != "") 
                                                        <img src="{{ asset('storage/'.str_replace('public/', '', $old_slider_3)) }}" height="100"/>
                                                    @else
                                                        <img src="{{ asset('images/image-placeholder.jpeg') }}" height="100"/>
                                                    @endif
                                                </div>
                                                <label for="formFile" class="form-label">Slider 3 (666x453)</label>
                                                <input class="form-control" type="file" wire:model="slider_3">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row pd-t-10">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <div class="form-check">
                                            <div class="mb-3">
                                                <div>
                                                    @if($old_right_banner_1 != "") 
                                                        <img src="{{ asset('storage/'.str_replace('public/', '', $old_right_banner_1)) }}" height="100"/>
                                                    @else
                                                        <img src="{{ asset('images/image-placeholder.jpeg') }}" height="100"/>
                                                    @endif
                                                </div>
                                                <label for="formFile" class="form-label">Right Banner 1 (669x510)</label>
                                                <input class="form-control" type="file" wire:model="right_banner_1">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <div class="form-check">
                                            <div class="mb-3">
                                                <div>
                                                    @if($old_right_banner_2 != "") 
                                                        <img src="{{ asset('storage/'.str_replace('public/', '', $old_right_banner_2)) }}" height="100"/>
                                                    @else
                                                        <img src="{{ asset('images/image-placeholder.jpeg') }}" height="100"/>
                                                    @endif
                                                </div>
                                                <label for="formFile" class="form-label">Right Banner 2 (669x510)</label>
                                                <input class="form-control" type="file" wire:model="right_banner_2">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <div class="form-check">
                                            <div class="mb-3">
                                                <div>
                                                    @if($old_right_banner_3 != "") 
                                                        <img src="{{ asset('storage/'.str_replace('public/', '', $old_right_banner_3)) }}" height="100"/>
                                                    @else
                                                        <img src="{{ asset('images/image-placeholder.jpeg') }}" height="100"/>
                                                    @endif
                                                </div>
                                                <label for="formFile" class="form-label">Right Banner 3 (669x510)</label>
                                                <input class="form-control" type="file" wire:model="right_banner_3">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row pd-t-10">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <div class="form-check">
                                            <div class="mb-3">
                                                <div>
                                                    @if($old_first_triple_banner_1 != "") 
                                                        <img src="{{ asset('storage/'.str_replace('public/', '', $old_first_triple_banner_1)) }}" height="100"/>
                                                    @else
                                                        <img src="{{ asset('images/image-placeholder.jpeg') }}" height="100"/>
                                                    @endif
                                                </div>
                                                <label for="formFile" class="form-label">First Triple Banner 1 (420x160)</label>
                                                <input class="form-control" type="file" wire:model="first_triple_banner_1">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <div class="form-check">
                                            <div class="mb-3">
                                                <div>
                                                    @if($old_first_triple_banner_2 != "") 
                                                        <img src="{{ asset('storage/'.str_replace('public/', '', $old_first_triple_banner_2)) }}" height="100"/>
                                                    @else
                                                        <img src="{{ asset('images/image-placeholder.jpeg') }}" height="100"/>
                                                    @endif
                                                </div>
                                                <label for="formFile" class="form-label">First Triple Banner 2 (420x160)</label>
                                                <input class="form-control" type="file" wire:model="first_triple_banner_2">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <div class="form-check">
                                            <div class="mb-3">
                                                <div>
                                                    @if($old_first_triple_banner_3 != "") 
                                                        <img src="{{ asset('storage/'.str_replace('public/', '', $old_first_triple_banner_3)) }}" height="100"/>
                                                    @else
                                                        <img src="{{ asset('images/image-placeholder.jpeg') }}" height="100"/>
                                                    @endif
                                                </div>
                                                <label for="formFile" class="form-label">First Triple Banner 3 (420x160)</label>
                                                <input class="form-control" type="file" wire:model="first_triple_banner_3">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row pd-t-10">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <div class="form-check">
                                            <div class="mb-3">
                                                <div>
                                                    @if($old_second_triple_banner_1 != "") 
                                                        <img src="{{ asset('storage/'.str_replace('public/', '', $old_second_triple_banner_1)) }}" height="100"/>
                                                    @else
                                                        <img src="{{ asset('images/image-placeholder.jpeg') }}" height="100"/>
                                                    @endif
                                                </div>
                                                <label for="formFile" class="form-label">Second Triple Banner 1 (420x160)</label>
                                                <input class="form-control" type="file" wire:model="second_triple_banner_1">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <div class="form-check">
                                            <div class="mb-3">
                                                <div>
                                                    @if($old_second_triple_banner_2 != "") 
                                                        <img src="{{ asset('storage/'.str_replace('public/', '', $old_second_triple_banner_2)) }}" height="100"/>
                                                    @else
                                                        <img src="{{ asset('images/image-placeholder.jpeg') }}" height="100"/>
                                                    @endif
                                                </div>
                                                <label for="formFile" class="form-label">Second Triple Banner 2 (420x160)</label>
                                                <input class="form-control" type="file" wire:model="second_triple_banner_2">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <div class="form-check">
                                            <div class="mb-3">
                                                <div>
                                                    @if($old_second_triple_banner_3 != "") 
                                                        <img src="{{ asset('storage/'.str_replace('public/', '', $old_second_triple_banner_3)) }}" height="100"/>
                                                    @else
                                                        <img src="{{ asset('images/image-placeholder.jpeg') }}" height="100"/>
                                                    @endif
                                                </div>
                                                <label for="formFile" class="form-label">Second Triple Banner 3 (420x160)</label>
                                                <input class="form-control" type="file" wire:model="second_triple_banner_3">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card-footer">
                                <div class="float-right">
                                    <input type="submit" class="btn btn-primary wd-100" value="Submit"/>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            </div>
        </section>
    </div>