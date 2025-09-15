<div class="form-group col-md-4 col-xl-2">
    <label>{{ __('Background style') }}</label>
    <select class="form-select" name="bg_style" id="bg_style" onchange="change_bg_style()">
        <option @if (($block_settings['bg_style'] ?? null) == 'color') selected @endif value="color">{{ __('Color') }}</option>
        <option @if (($block_settings['bg_style'] ?? null) == 'image') selected @endif value="image">{{ __('Image') }}</option>
    </select>
</div>

<script>
    function change_bg_style() {
        var select = document.getElementById('bg_style');
        var value = select.options[select.selectedIndex].value;
        if (value == 'color') {
            document.getElementById('hidden_div_bg_image').style.display = 'none';
        } else {
            document.getElementById('hidden_div_bg_image').style.display = 'block';
        }
    }
</script>


<div id="hidden_div_bg_image" style="display: @if (($block_settings['bg_style'] ?? null) == 'image') block @else none @endif">
    <div class="form-group col-xl-2 col-md-3 col-sm-4">
        <div class="form-check form-switch">
            <input class="form-check-input" type="checkbox" id="cover_dark" name="cover_dark" @if ($block_settings['cover_dark'] ?? null) checked @endif>
            <label class="form-check-label" for="cover_dark">{{ __('Add dark layer to background cover') }}</label>
        </div>
    </div>

    <div class="form-group col-xl-2 col-md-3 col-sm-4">
        <div class="form-check form-switch">
            <input class="form-check-input" type="checkbox" id="cover_fixed" name="cover_fixed" @if ($block_settings['cover_fixed'] ?? null) checked @endif>
            <label class="form-check-label" for="cover_fixed">{{ __('Fixed background') }}</label>
        </div>
    </div>

    <div class="form-group col-md-4">
        <label for="formFile" class="form-label">{{ __('Image') }}</label>
        <input class="form-control" type="file" id="formFile" name="bg_image">
    </div>

    @if ($block_settings['bg_media_id'] ?? null)
        <a target="_blank" href="{{ image($block_settings['bg_media_id']) }}"><img style="max-width: 300px; max-height: 100px;" src="{{ image($block_settings['bg_media_id'], 'small') }}" class="img-fluid mt-2"></a>
        <input type="hidden" name="existing_bg_media_id" value="{{ $block_settings['bg_media_id'] ?? null }}">

        <div class="form-group mb-0">
            <div class="form-check form-switch">
                <input type="hidden" name="delete_bg_media_id" value="{{ $block_settings['bg_media_id'] ?? null }}">
                <input class="form-check-input" type="checkbox" id="delete_bg_image" name="delete_bg_image">
                <label class="form-check-label" for="delete_bg_image">{{ __('Delete image') }}</label>
            </div>
        </div>
    @endif
</div>


<div class="col-md-4 col-lg-3 col-12 form-group">
    <label>{{ __('Interval duration (in seconds)') }}</label>
    <input class="form-control" type="number" step="1" min="0" name="delay_seconds" value="{{ $block_settings['delay_seconds'] ?? null }}">
    <div class="form-text">{{ 'Change the amount of time (in seconds) to delay between automatically cycling to the next item. Leave empty for no delay to next item' }}</div>
</div>


<h5 class="mb-3">{{ __('Block content') }}:</h5>

@foreach ($content_langs as $lang)
    @if (count($languages) > 1)
        <h5 class="mb-3">{!! flag($lang->code) !!} {{ $lang->name }}</h5>
    @endif

    @php
        $content_array = unserialize($lang->block_content ?? null);
    @endphp


    @if ($content_array)
        @for ($i = 0; $i < count($content_array); $i++)
            <div class="card p-3 bg-light mb-4">
                <div class="row">
                    <div class="col-md-6 col-12">
                        <div class="form-group">
                            <label>{{ __('Link title') }}</label>
                            <input type="text" class="form-control" name="title_{{ $lang->id }}[]" value="{{ $content_array[$i]['title'] ?? null }}">
                        </div>
                    </div>

                    <div class="col-md-6 col-12">
                        <div class="form-group">
                            <label>{{ __('Link') }} ({{ __('optional') }})</label>
                            <div class="input-group mb-1">
                                <span class="input-group-text" id="basic-addon1">https://</span>
                                <input type="text" class="form-control" name="url_{{ $lang->id }}[]" value="{{ $content_array[$i]['url'] ?? null }}">
                            </div>
                            <div class="form-text text-muted small">{{ __('If you add URL, a button with "Read more" will be added.') }}</div>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="form-group">
                            <label>{{ __('Content') }}</label>
                            <textarea class="form-control trumbowyg" name="content_{{ $lang->id }}[]">{{ $content_array[$i]['content'] ?? null }}</textarea>
                        </div>
                    </div>

                    <div class="col-md-6 col-12">
                        <div class="form-group">
                            <label for="formFile" class="form-label">{{ __('Image') }} ({{ __('optional') }})</label>
                            <input class="form-control" type="file" id="formFile" name="image_{{ $lang->id }}[]" multiple>
                            <div class="text-muted small">{{ __('Image file. Maximum 2.5 MB.') }} {{ __('If you do not add an image, the slider text will be displayed in full width') }}</div>

                            @if ($content_array[$i]['media_id'] ?? null)
                                <a target="_blank" href="{{ image($content_array[$i]['media_id']) }}"><img style="max-width: 300px; max-height: 100px;" src="{{ image($content_array[$i]['media_id'], 'small') }}"
                                        class="img-fluid mt-2"></a>
                                <input type="hidden" name="existing_image_{{ $lang->id }}[{{ $i }}]" value="{{ $content_array[$i]['media_id'] ?? null }}">

                                <div class="form-group mb-0">
                                    <div class="form-check form-switch">
                                        <input type="hidden" name="delete_image_media_id_{{ $lang->id }}_{{ $i }}" value="{{ $content_array[$i]['media_id'] ?? null }}">
                                        <input class="form-check-input" type="checkbox" id="delete_image_{{ $lang->id }}_{{ $i }}" name="delete_image_{{ $lang->id }}_{{ $i }}">
                                        <label class="form-check-label" for="delete_image_{{ $lang->id }}_{{ $i }}">{{ __('Delete image') }}</label>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="col-md-3 col-12">
                        <div class="form-group">
                            <label>{{ __('Position') }}</label>
                            <input type="text" class="form-control" name="position_{{ $lang->id }}[]" value="{{ $content_array[$i]['position'] ?? null }}">
                        </div>
                    </div>
                </div>
            </div>

            <div class="mb-4"></div>
        @endfor
    @endif


    <!-- The template for adding new item -->
    <div class="form-group hide" id="ItemTemplate_{{ $lang->id }}">
        <div class="row">
            <div class="col-md-6 col-12">
                <div class="form-group">
                    <label>{{ __('Title') }}</label>
                    <input type="text" class="form-control" name="title_{{ $lang->id }}[]" />
                </div>
            </div>

            <div class="col-md-6 col-12">
                <div class="form-group">
                    <label>{{ __('Link') }} ({{ __('optional') }})</label>
                    <div class="input-group mb-1">
                        <span class="input-group-text" id="basic-addon1">https://</span>
                        <input type="text" class="form-control" name="url_{{ $lang->id }}[]">
                    </div>
                    <div class="form-text text-muted small">{{ __('If you add URL, a button with "Read more" will be added.') }}</div>
                </div>
            </div>

            <div class="col-12">
                <div class="form-group">
                    <label>{{ __('Content') }}</label>
                    <textarea class="form-control trumbowyg_{{ $lang->id }}" name="content_{{ $lang->id }}[]"></textarea>
                </div>
            </div>

            <div class="col-md-6 col-12">
                <div class="form-group">
                    <label for="formFile" class="form-label">{{ __('Change image') }} ({{ __('optional') }})</label>
                    <input class="form-control" type="file" id="formFile" name="image_{{ $lang->id }}[]" multiple>
                    <div class="text-muted small">{{ __('Image file. Maximum 2.5 MB.') }} {{ __('If you do not add an image, the slider text will be displayed in full width') }}</div>                   
                </div>
            </div>

            <div class="col-md-3 col-12">
                <div class="form-group">
                    <label>{{ __('Position') }}</label>
                    <input type="text" class="form-control" name="position_{{ $lang->id }}[]" />
                </div>
            </div>
        </div>
        <div class="mb-4"></div>
    </div>

    <div class="mb-3 mt-3">
        <button type="button" class="btn btn-gear addButton_{{ $lang->id }}"><i class="bi bi-plus-circle"></i> {{ __('Add item') }} </button>
    </div>

    <script>
        $(document).ready(function() {
            urlIndex_{{ $lang->id }} = 0;
            $('#updateBlock')
                // Add button click handler
                .on('click', '.addButton_{{ $lang->id }}', function() {
                    urlIndex_{{ $lang->id }}++;
                    var $template = $('#ItemTemplate_{{ $lang->id }}'),
                        $clone = $template
                        .clone()
                        .removeClass('hide')
                        .removeAttr('id')
                        .attr('data-proforma-index', urlIndex_{{ $lang->id }})
                        .insertBefore($template);

                    // Update the name attributes
                    $clone
                        .find('[name="title_{{ $lang->id }}"]').attr('name', 'updateBlock[' + urlIndex_{{ $lang->id }} + '].title_{{ $lang->id }}').end()
                        .find('[name="url_{{ $lang->id }}"]').attr('name', 'updateBlock[' + urlIndex_{{ $lang->id }} + '].url_{{ $lang->id }}').end()
                        .find('[name="content_{{ $lang->id }}"]').attr('name', 'updateBlock[' + urlIndex_{{ $lang->id }} + '].content_{{ $lang->id }}').end()
                        .find('[name="image_{{ $lang->id }}"]').attr('name', 'updateBlock[' + urlIndex_{{ $lang->id }} + '].image_{{ $lang->id }}').end()
                        .find('[name="position_{{ $lang->id }}"]').attr('name', 'updateBlock[' + urlIndex_{{ $lang->id }} + '].position_{{ $lang->id }}').end()
                        .find('textarea').trumbowyg();
                })
        });
    </script>

    <div class="mb-4"></div>


    @if (count($languages) > 1 && !$loop->last)
        <hr>
    @endif
@endforeach
