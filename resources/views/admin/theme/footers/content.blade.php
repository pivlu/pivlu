<div class="page-title">
    <div class="row">
        <div class="col-12">
            <nav aria-label="breadcrumb" class="breadcrumb-header">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin') }}">{{ __('Dashboard') }}</a></li>                    
                    <li class="breadcrumb-item" aria-current="page"><a href="{{ route('admin.themes.index') }}">{{ __('Website template') }}</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.theme-footers.index') }}">{{ __('Footers') }}</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.theme-footers.show', ['id' => $footer->id]) }}">{{ $footer->label }}</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ __('Footer content') }}</li>
                </ol>
            </nav>
        </div>
    </div>
</div>

<div class="card">

    @include('admin.theme.includes.menu-themes')

    <div class="card-header">
        <div class="row">

            <div class="col-12">
                <h4 class="card-title">
                    @if ($destination == 'primary')
                        {{ __('Update primary footer content') }}
                        @endif @if ($destination == 'secondary')
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
        @if ($destination == 'primary')
            @if (($footer->footer_columns ?? null) == '1')
                @include('admin.theme.footers.includes.edit-footer-1-col', ['destination' => 'primary'])
            @elseif (($footer->footer_columns ?? null) == '2')
                @include('admin.theme.footers.includes.edit-footer-2-cols', ['destination' => 'primary'])
            @elseif (($footer->footer_columns ?? null) == '3')
                @include('admin.theme.footers.includes.edit-footer-3-cols', ['destination' => 'primary'])
            @elseif (($footer->footer_columns ?? null) == '4')
                @include('admin.theme.footers.includes.edit-footer-4-cols', ['destination' => 'primary'])
            @endif
        @endif

        @if ($destination == 'secondary')
            @if (($footer->footer2_columns ?? null) == '1')
                @include('admin.theme.footers.includes.edit-footer-1-col', ['destination' => 'secondary'])
            @elseif (($footer->footer2_columns ?? null) == '2')
                @include('admin.theme.footers.includes.edit-footer-2-cols', ['destination' => 'secondary'])
            @elseif (($footer->footer2_columns ?? null) == '3')
                @include('admin.theme.footers.includes.edit-footer-3-cols', ['destination' => 'secondary'])
            @elseif (($footer->footer2_columns ?? null) == '4')
                @include('admin.theme.footers.includes.edit-footer-4-cols', ['destination' => 'secondary'])
            @endif
        @endif

    </div>
    <!-- end card-body -->

</div>
