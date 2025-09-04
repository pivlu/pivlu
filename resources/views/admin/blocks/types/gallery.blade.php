<div class="form-group col-md-4 col-xl-3">
    <label>{{ __('Select gallery') }} [<a target="_blank" href="{{ route('admin.block-components.type', ['type' => 'gallery']) }}"><b>{{ __('Manage galleries') }}</b></a>]</label>
    @if (count($components_gallery) == 0)
        <div class="text-danger">{{ __("You don't have any gallery. Go to block compobents to create a new gallery") }}</div>
    @endif
    <select class="form-select" name="gallery_id">
        <option value="">-- {{ __('select') }} --</option>
        @foreach ($components_gallery as $gallery)
            <option @if (($block_settings->gallery_id ?? null) == $gallery->id) selected @endif value="{{ $gallery->id }}">{{ $gallery->label }}</option>
        @endforeach
    </select>
</div>


<div id="hidden_div_cols" style="display: @if (isset($block_settings->masonry_layout)) none @else block @endif" class="mt-1">
    <div class="form-group col-md-4 col-xl-3">
        <label>{{ __('Select columns (number of images per row)') }}</label>
        <select class="form-select" name="cols">
            <option @if (($block_settings->cols ?? null) == 2) selected @endif value="2">2</option>
            <option @if (($block_settings->cols ?? null) == 3) selected @endif value="3">3</option>
            <option @if (($block_settings->cols ?? null) == 4 || is_null($block_settings->cols ?? null)) selected @endif value="4">4</option>
            <option @if (($block_settings->cols ?? null) == 6) selected @endif value="6">6</option>
        </select>
        <div class="form-text">{{ __('This is the maximum number of images per row for larger displays. For smaller displays, the columns are resized automatically.') }}</div>
    </div>
</div>

<div class="form-group mb-3">
    <div class="form-check form-switch">
        <input class="form-check-input" type="checkbox" id="masonry_layout" name="masonry_layout" @if ($block_settings->masonry_layout ?? null) checked @endif>
        <label class="form-check-label" for="masonry_layout">{{ __('Use Masonry to arange images') }}</label>
    </div>
    <div class="text-muted">{{ __('It works by placing elements in optimal position based on available vertical space.') }}</div>
    <div class="text-muted">{{ __('This option works fine if you have many images (multiple lines). Note: caption text is not displayed') }}</div>
</div>

<script>
    $('#masonry_layout').change(function() {
        select = $(this).prop('checked');
        if (select) {
            document.getElementById('hidden_div_masonry').style.display = 'block';
            document.getElementById('hidden_div_cols').style.display = 'none';
        } else {
            document.getElementById('hidden_div_masonry').style.display = 'none';
            document.getElementById('hidden_div_cols').style.display = 'block';
        }
    })
</script>

<div id="hidden_div_masonry" style="display: @if (isset($block_settings->masonry_layout)) block @else none @endif" class="mt-1">
    <div class="form-group col-md-4 col-xl-3">
        <label>{{ __('Select columns (number of images per row)') }}</label>
        <select class="form-select" name="masonry_cols">
            <option @if (($block_settings->masonry_cols ?? null) == 3) selected @endif value="3">3</option>
            <option @if (($block_settings->masonry_cols ?? null) == 4 || is_null($block_settings->masonry_cols ?? null)) selected @endif value="4">4</option>
            <option @if (($block_settings->masonry_cols ?? null) == 5) selected @endif value="5">5</option>
            <option @if (($block_settings->masonry_cols ?? null) == 6) selected @endif value="6">6</option>
        </select>
        <div class="form-text">{{ __('This is the maximum number of images per row for larger displays. For smaller displays, the columns are resized automatically.') }}</div>
    </div>

    <div class="form-group col-md-4 col-xl-3">
        <label>{{ __('Gutter') }}</label>
        <select class="form-select" name="masonry_gutter">
            <option @if (($block_settings->masonry_gutter ?? null) == 0 || is_null($block_settings->masonry_gutter ?? null)) selected @endif value="0">{{ __('No margin') }}</option>
            <option @if (($block_settings->masonry_gutter ?? null) == 10) selected @endif value="10">{{ __('Small margin') }}</option>
            <option @if (($block_settings->masonry_gutter ?? null) == 30) selected @endif value="30">{{ __('Large margin') }}</option>
        </select>
        <div class="form-text">{{ __('Gutter is the margin between images.') }}</div>
    </div>
</div>
