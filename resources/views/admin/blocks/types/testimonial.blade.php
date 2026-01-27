<div class="form-group col-md-6">
    <label>{{ __('Select columns (number of testimonials per row)') }}</label>
    <select class="form-select" name="cols">
        <option @if (($block_settings->cols ?? null) == 2) selected @endif value="2">2</option>
        <option @if (($block_settings->cols ?? null) == 3 || is_null($block_settings->cols ?? null)) selected @endif value="3">3</option>
        <option @if (($block_settings->cols ?? null) == 4) selected @endif value="4">4</option>
    </select>
    <div class="form-text">{{ __('This is the maximum number of images per row for larger displays. For smaller displays, the columns are resized automatically.') }}</div>
</div>


<div class="form-group">
    <div class="form-check form-switch">
        <input class="form-check-input" type="checkbox" id="use_star_rating" name="use_star_rating" @if ($block_settings->use_star_rating ?? null) checked @endif>
        <label class="form-check-label" for="use_star_rating">{{ __('Use star rating') }}</label>
    </div>
</div>

<div class="form-group">
    <div class="form-check form-switch">
        <input class="form-check-input" type="checkbox" id="use_images" name="use_images" @if ($block_settings->use_images ?? null) checked @endif>
        <label class="form-check-label" for="use_images">{{ __('Use images') }}</label>
    </div>
</div>

<div class="form-group mb-3">
    <div class="form-check form-switch">
        <input class="form-check-input" type="checkbox" id="use_custom_style_items" name="use_custom_style_items" @if ($block_settings->items_style_id ?? null) checked @endif>
        <label class="form-check-label" for="use_custom_style_items">{{ __('Use custom style for items') }}</label>
    </div>
</div>

<script>
    $('#use_custom_style_items').change(function() {
        select = $(this).prop('checked');
        if (select)
            document.getElementById('hidden_div_style_items').style.display = 'block';
        else
            document.getElementById('hidden_div_style_items').style.display = 'none';
    })
</script>

<div id="hidden_div_style_items" style="display: @if (isset($block_settings->items_style_id)) block @else none @endif" class="mt-2">
    <div class="form-group mb-3 col-md-6">
        <select class="form-select" id="style_id" name="items_style_id" value="@if (isset($block_settings->items_style_id)) {{ $block_settings->items_style_id }} @else #fbf7f0 @endif">
            <option value="">-- {{ __('select style') }} --</option>
            @foreach ($styles as $style)
                <option @if (($block_settings->items_style_id ?? null) == $style->id) selected @endif value="{{ $style->id }}">{{ $style->label }}</option>
            @endforeach
        </select>
        @if (count($styles) == 0)
            <div class="small text-info mt-1">{{ __("You don't have custom styles created") }}</div>
        @endif
        <label class="mt-1">[<a class="fw-bold" target="_blank" href="{{ route('admin.theme-styles.index') }}">{{ __('manage custom styles') }}</a>]</label>
    </div>
</div>


@foreach ($block->all_languages_contents as $lang_content)
    @if (count(admin_languages()) > 1)
        <div class="fw-bold fs-5">{!! flag($lang_content->lang_code, 'circle') !!} {{ $lang_content->lang_name }}</div>
    @endif

    @include('pivlu::admin.blocks.includes.block-header')

    <div class="mb-4"></div>

    @if (count(admin_languages()) > 1 && !$loop->last)
        <hr>
    @endif
@endforeach
