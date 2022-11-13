<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark page-title">Company List</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                        <li class="breadcrumb-item active">Company</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                  <div class="card card-lightblue">
                    <div class="card-header">
                      <h3 class="card-title"><i class="fa fa-edit"></i> &nbsp;Manage</h3>
                    </div>
                    <form wire:submit.prevent="update" style="margin-bottom:0px">
                        <div class="card-body">
                            @if(session()->has("message"))
                                <div class="flash alert alert-success-custom alert-dismissible fade show" role="alert">
                                    <strong>Well done!</strong> {{ session('message') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif
                            <div class="row pd-b-15">
                                <div class="col-md-3">
                                    <div class="text-center pd-b-10 float-left">
                                        @if($previewLogo != "")
                                            <img height="80" width="186" src="{{$previewLogo}}" alt="Company logo">
                                        @elseif($logo != "" && isFileExists($logo_without_prefix))
                                            <img height="80" width="186" src="{{asset($logo)}}" alt="Company logo">
                                        @else
                                            <img height="80" width="186" src="{{asset('img/company-logo-placeholder.png')}}" alt="Company logo">
                                        @endif
                                    </div>

                                    <div>
                                        <input type="file" id="logo" wire:change="$emit('fileChoosenUserCompany')" wire:model="logo" accept="image/x-png,image/jpeg">
                                    </div>

                                    <div wire:loading wire:target="logo" class="pd-t-10">
                                        <div class="spinner-grow text-primary" role="status">
                                            <span class="sr-only">Loading...</span>
                                        </div>
                                        <div class="spinner-grow text-secondary" role="status">
                                            <span class="sr-only">Loading...</span>
                                        </div>
                                        <div class="spinner-grow text-success" role="status">
                                            <span class="sr-only">Loading...</span>
                                        </div>
                                        <div class="spinner-grow text-danger" role="status">
                                            <span class="sr-only">Loading...</span>
                                        </div>
                                        <div class="spinner-grow text-warning" role="status">
                                            <span class="sr-only">Loading...</span>
                                        </div>
                                        <div class="spinner-grow text-info" role="status">
                                            <span class="sr-only">Loading...</span>
                                        </div>
                                    </div>

                                    @error('logo')
                                    <br>
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-9"></div>
                            </div>

                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Company Name</label>
                                        <input type="text" class="form-control" value="{{$company_name}}" readonly>
                                        @error('company_name')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Phone</label>
                                        <input type="text" class="form-control" wire:model.lazy="phone">
                                        @error('phone')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input type="text" class="form-control" wire:model.lazy="email">
                                        @error('email')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Website</label>
                                        <input type="text" class="form-control" wire:model.lazy="website">
                                        @error('website')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>VAT Registration No.</label>
                                        <input type="text" class="form-control" value="{{$vat_reg_no}}" readonly>
                                        @error('vat_reg_no')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-9">
                                    <div class="form-group">
                                    <label>Address</label>
                                    <input type="text" class="form-control" wire:model.lazy="address">
                                    @error('address')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                    </div>
                                </div>
                            </div>
                        </div>

                        @if(in_array(config('app.roles')['company_update'], json_decode(auth()->user()->roles)))
                        <div class="card-footer">
                            <div class="float-right">
                                <input type="submit" class="btn btn-primary wd-100" value="Update"/>
                            </div>
                        </div>
                        @endif
                    </form>
                  </div>
                </div>
            </div>
        </div>
    </section>
</div>

<script>
    window.livewire.on('fileChoosenUserCompany', () => {
        let inputField  = document.getElementById('logo');
        let file        = inputField.files[0];

        let reader      = new FileReader();
        reader.onloadend = () => {
            window.livewire.emit('fileUploadUserCompany', reader.result)
        }
        reader.readAsDataURL(file);
    });
</script>
