<h5 class="mb-3">{{ __('Block content') }}:</h5>

@foreach ($block->all_languages_contents as $lang_content)
    @if (count(admin_languages()) > 1)
        <div class="fw-bold fs-5">{!! flag($lang_content->lang_code, 'circle') !!} {{ $lang_content->lang_name }}</div>
    @endif

    <div class="form-group">
        <textarea class="trumbowyg" name="content_{{ $lang_content->lang_id }}">{{ $lang_content->content ?? null }}</textarea>
    </div>

    <div class="mb-4"></div>

    @if (count(admin_languages()) > 1 && !$loop->last)
        <hr>
    @endif
@endforeach
