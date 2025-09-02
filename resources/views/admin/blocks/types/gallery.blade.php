<form id="updateBlock" method="post" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="form-group mb-3">
        <div class="form-check form-switch">
            <input class="form-check-input" type="checkbox" id="shadow" name="shadow" @if ($block_settings['shadow'] ?? null) checked @endif>
            <label class="form-check-label" for="shadow">{{ __('Add shadow to images') }}</label>
        </div>
    </div>

    <div class="form-group mb-3">
        <div class="form-check form-switch">
            <input class="form-check-input" type="checkbox" id="rounded" name="rounded" @if ($block_settings['rounded'] ?? null) checked @endif>
            <label class="form-check-label" for="rounded">{{ __('Add rounded corners to image') }}</label>
        </div>
    </div>

    <div id="hidden_div_cols" style="display: @if (isset($block_settings['masonry_layout'])) none @else block @endif"
        class="mt-1">
        <div class="form-group col-md-4 col-xl-3">
            <label>{{ __('Select columns (number of images per row)') }}</label>
            <select class="form-select" name="cols">
                <option @if (($block_settings['cols'] ?? null) == 2) selected @endif value="2">2</option>
                <option @if (($block_settings['cols'] ?? null) == 3) selected @endif value="3">3</option>
                <option @if (($block_settings['cols'] ?? null) == 4 || is_null($block_settings['cols'] ?? null)) selected
                @endif value="4">4</option>
                <option @if (($block_settings['cols'] ?? null) == 6) selected @endif value="6">6</option>
            </select>
            <div class="form-text">
                {{ __('This is the maximum number of images per row for larger displays. For smaller displays, the columns are resized automatically.') }}
            </div>
        </div>
    </div>

    <div class="form-group mb-1">
        <div class="form-check form-switch">
            <input class="form-check-input" type="checkbox" id="masonry_layout" name="masonry_layout" @if ($block_settings['masonry_layout'] ?? null) checked @endif>
            <label class="form-check-label" for="masonry_layout">{{ __('Use Masonry to arange images') }}</label>
        </div>
        <div class="text-muted">
            {{ __('It works by placing elements in optimal position based on available vertical space.') }}
        </div>
        <div class="text-muted">
            {{ __('This option works fine if you have many images (multiple lines). Note: caption text is not displayed') }}
        </div>
    </div>

    <script>
        $('#masonry_layout').change(function () {
            select = $(this).prop('checked');
            if (select) {
                document.getElementById('hidden_div_masonry').style.display = 'block';
                document.getElementById('hidden_div_cols').style.display = 'none';
            } else {
                document.getElementById('hidden_div_masonry').style.display = 'none';
                document.getElementById('hidden_div_cols').style.display = 'block';
            }
        })
    </script>

    <div id="hidden_div_masonry" style="display: @if (isset($block_settings['masonry_layout'])) block @else none @endif"
        class="mt-1">
        <div class="form-group col-md-4 col-xl-3">
            <label>{{ __('Select columns (number of images per row)') }}</label>
            <select class="form-select" name="masonry_cols">
                <option @if (($block_settings['masonry_cols'] ?? null) == 3) selected @endif value="3">3</option>
                <option @if (($block_settings['masonry_cols'] ?? null) == 4 || is_null($block_settings['masonry_cols'] ?? null)) selected @endif value="4">4</option>
                <option @if (($block_settings['masonry_cols'] ?? null) == 5) selected @endif value="5">5</option>
                <option @if (($block_settings['masonry_cols'] ?? null) == 6) selected @endif value="6">6</option>
            </select>
            <div class="form-text">
                {{ __('This is the maximum number of images per row for larger displays. For smaller displays, the columns are resized automatically.') }}
            </div>
        </div>

        <div class="form-group col-md-4 col-xl-3">
            <label>{{ __('Gutter') }}</label>
            <select class="form-select" name="masonry_gutter">
                <option @if (($block_settings['masonry_gutter'] ?? null) == 0 || is_null($block_settings['masonry_gutter'] ?? null)) selected @endif value="0">{{ __('No margin') }}</option>
                <option @if (($block_settings['masonry_gutter'] ?? null) == 10) selected @endif value="10">
                    {{ __('Small margin') }}
                </option>
                <option @if (($block_settings['masonry_gutter'] ?? null) == 30) selected @endif value="30">
                    {{ __('Large margin') }}
                </option>
            </select>
            <div class="form-text">{{ __('Gutter is the margin between images.') }}</div>
        </div>
    </div>

    @foreach ($block->all_languages_contents as $block_content)
        @if (count(admin_languages()) > 1)
            <h5 class="mb-3">{!! flag($block_content->lang_code) !!} {{ $block_content->lang_name }}</h5>
        @endif

        @php
            $header_array = unserialize($block_content->header);
        @endphp

        <div class="mb-4 mt-3">
            <div class="form-group mb-0">
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" id="add_header_{{ $block_content->lang_id }}"
                        name="add_header_{{ $block_content->lang_id }}" @if ($header_array['add_header'] ?? null) checked
                        @endif>
                    <label class="form-check-label"
                        for="add_header_{{ $block_content->lang_id }}">{{ __('Add header content') }}</label>
                </div>
            </div>

            <script>
                $('#add_header_{{ $block_content->lang_id }}').change(function () {
                    select = $(this).prop('checked');
                    if (select)
                        document.getElementById('hidden_div_header_{{ $block_content->lang_id }}').style.display = 'block';
                    else
                        document.getElementById('hidden_div_header_{{ $block_content->lang_id }}').style.display = 'none';
                })
            </script>

            <div id="hidden_div_header_{{ $block_content->lang_id }}"
                style="display: @if ($header_array['add_header'] ?? null) block @else none @endif" class="mt-2">
                <div class="form-group">
                    <label>{{ __('Header title') }}</label>
                    <input class="form-control" name="header_title_{{ $block_content->lang_id }}"
                        value="{{ $header_array['title'] ?? null }}">
                </div>
                <div class="form-group">
                    <label>{{ __('Header content') }}</label>
                    <textarea class="form-control trumbowyg"
                        name="header_content_{{ $block_content->lang_id }}">{{ $header_array['content'] ?? null }}</textarea>
                </div>
            </div>
        </div>


        @php
            $content_array = unserialize($block_content->content);
        @endphp

        @if ($content_array)
            @for ($i = 0; $i < count($content_array); $i++)
                <div class="card p-3 bg-light mb-4">
                    <div class="row">

                        <div class="form-group col-md-4 col-sm-6">
                            <label for="formFile" class="form-label">{{ __('Change image') }}</label>
                            <input class="form-control" type="file" id="formFile" name="image_{{ $block_content->lang_id }}[]"
                                multiple>
                            <div class="text-muted small">{{ __('Image file. Maximum 2.5 MB.') }}</div>

                            @if ($content_array[$i]['image'] ?? null)
                                <a target="_blank" href="{{ image($content_array[$i]['image']) }}"><img
                                        style="max-width: 300px; max-height: 100px;" src="{{ image($content_array[$i]['image']) }}"
                                        class="img-fluid mt-2"></a>
                                <input type="hidden" name="existing_image_{{ $block_content->lang_id }}[{{ $i }}]"
                                    value="{{ $content_array[$i]['image'] ?? null }}">

                                <div class="form-group mb-0">
                                    <div class="form-check form-switch">
                                        <input type="hidden" name="delete_image_file_code_{{ $block_content->lang_id }}_{{ $i }}"
                                            value="{{ $content_array[$i]['image'] ?? null }}">
                                        <input class="form-check-input" type="checkbox"
                                            id="delete_image_{{ $block_content->lang_id }}_{{ $i }}"
                                            name="delete_image_{{ $block_content->lang_id }}_{{ $i }}">
                                        <label class="form-check-label"
                                            for="delete_image_{{ $block_content->lang_id }}_{{ $i }}">{{ __('Delete image') }}</label>
                                    </div>
                                </div>
                            @endif
                        </div>

                        <div class="form-group col-md-3 col-sm-6">
                            <label>{{ __('Title (used as "alt" tag)') }}</label>
                            <input type="text" class="form-control" name="title_{{ $block_content->lang_id }}[]"
                                value="{{ $content_array[$i]['title'] ?? null }}">
                        </div>

                        <div class="form-group col-md-3 col-sm-6">
                            <label>{{ __('Caption') }} ({{ __('optional') }})</label>
                            <input class="form-control" type="text" name="caption_{{ $block_content->lang_id }}[]"
                                value="{{ $content_array[$i]['caption'] ?? null }}">
                        </div>

                        <div class="form-group col-md-2 col-sm-6">
                            <label>{{ __('Position') }}</label>
                            <input type="text" class="form-control" name="position_{{ $block_content->lang_id }}[]"
                                value="{{ $content_array[$i]['position'] ?? null }}">
                        </div>

                        <div class="form-group col-md-4 col-sm-6">
                            <label>{{ __('URL') }} ({{ __('optional') }})</label>
                            <input type="text" class="form-control" name="url_{{ $block_content->lang_id }}[]"
                                value="{{ $content_array[$i]['url'] ?? null }}">
                            <div class="text-muted small">
                                {{ __('If you add URL, the link is opened, instead images gallery player.') }}
                            </div>
                        </div>

                        <div class="form-group mb-0">
                            <div class="form-check form-switch">
                                <input type="hidden" name="delete_image_file_code_{{ $block_content->lang_id }}_{{ $i }}"
                                    value="{{ $content_array[$i]['image'] ?? null }}">
                                <input class="form-check-input" type="checkbox"
                                    id="delete_image_{{ $block_content->lang_id }}_{{ $i }}"
                                    name="delete_image_{{ $block_content->lang_id }}_{{ $i }}">
                                <label class="form-check-label"
                                    for="delete_image_{{ $block_content->lang_id }}_{{ $i }}">{{ __('Delete image') }}</label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mb-4"></div>
            @endfor
        @endif


        <!-- The template for adding new item -->
        <div class="form-group hide" id="ItemTemplate_{{ $block_content->lang_id }}">
            <div class="px-3 pt-2 bg-light mb-4">
                <div class="row">

                    <div class="form-group col-md-4 col-sm-6">
                        <label for="formFile" class="form-label">{{ __('Image') }}</label>
                        <input class="form-control" type="file" id="formFile" name="image_{{ $block_content->lang_id }}[]"
                            multiple>
                    </div>

                    <div class="form-group col-md-3 col-sm-6">
                        <label>{{ __('Title (used as "alt" tag)') }}</label>
                        <input type="text" class="form-control" name="title_{{ $block_content->lang_id }}[]" />
                    </div>

                    <div class="form-group col-md-3 col-sm-6">
                        <label>{{ __('Caption') }} ({{ __('optional') }})</label>
                        <input class="form-control" type="text" name="caption_{{ $block_content->lang_id }}[]">
                    </div>

                    <div class="form-group col-md-2 col-sm-6">
                        <label>{{ __('Position') }}</label>
                        <input type="text" class="form-control" name="position_{{ $block_content->lang_id }}[]" />
                    </div>

                    <div class="form-group col-md-4 col-sm-6">
                        <label>{{ __('URL') }} ({{ __('optional') }})</label>
                        <input type="text" class="form-control" name="url_{{ $block_content->lang_id }}[]">
                        <div class="text-muted small">
                            {{ __('If you add URL, the link is opened, instead images gallery player.') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="mb-3 mt-3">
            <button type="button" class="btn btn-gear addButton_{{ $block_content->lang_id }}"><i
                    class="bi bi-plus-circle"></i> {{ __('Add image') }} </button>
        </div>

        <script>
            $(document).ready(function () {
                urlIndex_{{ $block_content->lang_id }} = 0;
                $('#updateBlock')
                    // Add button click handler
                    .on('click', '.addButton_{{ $block_content->lang_id }}', function () {
                        urlIndex_{{ $block_content->lang_id }}++;
                        var $template = $('#ItemTemplate_{{ $block_content->lang_id }}'),
                            $clone = $template
                                .clone()
                                .removeClass('hide')
                                .removeAttr('id')
                                .attr('data-block-index', urlIndex_{{ $block_content->lang_id }})
                                .insertBefore($template);

                        // Update the name attributes
                        $clone
                            .find('[name="title_{{ $block_content->lang_id }}"]').attr('name', 'updateBlock[' + urlIndex_{{ $block_content->lang_id }} + '].title_{{ $block_content->lang_id }}').end()
                            .find('[name="image_{{ $block_content->lang_id }}"]').attr('name', 'updateBlock[' + urlIndex_{{ $block_content->lang_id }} + '].image_{{ $block_content->lang_id }}').end()
                            .find('[name="caption_{{ $block_content->lang_id }}"]').attr('name', 'updateBlock[' + urlIndex_{{ $block_content->lang_id }} + '].caption_{{ $block_content->lang_id }}').end()
                            .find('[name="position_{{ $block_content->lang_id }}"]').attr('name', 'updateBlock[' + urlIndex_{{ $block_content->lang_id }} + '].position_{{ $block_content->lang_id }}').end()
                            .find('[name="url_{{ $block_content->lang_id }}"]').attr('name', 'updateBlock[' + urlIndex_{{ $block_content->lang_id }} + '].url_{{ $block_content->lang_id }}').end();
                    })

            });
        </script>

        <div class="mb-4"></div>

        @if (count(admin_languages()) > 1 && !$loop->last)
            <hr>
        @endif
    @endforeach

    <div class="form-group">
        <input type="hidden" name="type" value="{{ $type }}">
        <input type="hidden" name="referer" value="{{ $referer }}">
        <button type="submit" class="btn btn-primary">{{ __('Update') }}</button>
        <button type="submit" name="submit_return_to_block" value="block"
            class="btn btn-light ms-3">{{ __('Update and return here') }}</button>
    </div>

</form>