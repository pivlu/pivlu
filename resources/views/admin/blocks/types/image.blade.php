<div class="form-group mb-3">
    <div class="form-check form-switch">
        <input class="form-check-input" type="checkbox" id="shadow" name="shadow" @if ($block_settings->shadow ?? null) checked @endif>
        <label class="form-check-label" for="shadow">{{ __('Add shadow to image') }}</label>
    </div>
</div>

<div class="form-group mb-3">
    <div class="form-check form-switch">
        <input class="form-check-input" type="checkbox" id="rounded" name="rounded" @if ($block_settings->rounded ?? null) checked @endif>
        <label class="form-check-label" for="rounded">{{ __('Add rounded corners to image') }}</label>
    </div>
</div>

<h5 class="mb-3">{{ __('Block content') }}:</h5>

@foreach ($block->all_languages_contents as $lang_content)
    @if (count(admin_languages()) > 1)
        <div class="fw-bold fs-5">{!! flag($lang_content->lang_code, 'circle') !!} {{ $lang_content->lang_name }}</div>
    @endif

    @php
        $block_content = json_decode($lang_content->content);
        $block_header = json_decode($lang_content->header);
    @endphp

    <div class="form-group mb-0">
        <div class="form-check form-switch">
            <input class="form-check-input" type="checkbox" id="add_header_{{ $lang_content->lang_id }}" name="add_header_{{ $lang_content->lang_id }}" @if ($block_header->add_header ?? null) checked @endif>
            <label class="form-check-label" for="add_header_{{ $lang_content->lang_id }}">{{ __('Add header content') }}</label>
        </div>
    </div>

    <script>
        $('#add_header_{{ $lang_content->lang_id }}').change(function() {
            select = $(this).prop('checked');
            if (select)
                document.getElementById('hidden_div_header_{{ $lang_content->lang_id }}').style.display = 'block';
            else
                document.getElementById('hidden_div_header_{{ $lang_content->lang_id }}').style.display = 'none';
        })
    </script>

    <div id="hidden_div_header_{{ $lang_content->lang_id }}" style="display: @if ($block_header->add_header ?? null) block @else none @endif" class="mt-2">
        <div class="form-group">
            <label>{{ __('Header title') }}</label>
            <input class="form-control" name="header_title_{{ $lang_content->lang_id }}" value="{{ $block_header->title ?? null }}">
        </div>
        <div class="form-group">
            <label>{{ __('Header content') }}</label>
            <textarea class="form-control trumbowyg" name="header_content_{{ $lang_content->lang_id }}">{{ $block_header->content ?? null }}</textarea>
        </div>
    </div>


    <div class="row">
        <div class="form-group col-md-3 col-sm-6">
            <label for="formFile" class="form-label">{{ __('Change image') }}</label>
            <input class="form-control" type="file" id="formFile" name="image_{{ $lang_content->lang_id }}">
            <div class="text-muted small">{{ __('Image file. Maximum 5 MB.') }}</div>
            @if ($block_content->media_id ?? null)
                <div class="mt-3"></div>
                <a target="_blank" href="{{ image($block_content->media_id) }}"><img style="max-width: 300px; max-height: 100px;" src="{{ image($block_content->media_id) }}" class="img-fluid"></a>
                <input type="hidden" name="existing_image_{{ $lang_content->lang_id }}" value="{{ $block_content->media_id ?? null }}">
            @endif
        </div>

        <div class="form-group col-md-3 col-sm-6">
            <label>{{ __('Title (used as "title" and "alt" tag)') }}</label>
            <input class="form-control" type="text" name="title_{{ $lang_content->lang_id }}" value="{{ $block_content->title ?? null }}">
        </div>

        <div class="form-group col-md-3 col-sm-6">
            <label>{{ __('Caption') }} ({{ __('optional') }})</label>
            <input class="form-control" type="text" name="caption_{{ $lang_content->lang_id }}" value="{{ $block_content->caption ?? null }}">
            <div class="text-muted small">{{ __('If set, a caption text will be displayed at the bottom of the image') }}</div>
        </div>

        <div class="form-group col-md-3 col-sm-6">
            <label>{{ __('URL') }} ({{ __('optional') }})</label>
            <input class="form-control" type="text" name="url_{{ $lang_content->lang_id }}" value="{{ $block_content->url ?? null }}">
            <div class="text-muted small">{{ __('If set, you will be redirected to URL when you click on image') }}</div>
        </div>
    </div>

    <div class="mb-4"></div>

    @if (count(admin_languages()) > 1 && !$loop->last)
        <hr>
    @endif
@endforeach
