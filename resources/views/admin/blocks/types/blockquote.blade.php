<div class="form-group mb-3">
    <div class="form-check form-switch">
        <input class="form-check-input" type="checkbox" id="shadow" name="shadow" @if ($block_extra['shadow'] ?? null) checked @endif>
        <label class="form-check-label" for="shadow">{{ __('Add shadow to blockquote') }}</label>
    </div>
</div>


<div class="form-group mb-3">
    <div class="form-check form-switch">
        <input class="form-check-input" type="checkbox" id="use_avatar" name="use_avatar" @if ($block_extra['use_avatar'] ?? null) checked @endif>
        <label class="form-check-label" for="use_avatar">{{ __('Add avatar image') }}</label>
    </div>
</div>

<script>
    $('#use_avatar').change(function() {
        select = $(this).prop('checked');
        if (select)
            document.getElementById('hidden_div_avatar').style.display = 'block';
        else
            document.getElementById('hidden_div_avatar').style.display = 'none';
    })
</script>

<div id="hidden_div_avatar" style="display: @if ($block_extra['use_avatar'] ?? null) block @else none @endif">
    <div class="form-group mb-3">
        <label for="formFile" class="form-label">{{ __('Source avatar') }} ({{ __('optional') }})</label>
        <input class="form-control" type="file" id="formFile" name="avatar">
    </div>
    @if ($block_extra['avatar'] ?? null)
        <div class="mb-3">
            <a target="_blank" href="{{ image($block_extra['avatar']) }}"><img style="max-width: 300px; max-height: 100px;" src="{{ image($block_extra['avatar']) }}" class="img-fluid"></a>
            <input type="hidden" name="existing_avatar" value="{{ $block_extra['avatar'] ?? null }}">
        </div>
    @endif
</div>


<div class="form-group mb-0">
    <div class="form-check form-switch">
        <input class="form-check-input" type="checkbox" id="use_custom_style" name="use_custom_style" @if ($block_extra['style_id'] ?? null) checked @endif>
        <label class="form-check-label" for="use_custom_style">{{ __('Use custom style for this section') }}</label>
    </div>
</div>

<script>
    $('#use_custom_style').change(function() {
        select = $(this).prop('checked');
        if (select)
            document.getElementById('hidden_div_style').style.display = 'block';
        else
            document.getElementById('hidden_div_style').style.display = 'none';
    })
</script>

<div id="hidden_div_style" style="display: @if (isset($block_extra['style_id'])) block @else none @endif" class="mt-2">
    <div class="form-group col-xl-3 col-lg-4 col-md-6 mb-0">
        <label>{{ __('Select custom style') }} [<a class="fw-bold" target="_blank" href="{{ route('admin.template.styles') }}">{{ __('manage custom styles') }}</a>]</label>
        <select class="form-select" id="style_id" name="style_id" value="@if (isset($block_extra['style_id'])) {{ $block_extra['style_id'] }} @else #fbf7f0 @endif">
            <option value="">-- {{ __('select') }} --</option>
            @foreach ($styles as $style)
                <option @if (($block_extra['style_id'] ?? null) == $style->id) selected @endif value="{{ $style->id }}">{{ $style->label }}</option>
            @endforeach
        </select>
        @if (count($styles) == 0)
            <div class="small text-info mt-1">{{ __("You don't have custom styles created") }}</div>
        @endif
    </div>
</div>
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
        <label>{{ __('Source') }} ({{ __('optional') }})</label>
        <input class="form-control" type="text" name="source_{{ $lang->id }}" value="{{ $content_array['source'] ?? null }}">
    </div>

    <div class="form-group">
        <label>{{ __('Content') }}</label>
        <textarea class="form-control" name="content_{{ $lang->id }}">{{ $content_array['content'] ?? null }}</textarea>
        <div class="form-text">{{ __('HTML tags allowed') }}</div>
    </div>

    <div class="mb-4"></div>

    @if (count($languages) > 1 && !$loop->last)
        <hr>
    @endif
@endforeach
