<div class="row">
    <div class="col-lg-4 col-md-6">
        <div class="form-group mb-3">
            <label>{{ __('Select style form main navigation (links)') }} <br>
                <a target="_blank" href="{{ route('admin.theme-styles.index') }}"><i class="bi bi-palette"></i> {{ __('Manage styles') }}</a>
                <a class="ms-2" onclick="location.reload();" href="#"><i class="bi bi-arrow-clockwise"></i> {{ __('Refresh page') }}</a>
            </label>
            <select class="form-select" id="nav_default_style_id" name="nav_default_style_id">
                @foreach ($styles as $style)
                    <option @if (($theme_config->nav_default_style_id ?? null) == $style->id) selected @endif value="{{ $style->id }}">{{ $style->label }}</option>
                @endforeach
            </select>
            @if (count($styles) == 0)
                <div class="small text-info mt-1">{{ __("You don't have custom styles created") }}</div>
            @endif
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6 col-lg-4">
        <div class="form-group mb-3">
            <label class="form-check-label">{{ __('Spacing') }}</label>
            <select name="nav_default_links_margin" class="form-select">
                <option value="">{{ __('Default spacing') }}</option>
                <option @if (($theme_config->nav_default_links_margin ?? null) == 'ms-2') selected @endif value="ms-2">{{ __('Add small spacing') }}</option>
                <option @if (($theme_config->nav_default_links_margin ?? null) == 'ms-3') selected @endif value="ms-3">{{ __('Add medium spacing') }}</option>
                <option @if (($theme_config->nav_default_links_margin ?? null) == 'ms-4') selected @endif value="ms-4">{{ __('Add large spacing') }}</option>
                <option @if (($theme_config->nav_default_links_margin ?? null) == 'ms-5') selected @endif value="ms-5">{{ __('Add extra large spacing') }}</option>
            </select>
            <div class="small text-muted">{{ __('Spacing between navigation links') }}</div>
        </div>
    </div>

    <div class="col-md-6 col-lg-4">
        <div class="form-group mb-3">
            <label>{{ __('Navigation menu height') }}</label>
            <select class="form-select" name="nav_default_padding">
                <option @if (($theme_config->nav_default_padding ?? null) == '10px') selected @endif value="10px">{{ __('Normal') }}</option>
                <option @if (($theme_config->nav_default_padding ?? null) == '5px') selected @endif value="5px">{{ __('Small') }}</option>
                <option @if (($theme_config->nav_default_padding ?? null) == '20px') selected @endif value="20px">{{ __('Large') }}</option>
            </select>
        </div>
    </div>

</div>
