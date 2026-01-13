<div class="col-12">


    <div class="form-group mb-2">
        <div class="form-check form-switch">
            <input class="form-check-input" type="checkbox" id="use_custom_style" name="use_custom_style" @if ($block_extra['style_id'] ?? null) checked @endif>
            <label class="form-check-label" for="use_custom_style">{{ __('Use custom style for this section') }}</label>
        </div>
    </div>

    <script>
        $('#use_custom_style').change(function() {
            select = $(this).prop('checked');
            if (select)
                document.getElementById('hidden_div_style').style.display = 'block';
            else
                document.getElementById('hidden_div_style').style.display = 'none';
        })
    </script>

    <div id="hidden_div_style" style="display: @if (isset($block_extra['style_id'])) block @else none @endif" class="mt-2">
        <div class="form-group col-lg-4 col-md-6 mb-3">
            <label>{{ __('Select custom style') }} [<a class="fw-bold" target="_blank" href="{{ route('admin.theme-styles.index') }}">{{ __('manage custom styles') }}</a>]</label>
            <select class="form-select" id="style_id" name="style_id" value="@if (isset($block_extra['style_id'])) {{ $block_extra['style_id'] }} @else #fbf7f0 @endif">
                <option value="">-- {{ __('select') }} --</option>
                @foreach ($styles as $style)
                    <option @if (($block_extra['style_id'] ?? null) == $style->id) selected @endif value="{{ $style->id }}">{{ $style->label }}</option>
                @endforeach
            </select>
            @if (count($styles) == 0)
                <div class="small text-info mt-1">{{ __("You don't have custom styles created") }}</div>
            @endif
        </div>
    </div>

    <div class="row">
        <div class="col-md-4 col-lg-3 col-xl-2 col-12 form-group">
            <label>{{ __('Number of posts') }}</label>
            <input name="items" class="form-control" value="{{ $block_extra['items'] ?? 12 }}">
        </div>

        <div class="col-md-4 col-lg-3 col-xl-2 col-12 form-group">
            <label>{{ __('Content') }}</label>
            <select name="content" class="form-select">
                <option @if (($block_extra['content'] ?? null) == 'latest') selected @endif value="latest">{{ __('Lates posts') }}</option>
                <option @if (($block_extra['content'] ?? null) == 'top_7') selected @endif value="top_7">{{ __('Top posts (7 days)') }}</option>
                <option @if (($block_extra['content'] ?? null) == 'top_30') selected @endif value="top_30">{{ __('Top posts (30 days)') }}</option>
                <option @if (($block_extra['content'] ?? null) == 'top_all') selected @endif value="top_all">{{ __('Top posts (any date)') }}</option>
            </select>
        </div>

        <div class="col-md-4 col-lg-3 col-xl-2 col-12 form-group">
            <label>{{ __('Categories badge') }}</label>
            <input name="categ_badge" class="form-control" value="{{ $block_extra['categ_badge'] ?? null }}">
            <div class="text-mutedd form-text">{{ __('Leave empty for all categories or input a badge to display posts from specific categories.') }}</div>
        </div>

    </div>


    <div class="row">

        <div class="col-md-4 col-lg-3 col-xl-2 col-12 form-group">
            <label>{{ __('Select listing style') }}</label>
            <select name="style" class="form-select" id="style" onchange="showDiv()">
                <option @if (($block_extra['style'] ?? null) == 'rows') selected @endif value="rows">{{ __('Rows') }}</option>
                <option @if (($block_extra['style'] ?? null) == 'columns') selected @endif value="columns">{{ __('Columns') }}</option>
            </select>
        </div>
        <script>
            function showDiv() {
                var select = document.getElementById('style');
                var value = select.options[select.selectedIndex].value;

                if (value == 'columns') {
                    document.getElementById('div_columns').style.display = 'block';
                } else {
                    document.getElementById('div_columns').style.display = 'none';
                }
            }
        </script>

        <div id="div_columns" style="display: @if (($block_extra['style'] ?? null) == 'columns') block @else none @endif">
            <div class="row">
                <div class="col-md-4 col-lg-3 col-xl-2 col-12 form-group">
                    <label>{{ __('Number of columns') }}</label>
                    <select name="columns" class="form-select">
                        <option @if (($block_extra['columns'] ?? null) == '2') selected @endif value="2">2</option>
                        <option @if (($block_extra['columns'] ?? null) == '3') selected @endif value="3">3</option>
                        <option @if (($block_extra['columns'] ?? null) == '4') selected @endif value="4">4</option>
                    </select>
                    <div class="form-text">
                        {{ __('Note: This is the number of maximum columns for large displays. For smaller displays, the columns are changed automatically') }}.</div>
                </div>

                <div class="col-md-4 col-lg-3 col-xl-2 col-12 form-group">
                    <label>{{ __('Select column style') }}</label>
                    <select name="columns_style" class="form-select" id="columns_style" onchange="showCardColorDiv()">
                        <option @if (($block_extra['columns_style'] ?? null) == 'border') selected @endif value="border">{{ __('Card with border') }}</option>
                        <option @if (($block_extra['columns_style'] ?? null) == 'border_shaddow') selected @endif value="border_shaddow">{{ __('Card with border and shaddow') }}</option>
                        <option @if (($block_extra['columns_style'] ?? null) == 'none') selected @endif value="none">{{ __('No border') }}</option>
                    </select>
                </div>

                <script>
                    function showCardColorDiv() {
                        var select = document.getElementById('columns_style');
                        var value = select.options[select.selectedIndex].value;

                        if (value != 'none') {
                            document.getElementById('hidden_div_card_color').style.display = 'block';
                        } else {
                            document.getElementById('hidden_div_card_color').style.display = 'none';
                        }
                    }
                </script>

                <div id="hidden_div_card_color" style="display: @if ($block_extra['columns_style'] ?? null != 'none') block @else none @endif">
                    <div class="form-group">
                        <input class="form-control form-control-color" id="card_border_color" name="card_border_color"
                            value="@if (isset($block_extra['card_border_color'])) {{ $block_extra['card_border_color'] }} @else #e7e7e7 @endif">
                        <label>{{ __('Card border color') }}</label>
                        <script>
                            $('#card_border_color').spectrum({
                                type: "color",
                                showInput: true,
                                showInitial: true,
                                showAlpha: false,
                                showButtons: false,
                                allowEmpty: false,
                            });
                        </script>
                    </div>

                    <div class="form-group mb-2">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="card_use_custom_bg" name="card_use_custom_bg" @if ($block_extra['card_bg_color'] ?? null) checked @endif>
                            <label class="form-check-label" for="card_use_custom_bg">{{ __('Use custom background color for this card') }}</label>
                        </div>
                    </div>

                    <script>
                        $('#card_use_custom_bg').change(function() {
                            select = $(this).prop('checked');
                            if (select)
                                document.getElementById('hidden_div_card_bg_color').style.display = 'block';
                            else
                                document.getElementById('hidden_div_card_bg_color').style.display = 'none';
                        })
                    </script>

                    <div id="hidden_div_card_bg_color" style="display: @if (isset($block_extra['card_bg_color'])) block @else none @endif" class="mt-2">
                        <div class="form-group">
                            <input class="form-control form-control-color" id="card_bg_color" name="card_bg_color" value="@if (isset($block_extra['card_bg_color'])) {{ $block_extra['card_bg_color'] }} @else #fbf7f0 @endif">
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
                    </div>


                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4 col-lg-3 col-12 form-group">
            <label>{{ __('Display main image') }}</label>
            <select name="show_image" class="form-select">
                <option @if (($block_extra['show_image'] ?? null) == 1) selected @endif value="1">{{ __('Yes') }}</option>
                <option @if (($block_extra['show_image'] ?? null) == 0) selected @endif value="0">{{ __('No') }}</option>
            </select>
        </div>

        <div class="col-md-4 col-lg-3 col-12 form-group">
            <label>{{ __('Display article date') }}</label>
            <select name="show_date" class="form-select">
                <option @if (($block_extra['show_date'] ?? null) == 'date') selected @endif value="date">{{ __('Date only') }}</option>
                <option @if (($block_extra['show_date'] ?? null) == 'datetime') selected @endif value="datetime">{{ __('Date and time') }}</option>
                <option @if (($block_extra['show_date'] ?? null) == 'no') selected @endif value="no">{{ __('Do not show') }}</option>
            </select>
        </div>

        <div class="col-md-4 col-lg-3 col-12 form-group">
            <label>{{ __('Display article author') }}</label>
            <select name="show_author" class="form-select">
                <option @if (($block_extra['show_author'] ?? null) == 'name') selected @endif value="name">{{ __('Author name only') }}</option>
                <option @if (($block_extra['show_author'] ?? null) == 'name_avatar') selected @endif value="name_avatar">{{ __('Author name and avatar') }}</option>
                <option @if (($block_extra['show_author'] ?? null) == 'no') selected @endif value="no">{{ __('Do not show') }}</option>
            </select>
        </div>

        {{--
                        <div class="col-md-4 col-lg-3 col-12 form-group">
                            @php
                                $titles_font_size = $block_extra['titles_font_size'] ?? config('defaults.h4_size');
                            @endphp

                            <label>{{ __('Titles font size') }}</label>
                            <select class="form-select" name="titles_font_size">
                                @foreach (template_font_sizes() as $selectes_font_size_title)
                                    <option @if ($titles_font_size == $selectes_font_size_title->value) selected @endif value="{{ $selectes_font_size_title->value }}">{{ $selectes_font_size_title->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        --}}

        <div class="col-md-4 col-lg-3 col-12 form-group">
            <label>{{ __('Show content summary') }}</label>
            <select name="show_summary" class="form-select">
                <option @if (($block_extra['show_summary'] ?? null) == 1) selected @endif value="1">{{ __('Yes') }}</option>
                <option @if (($block_extra['show_summary'] ?? null) == 0) selected @endif value="0">{{ __('No') }}</option>
            </select>
        </div>

        <div class="col-md-4 col-lg-3 col-12 form-group">
            <label>{{ __('Show time to read') }}</label>
            <select name="show_time_read" class="form-select">
                <option @if (($block_extra['show_time_read'] ?? null) == 1) selected @endif value="1">{{ __('Yes') }}</option>
                <option @if (($block_extra['show_time_read'] ?? null) == 0) selected @endif value="0">{{ __('No') }}</option>
            </select>
        </div>

        <div class="col-md-4 col-lg-3 col-12 form-group">
            <label>{{ __('Show comments counter') }}</label>
            <select name="show_comments_count" class="form-select">
                <option @if (($block_extra['show_comments_count'] ?? null) == 1) selected @endif value="1">{{ __('Yes') }}</option>
                <option @if (($block_extra['show_comments_count'] ?? null) == 0) selected @endif value="0">{{ __('No') }}</option>
            </select>
        </div>

        <div class="col-md-4 col-lg-3 col-12 form-group">
            <label>{{ __('Show "Read more" text') }}</label>
            <select name="show_read_more" class="form-select">
                <option @if (($block_extra['show_read_more'] ?? null) == 1) selected @endif value="1">{{ __('Yes') }}</option>
                <option @if (($block_extra['show_read_more'] ?? null) == 0) selected @endif value="0">{{ __('No') }}</option>
            </select>
        </div>

        <div class="form-group mb-0">
            <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" id="img-shaddow" name="img-shaddow" @if ($block_extra['img-shaddow'] ?? null) checked @endif>
                <label class="form-check-label" for="img-shaddow">{{ __('Add shaddow to main image') }}</label>
            </div>
        </div>

    </div>
</div>



@foreach ($content_langs as $lang)
    @if (count($languages) > 1 && $block_module != 'posts')
        <h5 class="mb-3">{!! flag($lang->code) !!} {{ $lang->name }}</h5>
    @endif

    @php
        if (($is_layout_block ?? null) == 1) {
            $header_array = unserialize($lang->layout_block_content->header ?? null);
        } else {
            $header_array = unserialize($lang->block_content->header ?? null);
        }
    @endphp

    
        <div class="form-group mb-3">
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


        @if (count($languages) > 1 && !$loop->last)
            <hr>
        @endif
@endforeach
