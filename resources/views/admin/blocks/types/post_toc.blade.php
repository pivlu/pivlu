<div class="col-md-3 col-12">
    <div class="form-group">
        <label>{{ __('Block align') }}</label>
        <select class="form-select" name="block_align">
            <option @if (($block_settings->block_align ?? null) == 'row') selected @endif value="d-block">{{ __('New row') }}</option>
            <option @if (($block_settings->block_align ?? null) == 'float-end') selected @endif value="float-end">{{ __('Float at the end of article') }}</option>
            <option @if (($block_settings->block_align ?? null) == 'float-start') selected @endif value="float-start">{{ __('Float at the start of article') }}</option>
        </select>        
    </div>
</div>


<h5 class="mb-3">{{ __('Table of contents settings') }}:</h5>

@foreach ($content_langs as $lang)
    @if (count($languages) > 1)
        <h5 class="mb-3">{!! flag($lang->code) !!} {{ $lang->name }}</h5>
    @endif

    @php
        $block_content = json_decode($lang->block_content);
    @endphp

    <div class="form-group">
        <label>{{ __('Title') }}</label>
        <input class="form-control" type="text" name="title_{{ $lang->id }}" value="{{ $block_content->title ?? null }}">
    </div>

    <div class="mb-4"></div>

    @if (count($content_langs) > 1 && !$loop->last)
        <hr>
    @endif
@endforeach
