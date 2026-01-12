<div class="row">
    <div class="form-group col-md-4 col-lg-3">
        <label>{{ __('Select form') }} [<a target="_blank" href="{{ route('admin.forms.config') }}"><b>{{ __('Manage forms') }}</b></a>]</label>
        @if (count($forms) == 0)
            <div class="text-danger">{{ __("You don't have any form. Go to manage forms to create a new form") }}</div>
        @endif
        <select class="form-select" name="form_id">
            <option value="">-- {{ __('select') }} --</option>
            @foreach ($forms as $form)
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


@foreach ($block->all_languages_contents as $lang_content)
    <div class="fw-bold mb-2">{!! lang_label($lang_content, __('Block content')) !!}</div>

    @include('pivlu::admin.blocks.includes.block-header')

    <div class="form-group col-md-3 col-sm-6 mt-2">
        <label>{{ __('Submit button text') }}</label>
        <input class="form-control" type="text" name="button_submit_text_{{ $lang_content->lang_id }}" value="{{ $lang_content->data->button_submit_text ?? __('Submit') }}">
    </div>

    <div class="mb-4"></div>

    @if (count(admin_languages()) > 1 && !$loop->last)
        <hr>
    @endif
@endforeach
