<div class="form-group col-md-4 col-xl-3">
    <label>{{ __('Select gallery') }}</label>
    @if (count($components_gallery) == 0)
        <div class="text-danger mb-2">
            {{ __("You don't have any gallery. Go to block compoents to create a new gallery") }}
            <br>
            <a target="_blank" href="{{ route('admin.block-components.type', ['type' => 'gallery']) }}"><i class="bi bi-images"></i> {{ __('Add new gallery') }}</a>
            <a class="ms-2" onclick="location.reload();" href="#"><i class="bi bi-arrow-clockwise"></i> {{ __('Refresh page') }}</a>
        </div>
    @else
        <div class="mb-2">
            <a target="_blank" href="{{ route('admin.block-components.type', ['type' => 'gallery']) }}"><i class="bi bi-images"></i> {{ __('Add new gallery') }}</a>
            <a class="ms-2" onclick="location.reload();" href="#"><i class="bi bi-arrow-clockwise"></i> {{ __('Refresh page') }}</a>
        </div>
        <select class="form-select" name="gallery_id">
            <option value="">-- {{ __('select') }} --</option>
            @foreach ($components_gallery as $gallery)
                <option @if (($block_settings->gallery_id ?? null) == $gallery->id) selected @endif value="{{ $gallery->id }}">{{ $gallery->label }}</option>
            @endforeach
        </select>
    @endif
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

<div class="form-group mb-3">
    <div class="form-check form-switch">
        <input class="form-check-input" type="checkbox" id="shadow" name="shadow" @if ($block_settings->shadow ?? null) checked @endif>
        <label class="form-check-label" for="shadow">{{ __('Add shadow to images') }}</label>
    </div>
</div>

<div class="form-group mb-3">
    <div class="form-check form-switch">
        <input class="form-check-input" type="checkbox" id="rounded" name="rounded" @if ($block_settings->rounded ?? null) checked @endif>
        <label class="form-check-label" for="rounded">{{ __('Add rounded border to images') }}</label>
    </div>
</div>


@foreach ($content_langs as $lang)
    @if (count($content_langs) > 1)
        <h5 class="mb-3">{!! flag($lang->code) !!} {{ $lang->name }}</h5>
    @endif

    @php
        $block_header = json_decode($lang->block_header);
        $block_content = json_decode($lang->block_content);
    @endphp

    <div class="form-group mb-0">
        <div class="form-check form-switch">
            <input class="form-check-input" type="checkbox" id="add_header_{{ $lang->id }}" name="add_header_{{ $lang->id }}" @if ($block_header->add_header ?? null) checked @endif>
            <label class="form-check-label" for="add_header_{{ $lang->id }}">{{ __('Add header content') }}</label>
        </div>
    </div>

    <script>
        $('#add_header_{{ $lang->id }}').change(function() {
            select = $(this).prop('checked');
            if (select)
                document.getElementById('hidden_div_header_{{ $lang->id }}').style.display = 'block';
            else
                document.getElementById('hidden_div_header_{{ $lang->id }}').style.display = 'none';
        })
    </script>

    <div id="hidden_div_header_{{ $lang->id }}" style="display: @if ($block_header->add_header ?? null) block @else none @endif" class="mt-1">
        <div class="form-group">
            <label>{{ __('Header title') }}</label>
            <input class="form-control" name="header_title_{{ $lang->id }}" value="{{ $block_header->title ?? null }}">
        </div>
        <div class="form-group">
            <label>{{ __('Header content') }}</label>
            <textarea class="form-control trumbowyg" name="header_content_{{ $lang->id }}">{{ $block_header->content ?? null }}</textarea>
        </div>
    </div>

    <div class="mb-4"></div>

    @if (count($content_langs) > 1 && !$loop->last)
        <hr>
    @endif
@endforeach
