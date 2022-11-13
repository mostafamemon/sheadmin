<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark page-title">Customer</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                        <li class="breadcrumb-item active">Customer</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            @if($current_page == "index")
                @include('livewire.user.customer.table')
            @elseif($current_page == "add")
                @include('livewire.user.customer.add')
            @elseif($current_page == "update")
                @include('livewire.user.customer.update')
            @else
                @include('livewire.user.customer.table')
            @endif
        </div>
    </section>
</div>
