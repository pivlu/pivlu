<div class="row">
    <div class="form-group col-md-4 col-lg-3 col-xl-3">
        <label>{{ __('Select form') }} [<a target="_blank" href="{{ route('admin.block-components.type', ['type' => 'form']) }}"><b>{{ __('Manage forms') }}</b></a>]</label>
        @if (count($components_form) == 0)
            <div class="text-danger">{{ __("You don't have any form. Go to manage forms to create a new form") }}</div>
        @endif
        <select class="form-select" name="form_id">
            <option value="">-- {{ __('select') }} --</option>
            @foreach ($components_form as $form)
                <option @if (($block_settings->form_id ?? null) == $form->id) selected @endif value="{{ $form->id }}">{{ $form->label }}</option>
            @endforeach
        </select>
    </div>

    <div class="form-group col-md-4 col-lg-3 col-xl-3">
        <label>{{ __('Submit button') }} [<a target="_blank" href="{{ route('admin.theme-buttons.index') }}">{{ __('Manage buttons') }}</a>]</label>
        <select class="form-select" name="button_id">
            @foreach ($buttons as $button)
                <option @if (($block_settings->button_id ?? null) == $button->id) selected @endif value="{{ $button->id }}">{{ $button->label }}</option>
            @endforeach
        </select>
        <div class="form-text">{{ __("If you don't select a button, the default button will be used") }}</div>
    </div>

    <div class="form-group col-md-4 col-lg-3">
        <div class="form-group">
            <label>{{ __('Fields size') }}</label>
            <select class="form-select" name="field_size">
                <option value="">{{ __('Normal') }}</option>
                <option @if (($block_settings->field_size ?? null) == 'sm') selected @endif value="sm">{{ __('Small') }}</option>
                <option @if (($block_settings->field_size ?? null) == 'lg') selected @endif value="lg">{{ __('Large') }}</option>
            </select>
        </div>
    </div>   

    <div class="form-group mt-3">
        <div class="form-check form-switch">
            <input class="form-check-input" type="checkbox" id="SwitchreCAPTCHA" name="recaptcha">
            <label class="form-check-label" for="SwitchreCAPTCHA">{{ __('Enable Google reCAPTCHA antispam') }} </label>
        </div>
    </div>

</div>


<h5 class="mb-3 mt-4">{{ __('Block content') }}:</h5>

@foreach ($content_langs as $lang)    
    @if (count($content_langs) > 1)
        <h5 class="mb-3">{!! flag($lang->code) !!} {{ $lang->name }}</h5>
    @endif

    @php
        $block_header = json_decode($lang->block_header);
        $block_content = json_decode($lang->block_content);
    @endphp

    <div class="form-group mb-0">
        <div class="form-check form-switch">
            <input class="form-check-input" type="checkbox" id="add_header_{{ $lang->id }}" name="add_header_{{ $lang->id }}" @if ($block_header->add_header ?? null) checked @endif>
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

    <div id="hidden_div_header_{{ $lang->id }}" style="display: @if ($block_header->add_header ?? null) block @else none @endif" class="mt-1">
        <div class="form-group">
            <label>{{ __('Header title') }}</label>
            <input class="form-control" name="header_title_{{ $lang->id }}" value="{{ $block_header->title ?? null }}">
        </div>
        <div class="form-group">
            <label>{{ __('Header content') }}</label>
            <textarea class="form-control trumbowyg" name="header_content_{{ $lang->id }}">{{ $block_header->content ?? null }}</textarea>
        </div>
    </div>

    <div class="form-group col-md-3 col-sm-6 mt-2">
        <label>{{ __('Submit button text') }}</label>
        <input class="form-control" type="text" name="button_submit_text_{{ $lang->id }}" value="{{ $block_content->button_submit_text ?? __('Submit') }}">
    </div>


    <div class="mb-4"></div>

    @if (count($content_langs) > 1 && !$loop->last)
        <hr>
    @endif
@endforeach
