@foreach ($block->all_languages_contents as $lang_content)

    <label>{!! lang_label($lang_content, __('Block content')) !!}</label>

    <div class="form-group">
        <textarea class="trumbowyg" name="content_{{ $lang_content->lang_id }}">{{ $lang_content->data->content ?? null }}</textarea>
    </div>

    <div class="mb-4"></div>
@endforeach
