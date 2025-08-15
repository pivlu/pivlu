@include('admin.includes.trumbowyg-assets')
@include('admin.includes.color-picker')

<div class="page-title">
    <div class="row">
        <div class="col-12">
            <nav aria-label="breadcrumb" class="breadcrumb-header">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin') }}">{{ __('Dashboard') }}</a></li>
                    <li class="breadcrumb-item" aria-current="page"><a href="{{ route('admin.themes.index') }}">{{ __('Appearance') }}</a></li>
                    <li class="breadcrumb-item" aria-current="page">{{ __('Theme builder') }}</li>
                </ol>
            </nav>
        </div>
    </div>
</div>

<div class="card">

    @include('admin.theme.includes.menu-themes')

    <div class="card-body">
        <div class="fw-bold fs-5"><a href="{{ route('admin.themes.index') }}">{{ __('Themes') }}</a> / {{ $theme->label }}</div>
    </div>

</div>

<div class="card">
    <div class="mb-3">
        @include('admin.theme.includes.menu-theme')
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

        @include('admin.theme.theme-' . $theme_tab)


    </div>

</div>
