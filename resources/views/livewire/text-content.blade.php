<div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark page-title">Text Content</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                        <li class="breadcrumb-item active">Text Content</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        @if(session()->has("message"))
            <div class="flash alert alert-success-custom alert-dismissible fade show" role="alert">
                <strong>Well done!</strong> {{ session('message') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        <section class="content">
            <div class="container-fluid">
            <form wire:submit.prevent="update" style="margin-bottom:0px">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-lightblue">
                            <div class="card-header">
                                <h3 class="card-title"><i class="fa fa-plus-circle"></i> &nbsp;Text Content</h3>
                            </div>
                            
                            <div class="row pd-t-10">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <div class="form-check">
                                            <div class="mb-3">
                                                <label class="form-label">Support Email</label>
                                                <input class="form-control" type="text" wire:model.lazy="support_email">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <div class="form-check">
                                            <div class="mb-3">
                                                <label class="form-label">Phone</label>
                                                <input class="form-control" type="text" wire:model.lazy="phone">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <div class="form-check">
                                            <div class="mb-3">
                                                <label class="form-label">Hotline</label>
                                                <input class="form-control" type="text" wire:model.lazy="hotline">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <div class="form-check">
                                            <div class="mb-3">
                                                <label class="form-label">Address</label>
                                                <input class="form-control" type="text" wire:model.lazy="address">
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
                                                <label class="form-label">Facebook Link</label>
                                                <input class="form-control" type="text" wire:model.lazy="facebook_link">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <div class="form-check">
                                            <div class="mb-3">
                                                <label class="form-label">Youtube Link</label>
                                                <input class="form-control" type="text" wire:model.lazy="youtube_link">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <div class="form-check">
                                            <div class="mb-3">
                                                <label class="form-label">Instagram Link</label>
                                                <input class="form-control" type="text" wire:model.lazy="instagram_link">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row pd-t-10">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="form-check">
                                            <div class="mb-3">
                                                <label class="form-label">Privacy Policy &nbsp;| <a href="https://html-online.com/editor/" target="_blank">&nbsp;Use Editor</a></label>
                                                <textarea class="form-control" wire:model.lazy="privacy_policy" style="height:150px"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row pd-t-10">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="form-check">
                                            <div class="mb-3">
                                                <label class="form-label">Terms and Conditions &nbsp;| <a href="https://html-online.com/editor/" target="_blank">&nbsp;Use Editor</a></label>
                                                <textarea class="form-control" wire:model.lazy="terms_and_conditions" style="height:150px"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row pd-t-10">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="form-check">
                                            <div class="mb-3">
                                                <label class="form-label">Cancellation and Return &nbsp;| <a href="https://html-online.com/editor/" target="_blank">&nbsp;Use Editor</a></label>
                                                <textarea class="form-control" wire:model.lazy="cancellation_and_return" style="height:150px"></textarea>
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