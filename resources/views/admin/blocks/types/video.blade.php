<div class="form-group col-xl-2 col-md-3 col-sm-4 mb-3">
    <div class="form-check form-switch">
        <input class="form-check-input" type="checkbox" id="full_width_responsive" name="full_width_responsive" @if ($block_extra['full_width_responsive'] ?? null) checked @endif>
        <label class="form-check-label" for="full_width_responsive">{{ __('Force video full width and responsive') }}</label>
    </div>
</div>

<h5 class="mb-3">{{ __('Block content') }}:</h5>

@foreach ($block->all_languages_contents as $lang_content)
    @if (count(admin_languages()) > 1)
        <div class="fw-bold fs-5">{!! flag($lang_content->lang_code, 'circle') !!} {{ $lang_content->lang_name }}</div>
    @endif

    @include('pivlu::admin.blocks.includes.block-header')

    @php
        $block_content = json_decode($lang_content->content);
    @endphp

    <div class="form-group">
        <label>{{ __('Insert video embed code') }}</label>
        <textarea class="form-control" rows="6" name="embed_{{ $lang_content->lang_id }}">{{ $block_content->embed ?? null }}</textarea>
    </div>

    <div class="form-group">
        <label>{{ __('Caption') }} ({{ __('optional') }})</label>
        <input class="form-control" type="text" name="caption_{{ $lang_content->lang_id }}" value="{{ $block_content->caption ?? null }}">
    </div>

    <div class="mb-4"></div>

    @if (count(admin_languages()) > 1 && !$loop->last)
        <hr>
    @endif
@endforeach
