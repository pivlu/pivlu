<div class="form-group mb-3">
    <div class="form-check form-switch">
        <input type="hidden" name="remove_border" value="">
        <input class="form-check-input" type="checkbox" id="remove_border" name="remove_border" @if ($block_settings->remove_border ?? null) checked @endif>
        <label class="form-check-label" for="remove_border">{{ __('Remove border') }}</label>
    </div>
</div>

<div class="form-group mb-3">
    <div class="form-check form-switch">
        <input type="hidden" name="collapse_first_item" value="">
        <input class="form-check-input" type="checkbox" id="collapse_first_item" name="collapse_first_item" @if ($block_settings->collapse_first_item ?? null) checked @endif>
        <label class="form-check-label" for="collapse_first_item">{{ __('Collapse first item content') }}</label>
    </div>
</div>


<div class="form-group mb-3">
    <div class="form-check form-switch">
        <input class="form-check-input" type="checkbox" id="use_custom_style_accordion_items_title" name="use_custom_style_accordion_items_title" @if ($block_settings->items_title_style_id ?? null) checked @endif>
        <label class="form-check-label" for="use_custom_style_accordion_items_title">{{ __('Use custom style for accordion items title') }}</label>
    </div>
</div>

<script>
    $('#use_custom_style_accordion_items_title').change(function() {
        select = $(this).prop('checked');
        if (select)
            document.getElementById('hidden_div_style_items_title').style.display = 'block';
        else
            document.getElementById('hidden_div_style_items_title').style.display = 'none';
    })
</script>

<div id="hidden_div_style_items_title" style="display: @if (isset($block_settings->items_title_style_id)) block @else none @endif" class="mt-2">
    <div class="form-group mb-3 col-md-6">
        <select class="form-select" id="style_id" name="items_title_style_id" value="@if (isset($block_settings->items_title_style_id)) {{ $block_settings->items_title_style_id }} @else #fbf7f0 @endif">
            <option value="">-- {{ __('select style') }} --</option>
            @foreach ($styles as $style)
                <option @if (($block_settings->items_title_style_id ?? null) == $style->id) selected @endif value="{{ $style->id }}">{{ $style->label }}</option>
            @endforeach
        </select>
        @if (count($styles) == 0)
            <div class="small text-info mt-1">{{ __("You don't have custom styles created") }}</div>
        @endif
        <label class="mt-1">[<a class="fw-bold" target="_blank" href="{{ route('admin.theme-styles.index') }}">{{ __('manage custom styles') }}</a>]</label>
    </div>
</div>


<div class="form-group mb-3">
    <div class="form-check form-switch">
        <input class="form-check-input" type="checkbox" id="use_custom_style_accordion_items_content" name="use_custom_style_accordion_items_content" @if ($block_settings->items_content_style_id ?? null) checked @endif>
        <label class="form-check-label" for="use_custom_style_accordion_items_content">{{ __('Use custom style for accordion items content') }}</label>
    </div>
</div>

<script>
    $('#use_custom_style_accordion_items_content').change(function() {
        select = $(this).prop('checked');
        if (select)
            document.getElementById('hidden_div_style_items_content').style.display = 'block';
        else
            document.getElementById('hidden_div_style_items_content').style.display = 'none';
    })
</script>

<div id="hidden_div_style_items_content" style="display: @if (isset($block_settings->items_content_style_id)) block @else none @endif" class="mt-2">
    <div class="form-group mb-3 col-md-6">
        <select class="form-select" id="style_id" name="items_content_style_id" value="@if (isset($block_settings->items_content_style_id)) {{ $block_settings->items_content_style_id }} @else #fbf7f0 @endif">
            <option value="">-- {{ __('select style') }} --</option>
            @foreach ($styles as $style)
                <option @if (($block_settings->items_content_style_id ?? null) == $style->id) selected @endif value="{{ $style->id }}">{{ $style->label }}</option>
            @endforeach
        </select>
        @if (count($styles) == 0)
            <div class="small text-info mt-1">{{ __("You don't have custom styles created") }}</div>
        @endif
        <label class="mt-1">[<a class="fw-bold" target="_blank" href="{{ route('admin.theme-styles.index') }}">{{ __('manage custom styles') }}</a>]</label>
    </div>
</div>



<div class="form-group mb-3">
    <div class="form-check form-switch">
        <input class="form-check-input" type="checkbox" id="use_custom_bg_item_active_title" name="use_custom_bg_item_active_title" @if ($block_settings->bg_color_item_active_title ?? null) checked @endif>
        <label class="form-check-label" for="use_custom_bg_item_active_title">{{ __('Use custom background color for accordion items title (active item)') }}</label>
    </div>
</div>

<script>
    $('#use_custom_bg_item_active_title').change(function() {
        select = $(this).prop('checked');
        if (select)
            document.getElementById('hidden_div_item_active_title_bg').style.display = 'block';
        else
            document.getElementById('hidden_div_item_active_title_bg').style.display = 'none';
    })
</script>

<div id="hidden_div_item_active_title_bg" style="display: @if (isset($block_settings->bg_color_item_active_title)) block @else none @endif" class="mt-2">
    <div class="form-group">
        <input class="form-control form-control-color" id="bg_color_item_active_title" name="bg_color_item_active_title" value="@if (isset($block_settings->bg_color_item_active_title)) {{ $block_settings->bg_color_item_active_title }} @else #ffffff @endif">
        <label>{{ __('Title background color for active item') }}</label>
        <script>
            $('#bg_color_item_active_title').spectrum({
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
