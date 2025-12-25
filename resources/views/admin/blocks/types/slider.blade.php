<div class="form-group col-md-6">
    <label>{{ __('Background style') }}</label>
    <select class="form-select" name="bg_style" id="bg_style" onchange="change_bg_style()">
        <option @if (($block_settings->bg_style ?? null) == 'color') selected @endif value="color">{{ __('Color') }}</option>
        <option @if (($block_settings->bg_style ?? null) == 'image') selected @endif value="image">{{ __('Image') }}</option>
    </select>
</div>

<script>
    function change_bg_style() {
        var select = document.getElementById('bg_style');
        var value = select.options[select.selectedIndex].value;
        if (value == 'color') {
            document.getElementById('hidden_div_bg_image').style.display = 'none';
            document.getElementById('hidden_div_bg_color').style.display = 'block';
        } else {
            document.getElementById('hidden_div_bg_image').style.display = 'block';
            document.getElementById('hidden_div_bg_color').style.display = 'none';
        }
    }
</script>

<div id="hidden_div_bg_color" style="display: @if (($block_settings->bg_style ?? null) != 'image') block @else none @endif">
    <div class="form-group">
        <input class="form-control form-control-color" id="bg_color" name="bg_color" value="@if (isset($block_settings->bg_color)) {{ $block_settings->bg_color }} @else #444444 @endif">
        <label>{{ __('Slider background color') }}</label>
        <script>
            $('#bg_color').spectrum({
                type: "color",
                showInput: true,
                showInitial: true,
                showAlpha: false,
                showButtons: false,
                allowEmpty: false,
            });
        </script>
    </div>
</div>

<div id="hidden_div_bg_image" style="display: @if (($block_settings->bg_style ?? null) == 'image') block @else none @endif">
    <div class="form-group col-md-6">
        <div class="form-check form-switch">
            <input class="form-check-input" type="checkbox" id="cover_dark" name="cover_dark" @if ($block_settings->cover_dark ?? null) checked @endif>
            <label class="form-check-label" for="cover_dark">{{ __('Add dark layer to background cover') }}</label>
        </div>
    </div>

    <div class="form-group col-md-6">
        <div class="form-check form-switch">
            <input class="form-check-input" type="checkbox" id="cover_fixed" name="cover_fixed" @if ($block_settings->cover_fixed ?? null) checked @endif>
            <label class="form-check-label" for="cover_fixed">{{ __('Fixed background') }}</label>
        </div>
    </div>

    <div class="form-group">
        <label for="formFile" class="form-label">{{ __('Image') }}</label>
        <input class="form-control" type="file" id="formFile" name="bg_image">
    </div>

    @if ($block_settings->bg_media_id ?? null)
        <a target="_blank" href="{{ image($block_settings->bg_media_id) }}"><img style="max-width: 300px; max-height: 100px;" src="{{ image($block_settings->bg_media_id, 'small') }}" class="img-fluid mt-2"></a>
        <input type="hidden" name="existing_bg_media_id" value="{{ $block_settings->bg_media_id ?? null }}">

        <div class="form-group mb-0">
            <div class="form-check form-switch">
                <input type="hidden" name="delete_bg_media_id" value="{{ $block_settings->bg_media_id ?? null }}">
                <input class="form-check-input" type="checkbox" id="delete_bg_image" name="delete_bg_image">
                <label class="form-check-label" for="delete_bg_image">{{ __('Delete image') }}</label>
            </div>
        </div>
    @endif
</div>

<div class="col-md-6 form-group">
    <label>{{ __('Interval duration (in seconds)') }}</label>
    <input class="form-control" type="number" step="1" min="0" name="delay_seconds" value="{{ $block_settings->delay_seconds ?? null }}">
    <div class="form-text">{{ 'Change the amount of time (in seconds) to delay between automatically cycling to the next item. Leave empty for no delay to next item' }}</div>
</div>

<div class="row">
    <div class="col-md-6 form-group">
        <input class="form-control form-control-color" id="font_color_title" name="font_color_title" value="@if ($block_settings->font_color_title ?? null) {{ $block_settings->font_color_title }} @else #ffffff @endif">
        <label>{{ __('Font color (title)') }}</label>
        <script>
            $('#font_color_title').spectrum({
                type: "color",
                showInput: true,
                showInitial: true,
                showAlpha: false,
                showButtons: false,
                allowEmpty: false,
            });
        </script>
    </div>

    <div class="col-md-6 form-group">
        <input class="form-control form-control-color" id="font_color_content" name="font_color_content" value="@if ($block_settings->font_color_content ?? null) {{ $block_settings->font_color_content }} @else #ffffff @endif">
        <label>{{ __('Font color (content)') }}</label>
        <script>
            $('#font_color_content').spectrum({
                type: "color",
                showInput: true,
                showInitial: true,
                showAlpha: false,
                showButtons: false,
                allowEmpty: false,
            });
        </script>
    </div>
</div>

<div class="row">
    <div class="col-md-6 form-group">
        @php
            $font_size_title = $block_settings->font_size_title ?? config('pivlu.defaults.h3_size');
        @endphp

        <label>{{ __('Title font size') }}</label>
        <select class="form-select" name="font_size_title">
            @foreach ($font_sizes as $selectes_font_size_title)
                <option @if ($font_size_title == $selectes_font_size_title->value) selected @endif value="{{ $selectes_font_size_title->value }}">{{ $selectes_font_size_title->name }}</option>
            @endforeach
        </select>
    </div>

    <div class="col-md-6 form-group">
        @php
            $font_size_content = $block_settings->font_size_content ?? config('pivlu.defaults.font_size');
        @endphp

        <label>{{ __('Content font size') }}</label>
        <select class="form-select" name="font_size_content">
            @foreach ($font_sizes as $selectes_font_size_title)
                <option @if ($font_size_content == $selectes_font_size_title->value) selected @endif value="{{ $selectes_font_size_title->value }}">{{ $selectes_font_size_title->name }}</option>
            @endforeach
        </select>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label>{{ __('Read more button style') }}</label>
            <select class="form-select" name="button_id">
                @foreach ($buttons as $button)
                    <option @if (($block_settings->button_id ?? null) == $button->id) selected @endif value="{{ $button->id }}">{{ $button->label }}</option>
                @endforeach
            </select>

            <div class="form-text">{{ __("If you don't select a button, the default button will be used") }}</div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <label>{{ __('Read more button size') }}</label>
            <select class="form-select" name="button_size">
                <option @if (($block_settings->button_size ?? null) == 'btn-sm') selected @endif value="btn-sm">{{ __('Small') }}</option>
                <option @if (($block_settings->button_size ?? null) == '') selected @endif value="">{{ __('Normal') }}</option>
                <option @if (($block_settings->button_size ?? null) == 'btn-lg') selected @endif value="btn-lg">{{ __('Large') }}</option>
            </select>
        </div>
    </div>
</div>

<div class="form-group">
    <div class="form-check form-switch">
        <input class="form-check-input" type="checkbox" id="shadow_title" name="shadow_title" @if ($block_settings->shadow_title ?? null) checked @endif>
        <label class="form-check-label" for="shadow_title">{{ __('Add shadow to title text') }}</label>
    </div>
</div>

<div class="form-group">
    <div class="form-check form-switch">
        <input class="form-check-input" type="checkbox" id="shadow_content" name="shadow_content" @if ($block_settings->shadow_content ?? null) checked @endif>
        <label class="form-check-label" for="shadow_content">{{ __('Add shadow to content text') }}</label>
    </div>
</div>

<div class="form-group">
    <div class="form-check form-switch">
        <input class="form-check-input" type="checkbox" id="rounded_images" name="rounded_images" @if ($block_settings->rounded_images ?? null) checked @endif>
        <label class="form-check-label" for="rounded_images">{{ __('Add rounded borders to slides (images)') }}</label>
    </div>
</div>
