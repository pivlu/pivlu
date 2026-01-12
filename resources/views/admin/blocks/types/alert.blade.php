<div class="form-group col-xl-2 col-lg-3 col-md-4">
    <label>{{ __('Alert type') }}</label>
    <select class="form-select" name="alert_type">
        <option @if (($block_settings->type ?? null) == 'primary') selected @endif value="primary">{{ __('Note (info)') }}</option>
        <option @if (($block_settings->type ?? null) == 'success') selected @endif value="success">{{ __('Success') }}</option>
        <option @if (($block_settings->type ?? null) == 'danger') selected @endif value="danger">{{ __('Danger') }}</option>
        <option @if (($block_settings->type ?? null) == 'warning') selected @endif value="warning">{{ __('Warning') }}</option>
        <option @if (($block_settings->type ?? null) == 'light') selected @endif value="light">{{ __('Light') }}</option>
    </select>
</div>


@foreach ($block->all_languages_contents as $lang_content)

    <div class="fw-bold mb-2">{!! lang_label($lang_content, __('Block content')) !!}</div>   

    <div class="form-group">
        <label>{{ __('Title') }} ({{ __('optional') }})</label>
        <input class="form-control" type="text" name="title_{{ $lang_content->lang_id }}" value="{{ $lang_content->data->title ?? null }}">
    </div>

    <div class="form-group">
        <label>{{ __('Content') }}</label>
        <textarea class="form-control trumbowyg" name="content_{{ $lang_content->lang_id }}">{{ $lang_content->data->content ?? null }}</textarea>
    </div>

    <div class="mb-4"></div>    
@endforeach
