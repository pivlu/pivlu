<div class="page-title">
    <div class="row">
        <div class="col-12">
            <nav aria-label="breadcrumb" class="breadcrumb-header">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin') }}">{{ __('Dashboard') }}</a></li>
                    <li class="breadcrumb-item" aria-current="page"><a href="{{ route('admin.plugins') }}">{{ __('Plugins') }}</a></li>
                </ol>
            </nav>
        </div>
    </div>
</div>


<div class="card">

    <div class="card-body">

        <div class="fw-bold fs-5 mb-2">{{ __('Install plugin') }}</div>
        
        {!! nl2br($result1_output) !!}
        {!! nl2br($result1_error_output) !!};

        <hr>

        {!! nl2br($result2_output) !!}
        {!! nl2br($result2_error_output) !!};

        <hr>

        {!! nl2br($result3_output) !!}        
        {!! nl2br($result3_error_output) !!};
            
    </div>
    <!-- end card-body -->

</div>
