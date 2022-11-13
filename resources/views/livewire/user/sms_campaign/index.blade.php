<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark page-title">SMS Campaign</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                        <li class="breadcrumb-item active">SMS Campaign</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            @if($page == "index")
                @include('livewire.user.sms_campaign.table')
            @elseif($page == "receivers")
                @include('livewire.user.sms_campaign.receivers')
            @else
                @include('livewire.user.sms_campaign.table')
            @endif
        </div>
    </section>
</div>
