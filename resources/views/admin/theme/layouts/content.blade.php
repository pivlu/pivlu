@include('pivlu::admin.includes.trumbowyg-assets')

<div class="page-title">
    <div class="row">
        <div class="col-12">
            <nav aria-label="breadcrumb" class="breadcrumb-header">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin') }}">{{ __('Dashboard') }}</a></li>
                    <li class="breadcrumb-item" aria-current="page"><a href="{{ route('admin.themes.index') }}">{{ __('Website template') }}</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.theme.layouts') }}">{{ __('Layouts') }}</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ __('Layout content') }} - {{ $item->label }}</li>
                </ol>
            </nav>
        </div>
    </div>
</div>



<div class="card">

    @include('pivlu::admin.theme.includes.menu-themes')

    <div class="card-header">
        <div class="row">

            <div class="col-12">
                <h4 class="card-title">
                    {{ __('Layout content') }} - {{ $item->label }}
                </h4>
                <div class="form-text">{{ __('Click on "Add blocs" to add content blocks (text, images, columns, ...)') }}</div>
            </div>
        </div>
    </div>


    <div class="card-body">

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if ($message = Session::get('error'))
            <div class="alert alert-danger">
                @if ($message == 'duplicate')
                    {{ __('Error. Page with this slug already exists') }}
                @endif
                @if ($message == 'length2')
                    {{ __('Error. Page slug must be minimum 3 characters') }}
                @endif
            </div>
        @endif

        @if ($message = Session::get('success'))
            <div class="alert alert-success">
                @if ($message == 'deleted')
                    {{ __('Deleted') }}
                @endif
                @if ($message == 'updated')
                    {{ __('Updated') }}
                @endif
            </div>
        @endif

        @if ($item->has_top_section == '1')
            @include('pivlu::admin.theme.layouts.includes.edit-layout-top')
            <div class="mb-5"></div>
        @endif


        @if ($item->sidebar == 'left')
            <div class="row">
                <div class="col-md-6 col-lg-5">
                    @include('pivlu::admin.theme.layouts.includes.edit-layout-sidebar')
                </div>

                <div class="col-md-6 col-lg-7">
                    <div class="builder-col bg-light text-center">
                        <div class="fw-bold mt-4">
                            {{ __('PAGE CONTENT') }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="mb-5"></div>
        @endif

        @if ($item->sidebar == 'right')
            <div class="row">
                <div class="col-md-6 col-lg-7">
                    <div class="builder-col bg-light text-center">
                        <div class="fw-bold mt-4">
                            {{ __('PAGE CONTENT') }}
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-5">
                    @include('pivlu::admin.theme.layouts.includes.edit-layout-sidebar')
                </div>
            </div>
            <div class="mb-5"></div>
        @endif

        @if ($item->has_bottom_section == '1')
            @include('pivlu::admin.theme.layouts.includes.edit-layout-bottom')
        @endif

    </div>
    <!-- end card-body -->

</div>
