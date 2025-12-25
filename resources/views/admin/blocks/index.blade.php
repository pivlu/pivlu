@include('admin.includes.trumbowyg-assets')
@include('admin.includes.color-picker')

<div class="page-title">
    <div class="row">
        <div class="col-12">
            <nav aria-label="breadcrumb" class="breadcrumb-header">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin') }}">{{ __('Dashboard') }}</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ __('Block components') }}</li>
                </ol>
            </nav>
        </div>
    </div>
</div>


<div class="card">

    @include('admin.blocks.includes.menu-blocks')

    <div class="card-body">


    </div>
    <!-- end card-body -->

</div>
