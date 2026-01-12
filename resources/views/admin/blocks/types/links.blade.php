<div class="form-group col-md-6 col-xl-4 mt-3">
    <label>{{ __('Links display style') }}</label>
    <select class="form-select" name="display_style">
        <option @if (($block_settings->display_style ?? null) == 'list') selected @endif value="list">{{ __('Ordered list (one link per line)') }}</option>
        <option @if (($block_settings->display_style ?? null) == 'multiple') selected @endif value="multiple">{{ __('One after another') }}</option>
    </select>
</div>

<div class="form-group mb-3">
    <div class="form-check form-switch">
        <input class="form-check-input" type="checkbox" id="new_tab" name="new_tab" @if ($block_settings->new_tab ?? null) checked @endif>
        <label class="form-check-label" for="new_tab">{{ __('Open links in new tab') }}</label>
    </div>
</div>

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
