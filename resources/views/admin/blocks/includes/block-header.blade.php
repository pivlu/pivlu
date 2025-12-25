@php
    $block_header = json_decode($lang_content->header);
@endphp

<div class="form-group mb-0">
    <div class="form-check form-switch">
        <input class="form-check-input" type="checkbox" id="add_header_{{ $lang_content->lang_id }}" name="add_header_{{ $lang_content->lang_id }}" @if ($block_header->add_header ?? null) checked @endif>
        <label class="form-check-label" for="add_header_{{ $lang_content->lang_id }}">{{ __('Add header content') }}</label>
    </div>
</div>

<script>
    $('#add_header_{{ $lang_content->lang_id }}').change(function() {
        select = $(this).prop('checked');
        if (select)
            document.getElementById('hidden_div_header_{{ $lang_content->lang_id }}').style.display = 'block';
        else
            document.getElementById('hidden_div_header_{{ $lang_content->lang_id }}').style.display = 'none';
    })
</script>

<div id="hidden_div_header_{{ $lang_content->lang_id }}" style="display: @if ($block_header->add_header ?? null) block @else none @endif" class="mt-2">
    <div class="form-group">
        <label>{{ __('Header title') }}</label>
        <input class="form-control" name="header_title_{{ $lang_content->lang_id }}" value="{{ $block_header->title ?? null }}">
    </div>
    <div class="form-group">
        <label>{{ __('Header content') }}</label>
        <textarea class="form-control trumbowyg" name="header_content_{{ $lang_content->lang_id }}">{{ $block_header->content ?? null }}</textarea>
    </div>
</div>
