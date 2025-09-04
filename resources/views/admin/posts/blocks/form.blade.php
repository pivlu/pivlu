<div class="form-group">
    <div class="form-check form-switch">
        <input class="form-check-input" type="checkbox" id="use_custom_bg" name="use_custom_bg" @if ($block_settings['bg_color'] ?? null) checked @endif>
        <label class="form-check-label" for="use_custom_bg">{{ __('Use custom background color for this section') }}</label>
        <div class="form-text">{{ __('This is the color of the section row (full width). If disabled, default website background color will be used.') }}</div>
    </div>
</div>

<script>
    $('#use_custom_bg').change(function() {
        select = $(this).prop('checked');
        if (select)
            document.getElementById('hidden_div_color').style.display = 'block';
        else
            document.getElementById('hidden_div_color').style.display = 'none';
    })
</script>

<div id="hidden_div_color" style="display: @if (isset($block_settings['bg_color'])) block @else none @endif" class="mt-1">
    <div class="form-group">
        <input class="form-control form-control-color" id="bg_color" name="bg_color" value="@if (isset($block_settings['bg_color'])) {{ $block_settings['bg_color'] }} @else #fbf7f0 @endif">
        <label>{{ __('Background color') }}</label>
        <script>
            $('#bg_color').spectrum({
                type: "color",
                showInput: true,
                showInitial: true,
                showAlpha: false,
                showButtons: false,
                allowEmpty: false,
            });
        </script>
    </div>
</div>

<hr>

<div class="row">
    <div class="form-group col-md-4 col-lg-3 col-xl-3">
        <label>{{ __('Select form') }} [<a target="_blank" href="{{ route('admin.forms.config') }}"><b>{{ __('Manage forms') }}</b></a>]</label>
        @if (count($forms) == 0)
        <div class="text-danger">{{ __("You don't have any form. Go to manage forms to create a new form") }}</div>
        @endif
        <select class="form-select" name="form_id">
            <option value="">-- {{ __('select') }} --</option>
            @foreach ($forms as $form)
            <option @if (($block_settings['form_id'] ?? null)==$form->id) selected @endif value="{{ $form->id }}">{{ $form->label }}</option>
            @endforeach
        </select>
    </div>

    <div class="form-group col-md-4 col-lg-3 col-xl-3">
        <div class="form-group">
            <label>{{ __('Submit button') }} [<a target="_blank" href="{{ route('admin.theme-buttons.index') }}">{{ __('Manage buttons') }}</a>]</label>
            <select class="form-select" name="button_id">
                @foreach ($buttons as $button)
                <option @if (($content_array['button_id'] ?? null)==$button->id) selected @endif value="{{ $button->id }}">{{ $button->label }}</option>
                @endforeach
            </select>

            <div class="form-text">{{ __("If you don't select a button, the default button will be used") }}</div>
        </div>
    </div>
</div>


<h5 class="mb-3 mt-4">{{ __('Block content') }}:</h5>

@foreach ($content_langs as $lang)
@if (count($content_langs) > 1)
<h5 class="mb-3">{!! flag($lang->code) !!} {{ $lang->name }}</h5>
@endif

@php
$header_array = unserialize($lang->block_header);
$content_array = unserialize($lang->block_content);
@endphp

<div class="form-group mb-0">
    <div class="form-check form-switch">
        <input class="form-check-input" type="checkbox" id="add_header_{{ $lang->id }}" name="add_header_{{ $lang->id }}" @if ($header_array['add_header'] ?? null) checked @endif>
        <label class="form-check-label" for="add_header_{{ $lang->id }}">{{ __('Add header content') }}</label>
    </div>
</div>

<script>
    $('#add_header_{{ $lang->id }}').change(function() {
        select = $(this).prop('checked');
        if (select)
            document.getElementById('hidden_div_header_{{ $lang->id }}').style.display = 'block';
        else
            document.getElementById('hidden_div_header_{{ $lang->id }}').style.display = 'none';
    })
</script>

<div id="hidden_div_header_{{ $lang->id }}" style="display: @if ($header_array['add_header'] ?? null) block @else none @endif" class="mt-1">
    <div class="form-group">
        <label>{{ __('Header title') }}</label>
        <input class="form-control" name="header_title_{{ $lang->id }}" value="{{ $header_array['title'] ?? null }}">
    </div>
    <div class="form-group">
        <label>{{ __('Header content') }}</label>
        <textarea class="form-control trumbowyg" name="header_content_{{ $lang->id }}">{{ $header_array['content'] ?? null }}</textarea>
    </div>
</div>

<div class="form-group col-md-3 col-sm-6 mt-2">
    <label>{{ __('Submit button text') }}</label>
    <input class="form-control" type="text" name="submit_btn_text_{{ $lang->id }}" value="{{ $content_array['submit_btn_text'] ?? __('Submit') }}">
</div>


<div class="mb-4"></div>

@if (count($languages) > 1 && !$loop->last)
<hr>
@endif
@endforeach