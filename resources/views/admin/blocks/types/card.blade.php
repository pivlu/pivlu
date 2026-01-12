<div class="form-group mb-3">
    <div class="form-check form-switch">
        <input class="form-check-input" type="checkbox" id="shadow" name="shadow" @if ($block_settings->shadow ?? null) checked @endif>
        <label class="form-check-label" for="shadow">{{ __('Add shadow to cards') }}</label>
    </div>
</div>

<div class="form-group mb-3">
    <div class="form-check form-switch">
        <input class="form-check-input" type="checkbox" id="no_border_radius" name="no_border_radius" @if ($block_settings->no_border_radius ?? null) checked @endif>
        <label class="form-check-label" for="no_border_radius">{{ __('Disable border radius') }}</label>
    </div>
    <div class="form-text">{{ __('By default, cards have rounded border. Check to disable border rounding.') }}</div>
</div>

<div class="form-group mb-3">
    <div class="form-check form-switch">
        <input class="form-check-input" type="checkbox" id="horizontal" name="horizontal" @if ($block_settings->horizontal ?? null) checked @endif>
        <label class="form-check-label" for="horizontal">{{ __('Horizontal cards content') }}</label>
    </div>
    <div class="form-text">{{ __('If checked, card text content will be atfter the image. If not checked, card text content will be below the image.') }}</div>
</div>

<div class="form-group mb-3">
    <div class="form-check form-switch">
        <input class="form-check-input" type="checkbox" id="same_height" name="same_height" @if ($block_settings->same_height ?? null) checked @endif>
        <label class="form-check-label" for="same_height">{{ __('Cards have same height') }}</label>
    </div>
    <div class="form-text">{{ __('If cards have different heights (depending on content), force all cards to have the height of the tallest card') }}</div>
</div>

<div class="form-group mb-3">
    <div class="form-check form-switch">
        <input class="form-check-input" type="checkbox" id="img_full_width" name="img_full_width" @if ($block_settings->img_full_width ?? null) checked @endif>
        <label class="form-check-label" for="img_full_width">{{ __('Force cards images to be full width') }}</label>
    </div>
    <div class="form-text">{{ __('If card image is smaller, force image to grow to 100% width of the parent div') }}</div>
</div>

<div class="form-group col-md-6">
    <label>{{ __('Select columns (number of cards per row)') }}</label>
    <select class="form-select" name="cols">
        <option @if (($block_settings->cols ?? null) == 1) selected @endif value="1">1</option>
        <option @if (($block_settings->cols ?? null) == 2) selected @endif value="2">2</option>
        <option @if (($block_settings->cols ?? null) == 3) selected @endif value="3">3</option>
        <option @if (($block_settings->cols ?? null) == 4 || is_null($block_settings->cols ?? null)) selected @endif value="4">4</option>
        <option @if (($block_settings->cols ?? null) == 6) selected @endif value="6">6</option>
    </select>
    <div class="form-text">{{ __('This is the maximum number of cards per row for larger displays. For smaller displays, the cards are resized automatically.') }}</div>
</div>

<div class="form-group">
    <input class="form-control form-control-color" name="card_bg_color" id="card_bg_color" value="{{ $block_settings->card_bg_color ?? 'white' }}">
    <label>{{ __('Card background color') }}</label>
    <script>
        $('#card_bg_color').spectrum({
            type: "color",
            showInput: true,
            showInitial: true,
            showAlpha: false,
            showButtons: false,
            allowEmpty: false,
        });
    </script>
</div>

<div class="form-group">
    <div class="form-check form-switch">
        <input class="form-check-input" type="checkbox" id="use_border" name="use_border" @if ($block_settings->border_color ?? null) checked @endif>
        <label class="form-check-label" for="use_border">{{ __('Show cards border') }}</label>
    </div>
</div>

<script>
    $('#use_border').change(function() {
        select = $(this).prop('checked');
        if (select)
            document.getElementById('hidden_div_border').style.display = 'block';
        else
            document.getElementById('hidden_div_border').style.display = 'none';
    })
</script>

<div id="hidden_div_border" style="display: @if (isset($block_settings->border_color)) block @else none @endif" class="mt-2">
    <div class="form-group mb-4">
        <input class="form-control form-control-color" name="border_color" id="border_color" value="{{ $block_settings->border_color ?? 'grey' }}">
        <label>{{ __('Card border color') }}</label>
        <script>
            $('#border_color').spectrum({
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


<div class="form-group">
    <div class="form-check form-switch">
        <input class="form-check-input" type="checkbox" id="use_bg_color_hover" name="use_bg_color_hover" @if ($block_settings->bg_color_hover ?? null) checked @endif>
        <label class="form-check-label" for="use_bg_color_hover">{{ __('Use custom background color on mouse hover the card') }}</label>
    </div>
</div>

<script>
    $('#use_bg_color_hover').change(function() {
        select = $(this).prop('checked');
        if (select)
            document.getElementById('hidden_div_bg_color_hover').style.display = 'block';
        else
            document.getElementById('hidden_div_bg_color_hover').style.display = 'none';
    })
</script>

<div id="hidden_div_bg_color_hover" style="display: @if (isset($block_settings->bg_color_hover)) block @else none @endif" class="mt-2">
    <div class="form-group mb-4">
        <input class="form-control form-control-color" name="bg_color_hover" id="bg_color_hover" value="{{ $block_settings->bg_color_hover ?? 'grey' }}">
        <label>{{ __('Card background color on mouse hover') }}</label>
        <script>
            $('#bg_color_hover').spectrum({
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

<div class="form-group col-md-6 mb-3">
    <label>{{ __('Select icon size (if you use icons)') }}</label>
    <select class="form-select" id="icon_size" name="icon_size">
        @foreach ($font_sizes as $selected_font_size_title)
            <option @if (($block_settings->icon_size ?? null) == $selected_font_size_title->value) selected @endif @if (!($block_settings->icon_size ?? null) && $selected_font_size_title->value == '2rem') selected @endif value="{{ $selected_font_size_title->value }}">
                {{ $selected_font_size_title->name }}</option>
        @endforeach
        <option @if (($block_settings->icon_size ?? null) == '15rem') selected @endif value="15rem">1500%</option>
        <option @if (($block_settings->icon_size ?? null) == '20rem') selected @endif value="20rem">2000%</option>
    </select>
</div>

<div class="row">
    <div class="form-group col-md-4 mb-3">
        <label>{{ __('Link location (if card link is set)') }}</label>
        <select class="form-select" name="link_location">
            <option @if (($block_settings->link_location ?? null) == 'title') selected @endif value="title">{{ __('Add link on title') }}</option>
            <option @if (($block_settings->link_location ?? null) == 'button') selected @endif value="button">{{ __('Add button link') }}</option>
        </select>
    </div>

    <div class="form-group col-md-4 mb-3">
        <label>{{ __('Button size (if button link is set)') }}</label>
        <select class="form-select" name="link_btn_size">
            <option @if (($block_settings->link_btn_size ?? null) == '') selected @endif value="">{{ __('Normal') }}</option>
            <option @if (($block_settings->link_btn_size ?? null) == 'btn-lg') selected @endif value="btn-lg">{{ __('Large') }}</option>
            <option @if (($block_settings->link_btn_size ?? null) == 'btn-sm') selected @endif value="btn-sm">{{ __('Small') }}</option>
        </select>
    </div>

    <div class="form-group col-md-4 mb-3">
        <label>{{ __('Button width (if button link is set)') }}</label>
        <select class="form-select" name="link_btn_width">
            <option @if (($block_settings->link_btn_width ?? null) == '') selected @endif value="">{{ __('Normal') }}</option>
            <option @if (($block_settings->link_btn_width ?? null) == 'block') selected @endif value="block">{{ __('Full width') }}</option>
        </select>
    </div>
</div>

@foreach ($block->all_languages_contents as $lang_content)
    <div class="fw-bold mb-2">{!! lang_label($lang_content, __('Content')) !!}</div>   
    
    @include('pivlu::admin.blocks.includes.block-header')

    <div class="mb-4"></div>    
@endforeach
