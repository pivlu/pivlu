<div class="card p-3 bg-light mb-4">
    <div class="form-group mb-3">
        <div class="form-check form-switch">
            <input class="form-check-input" type="checkbox" id="shadow" name="shadow" @if ($block_settings['shadow'] ?? null) checked @endif>
            <label class="form-check-label" for="shadow">{{ __('Add shadow to image') }}</label>
        </div>
    </div>

    <div class="form-group mb-3">
        <div class="form-check form-switch">
            <input class="form-check-input" type="checkbox" id="rounded" name="rounded" @if ($block_settings['rounded'] ?? null) checked @endif>
            <label class="form-check-label" for="rounded">{{ __('Add rounded corners to image') }}</label>
        </div>
    </div>
</div>

<h5 class="mb-3">{{ __('Block content') }}:</h5>

@foreach ($content_langs as $lang)
    @if (count($languages) > 1)
        <h5 class="mb-3">{!! flag($lang->code) !!} {{ $lang->name }}</h5>
    @endif

    @php
        $header_array = unserialize($lang->block_header ?? null);
    @endphp

    <div class="card p-3 bg-light mb-4">
        <div class="form-group mb-0">
            <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" id="add_header_{{ $lang->id }}" name="add_header_{{ $lang->id }}" @if ($header_array['add_header'] ?? null) checked @endif>
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

        <div id="hidden_div_header_{{ $lang->id }}" style="display: @if ($header_array['add_header'] ?? null) block @else none @endif" class="mt-2">
            <div class="form-group">
                <label>{{ __('Header title') }}</label>
                <input class="form-control" name="header_title_{{ $lang->id }}" value="{{ $header_array['title'] ?? null }}">
            </div>
            <div class="form-group">
                <label>{{ __('Header content') }}</label>
                <textarea class="form-control trumbowyg" name="header_content_{{ $lang->id }}">{{ $header_array['content'] ?? null }}</textarea>
            </div>
        </div>
    </div>

    @php
        $content_array = unserialize($lang->block_content ?? null);
    @endphp

    <div class="row">
        <div class="form-group col-md-3 col-sm-6">
            <label for="formFile" class="form-label">{{ __('Change image') }}</label>
            <input class="form-control" type="file" id="formFile" name="image_{{ $lang->id }}">
            <div class="text-muted small">{{ __('Image file. Maximum 5 MB.') }}</div>
            @if ($content_array['media_id'] ?? null)
                <div class="mt-3"></div>
                <a target="_blank" href="{{ image($content_array['media_id']) }}"><img style="max-width: 300px; max-height: 100px;" src="{{ image($content_array['media_id']) }}" class="img-fluid"></a>
                <input type="hidden" name="existing_image_{{ $lang->id }}" value="{{ $content_array['media_id'] ?? null }}">
            @endif
        </div>

        <div class="form-group col-md-3 col-sm-6">
            <label>{{ __('Title (used as "title" and "alt" tag)') }}</label>
            <input class="form-control" type="text" name="title_{{ $lang->id }}" value="{{ $content_array['title'] ?? null }}">
        </div>

        <div class="form-group col-md-3 col-sm-6">
            <label>{{ __('Caption') }} ({{ __('optional') }})</label>
            <input class="form-control" type="text" name="caption_{{ $lang->id }}" value="{{ $content_array['caption'] ?? null }}">
            <div class="text-muted small">{{ __('If set, a caption text will be displayed at the bottom of the image') }}</div>
        </div>

        <div class="form-group col-md-3 col-sm-6">
            <label>{{ __('URL') }} ({{ __('optional') }})</label>
            <input class="form-control" type="text" name="url_{{ $lang->id }}" value="{{ $content_array['url'] ?? null }}">
            <div class="text-muted small">{{ __('If set, you will be redirected to URL when you click on image') }}</div>
        </div>
    </div>

    <div class="mb-4"></div>

    @if (count($languages) > 1 && !$loop->last)
        <hr>
    @endif
@endforeach
