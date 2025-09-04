<div class="form-group col-xl-2 col-lg-3 col-md-4">
    <label>{{ __('Alert type') }}</label>
    <select class="form-select" name="alert_type">
        <option @if (($block_settings['type'] ?? null) == 'primary') selected @endif value="primary">{{ __('Note (info)') }}</option>
        <option @if (($block_settings['type'] ?? null) == 'success') selected @endif value="success">{{ __('Success') }}</option>
        <option @if (($block_settings['type'] ?? null) == 'danger') selected @endif value="danger">{{ __('Danger') }}</option>
        <option @if (($block_settings['type'] ?? null) == 'warning') selected @endif value="warning">{{ __('Warning') }}</option>
        <option @if (($block_settings['type'] ?? null) == 'light') selected @endif value="light">{{ __('Light') }}</option>
    </select>
</div>


<h5 class="mb-3">{{ __('Block content') }}:</h5>

@foreach ($content_langs as $lang)
    @if (count($languages) > 1)
        <h5 class="mb-3">{!! flag($lang->code) !!} {{ $lang->name }}</h5>
    @endif

    @php
        $content_array = unserialize($lang->block_content);
    @endphp

    <div class="form-group">
        <label>{{ __('Title') }} ({{ __('optional') }})</label>
        <input class="form-control" type="text" name="title_{{ $lang->id }}" value="{{ $content_array['title'] ?? null }}">
    </div>

    <div class="form-group">
        <label>{{ __('Content') }}</label>
        <textarea class="form-control trumbowyg" name="content_{{ $lang->id }}">{{ $content_array['content'] ?? null }}</textarea>
    </div>

    <div class="mb-4"></div>

    @if (count($languages) > 1 && !$loop->last)
        <hr>
    @endif
@endforeach
