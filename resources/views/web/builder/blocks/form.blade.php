@php
    $block_data = block($block['id']);

    $block_header = unserialize($block_data->header ?? null);
    $block_content = unserialize($block_data->content ?? null);
@endphp

<div class="container-xxl">
    <div class="block">

        @if ($block_header['add_header'] ?? null)
            <div class="block-header">
                @if ($block_header['title'] ?? null)
                    <div class="block-header-title title">
                        {{ $block_header['title'] ?? null }}
                    </div>
                @endif

                @if ($block_header['content'] ?? null)
                    <div class="block-header-content mt-4">
                        {!! $block_header['content'] ?? null !!}
                    </div>
                @endif
            </div>
        @endif

        @if ($session_msg = Session::get('success'))
            <div class="alert alert-success my-3">
                @if ($session_msg == 'form_submited')
                    {{ __('Form submitted successfully') }}
                @endif
            </div>
        @endif

        @if ($block_extra['form_id'] ?? null)
            @php
                $form_fields = form($block_extra['form_id']);
            @endphp

            <form method="POST" action="{{ route('form.submit', ['id' => $block_extra['form_id'], 'lang' => $lang]) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <div class="row">
                        @foreach ($form_fields as $field)
                            <div class="col-md-{{ $field['col_md'] ?? 12 }}">
                                <div class="form-group">
                                    <label class="block-form-label">{{ $field['label'] }}</label>

                                    @php
                                        $arrayTypes = explode(',', 'text,email,file,number,month,date,time,datetime-local,color');
                                    @endphp

                                    @if (in_array($field['type'], $arrayTypes))
                                        <input type="{{ $field['type'] }}"
                                            class="form-control block-form-control @if ($field['field_size'] == 'lg') form-control-lg @endif @if ($field['field_size'] == 'sm') form-control-sm @endif"
                                            name="{{ $field['id'] }}" @if ($field['required']) required @endif @if ($field['type'] == 'color') style="width: 100px" @endif
                                            @if($field['type'] == 'file') accept=".doc,.docx,.xml,.pdf,.txt,.zip,.gz,.rar,application/msword,audio/*,video/*,text/*,image/*" @endif>
                                    @elseif ($field['type'] == 'textarea')
                                        <textarea class="form-control block-form-control" rows="4" name="{{ $field['id'] }}" @if ($field['required']) required @endif></textarea>
                                    @elseif ($field['type'] == 'select')
                                        @php
                                            $field_options_array = explode(PHP_EOL, $field['dropdowns']);
                                        @endphp

                                        <select class="form-select block-form-control @if ($field['field_size'] == 'lg') form-control-lg @endif @if ($field['field_size'] == 'sm') form-control-sm @endif"
                                            name="{{ $field['id'] }}" @if ($field['required']) required @endif>
                                            <option value="">- {{ __('Select') }} -</option>
                                            @foreach ($field_options_array as $field_dropdown_name)
                                                <option value="{{ $field_dropdown_name }}">{{ $field_dropdown_name }}</option>
                                            @endforeach
                                        </select>
                                    @elseif ($field['type'] == 'checkbox')
                                        @php
                                            $field_options_array = explode(PHP_EOL, $field['dropdowns']);
                                        @endphp

                                        @foreach ($field_options_array as $field_dropdown_name)
                                            <div class="form-check mb-2">
                                                <input class="form-check-input" type="checkbox" value="{{ $field_dropdown_name }}" id="check_{{ $field['id'] }}_{{ $field_dropdown_name }}"
                                                    name="{{ $field['id'] }}[]" @if ($field['required']) required @endif>
                                                <label class="form-check-label fw-normal" for="check_{{ $field['id'] }}_{{ $field_dropdown_name }}">
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

                                    @if ($field['info'])
                                        <div class="form-text text-muted small">{!! $field['info'] !!}</div>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <input type="hidden" name="source_lang_id" value="{{ active_lang()->id ?? null }}">
                <input type="hidden" name="block_id" value="{{ $block['id'] ?? null }}">
                @if (check_form_have_recaptcha($block_extra['form_id']))
                    <input type="hidden" name="recaptcha_response" id="recaptchaResponse">
                @endif
                <button type="submit"
                    class="btn btn_{{ $block_extra['submit_btn_id'] ?? ' btn-primary' }} {{ button($block_extra['submit_btn_id'])->font_weight ?? null }} {{ button($block_extra['submit_btn_id'])->rounded ?? null }} {{ button($block_extra['submit_btn_id'])->shadow ?? null }} {{ button($block_extra['submit_btn_id'])->size ?? null }}">{{ $block_content['submit_btn_text'] ?? __('Submit') }}</button>

            </form>
        @endif

    </div>
</div>
