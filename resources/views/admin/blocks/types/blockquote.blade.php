<div class="form-group mb-3">
    <div class="form-check form-switch">
        <input class="form-check-input" type="checkbox" id="shadow" name="shadow" @if ($block_settings->shadow ?? null) checked @endif>
        <label class="form-check-label" for="shadow">{{ __('Add shadow to blockquote') }}</label>
    </div>
</div>


<div class="form-group mb-3">
    <div class="form-check form-switch">
        <input class="form-check-input" type="checkbox" id="use_avatar" name="use_avatar" @if ($block_settings->use_avatar ?? null) checked @endif>
        <label class="form-check-label" for="use_avatar">{{ __('Add avatar image') }}</label>
    </div>
</div>

<script>
    $('#use_avatar').change(function() {
        select = $(this).prop('checked');
        if (select)
            document.getElementById('hidden_div_avatar').style.display = 'block';
        else
            document.getElementById('hidden_div_avatar').style.display = 'none';
    })
</script>

<div id="hidden_div_avatar" style="display: @if ($block_settings->use_avatar ?? null) block @else none @endif">
    <div class="form-group mb-3">
        <label for="formFile" class="form-label">{{ __('Source avatar') }} ({{ __('optional') }})</label>
        <input class="form-control" type="file" id="formFile" name="avatar_media_id">
    </div>
    @if ($block->media_id ?? null)
        <div class="mb-3">
            <a target="_blank" href="{{ first_media_url($block, 'block_media', 'large') }}"><img style="max-width: 300px; max-height: 100px;" src="{{ first_media_url($block, 'block_media', 'thumb') }}" class="img-fluid"></a>
            <input type="hidden" name="existing_avatar_media_id" value="{{ $block->media_id ?? null }}">
        </div>
    @endif
</div>


@foreach ($block->all_languages_contents as $lang_content)

<div class="fw-bold mb-2">{!! lang_label($lang_content, __('Block content')) !!}</div>

    <div class="form-group">
        <label>{{ __('Source') }} ({{ __('optional') }})</label>
        <input class="form-control" type="text" name="source_{{ $lang_content->lang_id }}" value="{{ $lang_content->data->source ?? null }}">
    </div>

    <div class="form-group">
        <label>{{ __('Content') }}</label>
        <textarea class="form-control" name="content_{{ $lang_content->lang_id }}">{{ $lang_content->data->content ?? null }}</textarea>
        <div class="form-text">{{ __('HTML tags allowed') }}</div>
    </div>

    <div class="mb-4"></div>

@endforeach
