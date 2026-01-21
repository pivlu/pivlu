<div class="container-xxl">
    <div class="block">

        @include('pivlu::web.includes.block-header')

        @if ($session_msg = Session::get('success'))
            <div class="alert alert-success my-3">
                @if ($session_msg == 'form_submited')
                    {{ __('Form submitted successfully') }}
                @endif
            </div>
        @endif

        @if ($block_settings->form_id ?? null)
            @php
                $form_fields = block_form_fields($block_settings->form_id);
            @endphp

            <form method="POST" action="{{ route('form.submit', ['id' => $block_settings->form_id]) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <div class="row">
                        @foreach ($form_fields as $field)
                            <div class="col-md-{{ $field->col_md ?? 12 }}">
                                <div class="form-group">
                                    <label class="block-form-label" for="form_field_{{ $field->id }}">{{ $field->label }}</label>

                                    @php
                                        $arrayTypes = explode(',', 'text,email,file,number,month,date,time,datetime-local,color');
                                    @endphp

                                    @if (in_array($field->type, $arrayTypes))
                                        <input id="form_field_{{ $field->id }}" type="{{ $field->type }}"
                                            class="form-control block-form-control @if (($block_settings->field_size ?? null) == 'lg') form-control-lg @endif @if (($block_settings->field_size ?? null) == 'sm') form-control-sm @endif"
                                            name="{{ $field->id }}" @if ($field->required) required @endif @if ($field->type == 'color') style="width: 100px" @endif
                                            @if ($field->type == 'file') accept=".doc,.docx,.xml,.pdf,.txt,.zip,.gz,.rar,application/msword,audio/*,video/*,text/*,image/*" @endif>
                                    @elseif ($field->type == 'textarea')
                                        <textarea id="form_field_{{ $field->id }}" class="form-control block-form-control" rows="4" name="{{ $field->id }}" @if ($field->required) required @endif></textarea>
                                    @elseif ($field->type == 'select')
                                        @php
                                            $field_options_array = explode(PHP_EOL, $field->dropdowns);
                                        @endphp

                                        <select id="form_field_{{ $field->id }}"
                                            class="form-select block-form-control @if ($field->field_size == 'lg') form-control-lg @endif @if ($field->field_size == 'sm') form-control-sm @endif"
                                            name="{{ $field->id }}" @if ($field->required) required @endif>
                                            <option value="">- {{ __('Select') }} -</option>
                                            @foreach ($field_options_array as $field_dropdown_name)
                                                <option value="{{ $field_dropdown_name }}">{{ $field_dropdown_name }}</option>
                                            @endforeach
                                        </select>
                                    @elseif ($field->type == 'checkbox')
                                        @php
                                            $field_options_array = explode(PHP_EOL, $field->dropdowns);
                                        @endphp

                                        @foreach ($field_options_array as $field_dropdown_name)
                                            <div class="form-check mb-2">
                                                <input class="form-check-input" type="checkbox" value="{{ $field_dropdown_name }}" id="check_{{ $field->id }}_{{ $field_dropdown_name }}"
                                                    name="{{ $field->id }}[]" @if ($field->required) required @endif>
                                                <label class="form-check-label fw-normal" for="check_{{ $field->id }}_{{ $field_dropdown_name }}">
                                                    @php
                                                        if (strlen($field_dropdown_name) == 7 && substr($field_dropdown_name, 0, 1) == '#') {
                                                            echo '<i class="bi bi-square-fill fs-3" style="color: ' . $field_dropdown_name . '"></i>';
                                                        } else {
                                                            echo $field_dropdown_name;
                                                        }
                                                    @endphp
                                                </label>
                                            </div>
                                        @endforeach
                                    @endif

                                    @if ($field->info)
                                        <div class="form-text text-muted small">{!! $field->info !!}</div>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <input type="hidden" name="source_lang_id" value="{{ get_active_language()->id ?? null }}">
                <input type="hidden" name="block_id" value="{{ $block->id ?? null }}">
                @if (check_form_have_recaptcha($block_settings->form_id))
                    <input type="hidden" name="recaptcha_response" id="recaptchaResponse">
                @endif

                @if ($block_settings->button_id ?? null)
                    <button type="submit"
                        class="btn btn_{{ $block_settings->button_id ?? ' btn-primary' }} {{ button($block_settings->button_id)->font_weight ?? null }} {{ button($block_settings->button_id)->rounded ?? null }} {{ button($block_settings->button_id)->shadow ?? null }} {{ button($block_settings->button_id)->size ?? null }}">{{ $block_content->submit_btn_text ?? __('Submit') }}</button>
                @else
                    <button type="submit" class="btn btn-primary">{{ $block_content->submit_btn_text ?? __('Submit') }}
                @endif

            </form>
        @endif

    </div>
</div>
