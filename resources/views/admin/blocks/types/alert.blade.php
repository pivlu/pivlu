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


<h5 class="mb-3">{{ __('Block content') }}:</h5>

@foreach ($block->all_languages_contents as $lang_content)
    @if (count(admin_languages()) > 1)
        <div class="fw-bold fs-5">{!! flag($lang_content->lang_code, 'circle') !!} {{ $lang_content->lang_name }}</div>
    @endif

    @php
        $block_content = json_decode($lang_content->content);
    @endphp

    <div class="form-group">
        <label>{{ __('Title') }} ({{ __('optional') }})</label>
        <input class="form-control" type="text" name="title_{{ $lang_content->lang_id }}" value="{{ $block_content->title ?? null }}">
    </div>

    <div class="form-group">
        <label>{{ __('Content') }}</label>
        <textarea class="form-control trumbowyg" name="content_{{ $lang_content->lang_id }}">{{ $block_content->content ?? null }}</textarea>
    </div>

    <div class="mb-4"></div>

    @if (count(admin_languages()) > 1 && !$loop->last)
        <hr>
    @endif
@endforeach
