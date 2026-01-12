<form method="post">
    @csrf
    @method('PUT')


    @foreach ($theme_tab_settings['data'] ?? [] as $setting_key => $setting_value)
        <div class="form-group mb-3">
            <label for="{{ $setting_key }}" class="form-label">{{ $setting_value['label'] ?? $setting_key }}</label>

            @if ($setting_value['type'] == 'color')
                <input type="color" class="form-control color-picker" id="{{ $setting_key }}" name="{{ $setting_key }}" value="{{ $setting_value['default'] }}">
            @endif

            @if ($setting_value['type'] == 'text')
                <input type="text" class="form-control" id="{{ $setting_key }}" name="{{ $setting_key }}" value="{{ $setting_value['default'] }}">
            @endif

            @if ($setting_value['type'] == 'textarea')
                <textarea class="form-control" id="{{ $setting_key }}" name="{{ $setting_key }}" rows="4">{!! $setting_value['default'] !!}</textarea>
            @endif

            @if ($setting_value['type'] == 'editor')
                <textarea class="form-control trumbowyg" id="{{ $setting_key }}" name="{{ $setting_key }}" rows="4">{!! $setting_value['default'] !!}</textarea>
            @endif

            @if ($setting_value['type'] == 'boolean')
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" role="switch" id="switchCheck_{{ $setting_key }}" name="{{ $setting_key }}" @if ($setting_value['default'] == true) checked @endif>
                    <label class="form-check-label" for="switchCheck_{{ $setting_key }}">{{ $setting_value['label'] }}</label>
                </div>
            @endif

            @if ($setting_value['description'] ?? '')
                <div class="form-text mt-0">{{ $setting_value['description'] }}</div>
            @endif
        </div>
    @endforeach

    <div class="row">
        <div class="col-12">
            <button type="submit" class="btn btn-primary mt-3">{{ __('Update style') }}</button>
        </div>
    </div>

</form>
