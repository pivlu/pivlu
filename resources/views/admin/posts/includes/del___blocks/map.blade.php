<div class="form-group col-xl-2 col-lg-3">
    <labeL>{{ __('Map height (in pixels)') }}</labeL>
    <div class="input-group">
        <input type="text" class="form-control" aria-describedby="width-addon" name="height" value="{{ $block_settings['height'] ?? null }}">
        <span class="input-group-text" id="width-addon">{{ __('pixels') }}</span>
    </div>
    <div class="form-text">
        {{ __('Example: 400') }}
    </div>
</div>

<div class="form-group col-xl-2 col-lg-3">
    <labeL>{{ __('Zoom') }}</labeL>
    <div class="input-group">
        <input type="text" class="form-control" name="zoom" value="{{ $block_settings['zoom'] ?? '16' }}">
    </div>
    <div class="form-text">
        {{ __('Numeric value from 10 (minimum zoom) to 20 (maximum zoom). Default: 16') }}
    </div>
</div>

<div class="form-group mb-0">
    <labeL>{{ __('Address') }}</labeL>
    <input class="form-control" type="text" name="address" value="{{ $block_settings['address'] ?? null }}">
</div>
<div class="form-text">
    {{ __('Map will be centered automatic based on this address. Use complete address (country, region, city, street, code). Example: "Spain, Valencia, Av. de les Balears, 59".') }}
</div>

</div>


<h5 class="mb-3">{{ __('Block content') }}:</h5>

@foreach ($content_langs as $lang)
    @if (count($languages) > 1)
        <h5 class="mb-3">{!! flag($lang->code) !!} {{ $lang->name }}</h5>
    @endif

    @php
        $header_array = unserialize($lang->block_header);
    @endphp

    <div class="card p-3 bg-light mb-4">
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

        <div id="hidden_div_header_{{ $lang->id }}" style="display: @if ($header_array['add_header'] ?? null) block @else none @endif" class="mt-2">
            <div class="form-group">
                <label>{{ __('Header title') }}</label>
                <input class="form-control" name="header_title_{{ $lang->id }}" value="{{ $header_array['title'] ?? null }}">
            </div>
            <div class="form-group">
                <label>{{ __('Header content') }}</label>
                <textarea class="form-control trumbowyg" name="header_content_{{ $lang->id }}">{{ $header_array['content'] ?? null }}</textarea>
            </div>
        </div>
    </div>
@endforeach
