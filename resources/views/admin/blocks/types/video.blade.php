<div class="form-group col-xl-2 col-md-3 col-sm-4 mb-3">
    <div class="form-check form-switch">
        <input class="form-check-input" type="checkbox" id="full_width_responsive" name="full_width_responsive" @if ($block_settings->full_width_responsive ?? null) checked @endif>
        <label class="form-check-label" for="full_width_responsive">{{ __('Force video full width and responsive') }}</label>
    </div>
</div>


@foreach ($block->all_languages_contents as $lang_content)
   <div class="fw-bold mb-2">{!! lang_label($lang_content, __('Block content')) !!}</div>

    @include('pivlu::admin.blocks.includes.block-header')   

    <div class="form-group">
        <label>{{ __('Insert video embed code') }}</label>
        <textarea class="form-control" rows="6" name="embed_{{ $lang_content->lang_id }}">{{ $lang_content->data->embed ?? null }}</textarea>
    </div>

    <div class="form-group">
        <label>{{ __('Caption') }} ({{ __('optional') }})</label>
        <input class="form-control" type="text" name="caption_{{ $lang_content->lang_id }}" value="{{ $lang_content->data->caption ?? null }}">
    </div>

    <div class="mb-4"></div>

    @if (count(admin_languages()) > 1 && !$loop->last)
        <hr>
    @endif
@endforeach
