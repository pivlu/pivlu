<div class="form-group col-xl-2 col-lg-3">
    <labeL>{{ __('Map height (in pixels)') }}</labeL>
    <div class="input-group">
        <input type="number" step="1" class="form-control" aria-describedby="width-addon" name="height" value="{{ $block_settings->height ?? null }}">
        <span class="input-group-text" id="width-addon">{{ __('pixels') }}</span>
    </div>
    <div class="form-text">
        {{ __('Example: 400') }}
    </div>
</div>

<div class="form-group col-xl-2 col-lg-3">
    <labeL>{{ __('Zoom') }}</labeL>
    <div class="input-group">
        <input type="number" step="1" class="form-control" name="zoom" value="{{ $block_settings->zoom ?? '16' }}">
    </div>
    <div class="form-text">
        {{ __('Numeric value from 10 (minimum zoom) to 20 (maximum zoom). Default: 16') }}
    </div>
</div>

<div class="form-group mb-0">
    <labeL>{{ __('Address') }}</labeL>
    <input class="form-control" type="text" name="address" value="{{ $block_settings->address ?? null }}">
</div>
<div class="form-text">
    {{ __('Map will be centered automatic based on this address. Use complete address (country, region, city, street, code). Example: "Spain, Valencia, Av. de les Balears, 59".') }}
</div>


<h5 class="mb-3 mt-4">{{ __('Block content') }}:</h5>

@foreach ($block->all_languages_contents as $lang_content)
    @if (count(admin_languages()) > 1)
        <div class="fw-bold fs-5">{!! flag($lang_content->lang_code, 'circle') !!} {{ $lang_content->lang_name }}</div>
    @endif

    @include('pivlu::admin.blocks.includes.block-header')

    <div class="mb-4"></div>

    @if (count(admin_languages()) > 1 && !$loop->last)
        <hr>
    @endif
@endforeach
