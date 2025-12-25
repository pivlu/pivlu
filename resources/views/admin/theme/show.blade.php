@include('pivlu::admin.includes.trumbowyg-assets')
@include('pivlu::admin.includes.color-picker')

<div class="page-title">
    <div class="row">
        <div class="col-12">
            <nav aria-label="breadcrumb" class="breadcrumb-header">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin') }}">{{ __('Dashboard') }}</a></li>
                    <li class="breadcrumb-item" aria-current="page"><a href="{{ route('admin.themes.index') }}">{{ __('Website templates') }}</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ $theme->label }}</li>
                </ol>
            </nav>
        </div>
    </div>
</div>


<div class="card">
    <div class="mb-3">
        @include('pivlu::admin.theme.includes.menu-theme')
    </div>

    <div class="card-body">

        @if ($message = Session::get('success'))
            <div class="alert alert-success">
                @if ($message == 'created')
                    {{ __('Created') }}
                @endif
                @if ($message == 'updated')
                    {{ __('Updated') }}
                @endif
                @if ($message == 'deleted')
                    {{ __('Deleted') }}
                @endif
            </div>
        @endif

        @include('pivlu::admin.theme.theme-' . $theme_tab)        

    </div>

</div>


