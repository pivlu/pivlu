<div class="row">
    <div class="col-lg-4 col-md-6">
        <div class="form-group mb-3">
            <label>{{ __('Select style form main navigation (links)') }} <br>
                <a target="_blank" href="{{ route('admin.theme-styles.index') }}"><i class="bi bi-palette"></i> {{ __('Manage styles') }}</a>
                <a class="ms-2" onclick="location.reload();" href="#"><i class="bi bi-arrow-clockwise"></i> {{ __('Refresh page') }}</a>
            </label>
            <select class="form-select" id="nav1_style_id" name="nav1_style_id">
                @foreach ($styles as $style)
                    <option @if (($theme_config->nav1_style_id ?? null) == $style->id) selected @endif value="{{ $style->id }}">{{ $style->label }}</option>
                @endforeach
            </select>
            @if (count($styles) == 0)
                <div class="small text-info mt-1">{{ __("You don't have custom styles created") }}</div>
            @endif
        </div>
    </div>

    <div class="col-lg-4 col-md-6">
        <div class="form-group mb-3">
            <label>{{ __('Select style for secondary navigation') }} <br>
                <a target="_blank" href="{{ route('admin.theme-styles.index') }}"><i class="bi bi-palette"></i> {{ __('Manage styles') }}</a>
                <a class="ms-2" onclick="location.reload();" href="#"><i class="bi bi-arrow-clockwise"></i> {{ __('Refresh page') }}</a>
            </label>
            <select class="form-select" id="nav2_style_id" name="nav2_style_id">
                @foreach ($styles as $style)
                    <option @if (($theme_config->nav2_style_id ?? null) == $style->id) selected @endif value="{{ $style->id }}">{{ $style->label }}</option>
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
        <div class="form-group">
            <label>{{ __('Logo align') }}</label>
            <select class="form-select" name="logo_align">
                <option @if (($theme_config->logo_align ?? null) == 'text-center mx-auto') selected @endif value="text-center mx-auto">{{ __('Center') }}</option>
                <option @if (($theme_config->logo_align ?? null) == 'float-start') selected @endif value="float-start">{{ __('Left') }}</option>
                <option @if (($theme_config->logo_align ?? null) == 'float-end') selected @endif value="float-end">{{ __('Right') }}</option>
            </select>
            <div class="form-text">{{ __('Logo is on the first line') }}</div>
        </div>
    </div>

    <div class="col-md-6 col-lg-4">
        <div class="form-group">
            <label>{{ __('Links align') }}</label>
            <select class="form-select" name="links_align">
                <option @if (($theme_config->links_align ?? null) == 'me-auto') selected @endif value="me-auto">{{ __('Left') }}</option>
                <option @if (($theme_config->links_align ?? null) == 'me-auto ms-auto') selected @endif value="me-auto ms-auto">{{ __('Center') }}</option>
                <option @if (($theme_config->links_align ?? null) == 'ms-auto') selected @endif value="ms-auto">{{ __('Right') }}</option>
            </select>
            <div class="form-text">{{ __('Links are on the second line') }}</div>
        </div>
    </div>
</div>

<div class="col-12">
    <div class="form-group mt-3">
        <div class="form-check form-switch">
            <input type="hidden" name="show_custom_text" value="">
            <input class="form-check-input" type="checkbox" id="show_custom_text" name="show_custom_text" @if ($theme_config->show_custom_text ?? null) checked @endif>
            <label class="form-check-label" for="show_custom_text">{{ __('Add custom text on first row') }}</label>
        </div>
    </div>
</div>

<script>
    $('#show_custom_text').change(function() {
        select = $(this).prop('checked');
        if (select) {
            document.getElementById('hidden_div_custom_text').style.display = 'block';
        } else {
            document.getElementById('hidden_div_custom_text').style.display = 'none';
        }
    })
</script>

<div id="hidden_div_custom_text" style="display: @if ($theme_config->show_custom_text ?? null) block @else none @endif" class="mt-2">
    <div class="form-group">
        <labeL>{{ __('Custom text') }}</labeL>
        <textarea rows="4" class="form-control" name="custom_text">{{ $theme_config->custom_text ?? null }}</textarea>
        <div class="form-text">{{ __('You can add HTML code') }}</div>
    </div>
</div>
