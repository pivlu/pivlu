<div class="form-group col-md-4 col-xl-3 mt-3">
    <label>{{ __('Links display style') }}</label>
    <select class="form-select" name="display_style">
        <option @if (($block_settings->display_style ?? null) == 'list') selected @endif value="list">{{ __('Ordered list (one link per line)') }}</option>
        <option @if (($block_settings->display_style ?? null) == 'multiple') selected @endif value="multiple">{{ __('One after another') }}</option>
    </select>
</div>

<div class="form-group mb-0">
    <div class="form-check form-switch">
        <input class="form-check-input" type="checkbox" id="new_tab" name="new_tab" @if ($block_settings->new_tab ?? null) checked @endif>
        <label class="form-check-label" for="new_tab">{{ __('Open links in new tab') }}</label>
    </div>
</div>



<h5 class="mb-3 mt-4">{{ __('Block content') }}:</h5>

@foreach ($block->all_languages_contents as $lang_content)
    @if (count(admin_languages()) > 1)
        <div class="fw-bold fs-5">{!! flag($lang_content->lang_code, 'circle') !!} {{ $lang_content->lang_name }}</div>
    @endif

    @php
        $block_header = json_decode($lang_content->header);
        $block_content = json_decode($lang_content->content);
    @endphp


    <div class="form-group mb-3">
        <div class="form-check form-switch">
            <input class="form-check-input" type="checkbox" id="add_header_{{ $lang_content->lang_id }}" name="add_header_{{ $lang_content->lang_id }}" @if ($block_header->add_header ?? null) checked @endif>
            <label class="form-check-label" for="add_header_{{ $lang_content->lang_id }}">{{ __('Add header content') }}</label>
        </div>
    </div>

    <script>
        $('#add_header_{{ $lang_content->lang_id }}').change(function() {
            select = $(this).prop('checked');
            if (select)
                document.getElementById('hidden_div_header_{{ $lang_content->lang_id }}').style.display = 'block';
            else
                document.getElementById('hidden_div_header_{{ $lang_content->lang_id }}').style.display = 'none';
        })
    </script>

    <div id="hidden_div_header_{{ $lang_content->lang_id }}" style="display: @if ($block_header->add_header ?? null) block @else none @endif" class="mt-2">
        <div class="form-group">
            <label>{{ __('Header title') }}</label>
            <input class="form-control" name="header_title_{{ $lang_content->lang_id }}" value="{{ $block_header->title ?? null }}">
        </div>
        <div class="form-group">
            <label>{{ __('Header content') }}</label>
            <textarea class="form-control" name="header_content_{{ $lang_content->lang_id }}">{{ $block_header->content ?? null }}</textarea>
        </div>
    </div>


    @if (count($block_content ?? []) > 0)
        @for ($i = 0; $i < count($block_content); $i++)
            <div class="row">
                <div class="col-md-5 col-sm-6 col-12">
                    <div class="form-group">
                        <label>{{ __('Link title') }}</label>
                        <input type="text" class="form-control" name="a_title_{{ $lang_content->lang_id }}[]" value="{{ $block_content[$i]->title ?? null }}">
                    </div>
                </div>

                <div class="col-md-5 col-sm-6 col-12">
                    <div class="form-group">
                        <label>{{ __('URL') }}</label>
                        <input type="text" class="form-control" name="a_url_{{ $lang_content->lang_id }}[]" value="{{ $block_content[$i]->url ?? null }}">
                    </div>
                </div>

                <div class="col-md-2 col-sm-6 col-12">
                    <div class="form-group">
                        <label>{{ __('Icon code') }} ({{ __('optional') }})</label>
                        <input type="text" class="form-control" name="a_icon_{{ $lang_content->lang_id }}[]" value="{{ $block_content[$i]->icon ?? null }}">
                    </div>
                </div>
            </div>
        @endfor
    @endif

    <div class="mb-3">
        <button type="button" class="btn btn-light addButton_{{ $lang_content->lang_id }}"><i class="bi bi-plus-circle"></i> {{ __('Add link') }} </button>
    </div>

    <!-- The template for adding new item -->
    <div class="form-group hide" id="ItemTemplate_{{ $lang_content->lang_id }}">
        <div class="row">
            <div class="col-md-5 col-sm-6 col-12">
                <div class="form-group">
                    <label>{{ __('Link title') }}</label>
                    <input type="text" class="form-control" name="a_title_{{ $lang_content->lang_id }}[]" />
                </div>
            </div>

            <div class="col-md-5 col-sm-6 col-12">
                <div class="form-group">
                    <label>{{ __('URL') }}</label>
                    <input type="text" class="form-control" name="a_url_{{ $lang_content->lang_id }}[]" />
                </div>
            </div>

            <div class="col-md-2 col-sm-6 col-12">
                <div class="form-group">
                    <label>{{ __('Icon code') }} ({{ __('optional') }})</label>
                    <input type="text" class="form-control" name="a_icon_{{ $lang_content->lang_id }}[]" />
                </div>
            </div>
        </div>
        <div class="mb-3"></div>
    </div>

    <script>
        $(document).ready(function() {
            urlIndex_{{ $lang_content->lang_id }} = 0;
            $('#updateBlock')
                // Add button click handler
                .on('click', '.addButton_{{ $lang_content->lang_id }}', function() {
                    urlIndex_{{ $lang_content->lang_id }}++;
                    var $template = $('#ItemTemplate_{{ $lang_content->lang_id }}'),
                        $clone = $template
                        .clone()
                        .removeClass('hide')
                        .removeAttr('id')
                        .attr('data-proforma-index', urlIndex_{{ $lang_content->lang_id }})
                        .insertBefore($template);

                    // Update the name attributes
                    $clone
                        .find('[name="a_title_{{ $lang_content->lang_id }}"]').attr('name', 'updateBlock[' + urlIndex_{{ $lang_content->lang_id }} + '].a_title_{{ $lang_content->lang_id }}').end()
                        .find('[name="a_url_{{ $lang_content->lang_id }}"]').attr('name', 'updateBlock[' + urlIndex_{{ $lang_content->lang_id }} + '].a_url_{{ $lang_content->lang_id }}').end()
                        .find('[name="a_icon_{{ $lang_content->lang_id }}"]').attr('name', 'updateBlock[' + urlIndex_{{ $lang_content->lang_id }} + '].a_icon_{{ $lang_content->lang_id }}').end();
                })

        });
    </script>

    <div class="mb-4"></div>

    @if (count(admin_languages()) > 1 && !$loop->last)
        <hr>
    @endif
@endforeach
