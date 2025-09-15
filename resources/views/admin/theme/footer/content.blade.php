<div class="page-title">
    <div class="row">
        <div class="col-12">
            <nav aria-label="breadcrumb" class="breadcrumb-header">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin') }}">{{ __('Dashboard') }}</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.themes.index') }}">{{ __('Template') }}</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.theme-footer') }}">{{ __('Footer') }}</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ __('Footer content') }}</li>
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


    <div class="card-header">
        <div class="row">

            <div class="col-12">
                <h4 class="card-title">
                    @if ($footer == 'primary')
                        {{ __('Update primary footer content') }}
                        @endif @if ($footer == 'secondary')
                            {{ __('Update secondary footer content') }}
                        @endif
                </h4>
                <div class="form-text">{{ __('Click on "Add blocs" to add content blocks (text, images, links, ...)') }}</div>
            </div>
        </div>
    </div>


    <div class="card-body">             
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

        @if ($footer == 'primary')
            @if (($theme_config->tpl_footer_columns ?? null) == '1')
                @include('admin.theme.footer.includes.edit-footer-1-col', ['footer' => 'primary'])
            @elseif (($theme_config->tpl_footer_columns ?? null) == '2')
                @include('admin.theme.footer.includes.edit-footer-2-cols', ['footer' => 'primary'])
            @elseif (($theme_config->tpl_footer_columns ?? null) == '3')
                @include('admin.theme.footer.includes.edit-footer-3-cols', ['footer' => 'primary'])
            @elseif (($theme_config->tpl_footer_columns ?? null) == '4')
                @include('admin.theme.footer.includes.edit-footer-4-cols', ['footer' => 'primary'])
            @endif
        @endif

        @if ($footer == 'secondary')
            @if (($theme_config->tpl_footer2_columns ?? null) == '1')
                @include('admin.theme.footer.includes.edit-footer-1-col', ['footer' => 'secondary'])
            @elseif (($theme_config->tpl_footer2_columns ?? null) == '2')
                @include('admin.theme.footer.includes.edit-footer-2-cols', ['footer' => 'secondary'])
            @elseif (($theme_config->tpl_footer2_columns ?? null) == '3')
                @include('admin.theme.footer.includes.edit-footer-3-cols', ['footer' => 'secondary'])
            @elseif (($theme_config->tpl_footer2_columns ?? null) == '4')
                @include('admin.theme.footer.includes.edit-footer-4-cols', ['footer' => 'secondary'])
            @endif
        @endif

    </div>
    <!-- end card-body -->

</div>
