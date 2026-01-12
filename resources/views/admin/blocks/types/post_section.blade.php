<h5 class="mb-3">{{ __('Section settings') }}:</h5>

@foreach ($content_langs as $lang_content)    

    <div class="form-group">
        <label>{!! lang_label($lang_content, __('Section title')) !!}</label>
        <input class="form-control" type="text" name="title_{{ $lang_content->lang_id }}" value="{{ $lang_content->data->title ?? null }}">
    </div>

    <div class="form-group">
        <label>{!! lang_label($lang_content, __('URL slug')) !!}</label>
        <input class="form-control" type="text" name="slug_{{ $lang_content->id }}" value="{{ $lang_content->data->slug ?? null }}">
    </div>

    <div class="mb-4"></div>

    @if (count($content_langs) > 1 && !$loop->last)
        <hr>
    @endif
@endforeach
