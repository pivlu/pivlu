<div class="form-group mb-3">
    <div class="form-check form-switch">
        <input class="form-check-input" type="checkbox" id="shadow" name="shadow" @if ($block_settings->shadow ?? null) checked @endif>
        <label class="form-check-label" for="shadow">{{ __('Add shadow to image') }}</label>
    </div>
</div>

<div class="form-group mb-4">
    <div class="form-check form-switch">
        <input class="form-check-input" type="checkbox" id="rounded" name="rounded" @if ($block_settings->rounded ?? null) checked @endif>
        <label class="form-check-label" for="rounded">{{ __('Add rounded corners to image') }}</label>
    </div>
</div>

@foreach ($block->all_languages_contents as $lang_content)
    <div class="fw-bold mb-2">{!! lang_label($lang_content, __('Block content')) !!}</div>

    @include('pivlu::admin.blocks.includes.block-header')

    <div class="row">
        <div class="form-group col-md-6">
            <label for="formFile" class="form-label">{{ __('Change image') }}</label>
            <input class="form-control" type="file" id="formFile" name="image_{{ $lang_content->lang_id }}">
            <div class="text-muted small">{{ __('Image file. Maximum 5 MB.') }}</div>
            @if ($lang_content->media_id ?? null)
                <div class="mt-1 mb-1">
                    <a target="_blank" href="{{ first_media_url(block_content($block->id, $lang_content->lang_id), 'block_content_media', 'large') }}">
                        <img style="max-width: 300px; max-height: 100px;" src="{{ first_media_url(block_content($block->id, $lang_content->lang_id), 'block_content_media', 'thumb') }}" class="img-fluid">
                    </a>
                </div>
                <input type="hidden" name="existing_image_{{ $lang_content->lang_id }}" value="{{$lang_content->media_id ?? null }}">
            @endif
        </div>

        <div class="form-group col-md-6">
            <label>{{ __('Title (used as "title" and "alt" tag)') }}</label>
            <input class="form-control" type="text" name="title_{{ $lang_content->lang_id }}" value="{{ $lang_content->data->title ?? null }}">
        </div>

        <div class="form-group col-md-6">
            <label>{{ __('Caption') }} ({{ __('optional') }})</label>
            <input class="form-control" type="text" name="caption_{{ $lang_content->lang_id }}" value="{{ $lang_content->data->caption ?? null }}">
            <div class="text-muted small">{{ __('If set, a caption text will be displayed at the bottom of the image') }}</div>
        </div>

        <div class="form-group col-md-6">
            <label>{{ __('URL') }} ({{ __('optional') }})</label>
            <input class="form-control" type="text" name="url_{{ $lang_content->lang_id }}" value="{{ $lang_content->data->url ?? null }}">
            <div class="text-muted small">{{ __('If set, you will be redirected to URL when you click on image') }}</div>
        </div>
    </div>

    <div class="mb-4"></div>

    @if (count(admin_languages()) > 1 && !$loop->last)
        <hr>
    @endif
@endforeach

