<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark page-title">Product
                        @if($current_page == "index")
                        &nbsp;<a href="/product/category/home" class="btn btn-sm btn-dark">CATEGORY</a>
                        @endif
                    </h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                    <li class="breadcrumb-item active">Product</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            @if($current_page == "index")
                @include('livewire.user.product.table')
            @elseif($current_page == "add")
                @include('livewire.user.product.add')
            @elseif($current_page == "update")
                @include('livewire.user.product.update')
            @elseif($current_page == "bulk-update")
                @include('livewire.user.product.bulk_update')
            @elseif($current_page == "category")
                @include('livewire.user.product.category')
            @else
                @include('livewire.user.product.table')
            @endif
        </div>
    </section>
</div>
