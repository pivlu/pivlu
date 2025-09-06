@include('admin.includes.trumbowyg-assets')

<div class="page-title">
    <div class="row">
        <div class="col-12">
            <nav aria-label="breadcrumb" class="breadcrumb-header">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin') }}">{{ __('Dashboard') }}</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.block-components') }}">{{ __('Block components') }}</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.block-components.type', ['type' => $type]) }}">{{ ucfirst($type) }}</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ $block->label }}</li>
                </ol>
            </nav>
        </div>
    </div>
</div>

<div class="card">

    @include('admin.blocks.includes.menu-blocks')

    <div class="card-body">

        @if ($message = Session::get('success'))
            <div class="alert alert-success">
                @if ($message == 'created')
                    {{ __('Created') }}
                @endif
                @if ($message == 'updated')
                    {{ __('Updated') }}
                @endif
                @if ($message == 'deleted')
                    {{ __('Deleted') }}
                @endif
            </div>
        @endif

        <form id="updateBlock" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-group col-lg-4 col-md-6">
                <label class="form-label" for="blockLabel">{{ __('Label') }} ({{ __('optional') }})</label>
                <input class="form-control" type="text" id="blockLabel" name="label" value="{{ $block->label }}">
                <div class="form-text">{{ __('Input a label to identify this block. Label is not visible in website') }}</div>
            </div>

            <div class="form-group">
                <div class="form-check form-switch mb-0">
                    <input class="form-check-input" type="checkbox" id="active" name="active" @if ($block->active ?? null) checked @endif>
                    <label class="form-check-label" for="active">{{ __('Active') }}</label>
                </div>
                <div class="form-text">{{ __('Only active blocks are displayed on website') }}</div>
            </div>

            <hr>

            <div class="form-group mb-0 mt-3">
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" id="use_image" name="use_image" @if ($settings->use_image ?? null) checked @endif>
                    <label class="form-check-label" for="use_image">{{ __('Use image') }}</label>
                </div>
            </div>

            <script>
                $('#use_image').change(function() {
                    select = $(this).prop('checked');
                    if (select) {
                        document.getElementById('hidden_div_image').style.display = 'block';
                        document.getElementById('hidden_div_bg_color').style.display = 'none';
                    } else {
                        document.getElementById('hidden_div_image').style.display = 'none';
                        document.getElementById('hidden_div_bg_color').style.display = 'block';
                    }
                })
            </script>

            <div id="hidden_div_image" style="display: @if (isset($settings->use_image)) block @else none @endif" class="mt-2">

                <div class="form-group col-md-4 col-xl-2">
                    <label>{{ __('Image position') }}</label>
                    <select class="form-select" name="image_position" id="image_position" onchange="change_image_position()">
                        <option @if (($settings->image_position ?? null) == 'top') selected @endif value="top">{{ __('Top (above text content)') }}</option>
                        <option @if (($settings->image_position ?? null) == 'bottom') selected @endif value="bottom">{{ __('Bottom (below text content)') }}</option>
                        <option @if (($settings->image_position ?? null) == 'right') selected @endif value="right">{{ __('Right') }}</option>
                        <option @if (($settings->image_position ?? null) == 'left') selected @endif value="left">{{ __('Left') }}</option>
                        <option @if (($settings->image_position ?? null) == 'cover') selected @endif value="cover">{{ __('Background cover') }}</option>
                    </select>
                </div>

                <div class="form-group col-md-4">
                    <label for="formFile" class="form-label">{{ __('Image') }}</label>
                    <input class="form-control" type="file" id="formFile" name="image">
                    <div class="text-muted small">{{ __('Image file. Maximum 5 MB.') }}</div>
                </div>
                @if ($settings->media_id ?? null)
                    <a target="_blank" href="{{ image($settings->media_id) }}"><img style="max-width: 300px; max-height: 100px;" src="{{ image($settings->media_id) }}" class="img-fluid"></a>
                    <input type="hidden" name="existing_image" value="{{ $settings->media_id ?? null }}">
                @endif

                <script>
                    function change_image_position() {
                        var select = document.getElementById('image_position');
                        var value = select.options[select.selectedIndex].value;
                        if (value == 'cover') {
                            document.getElementById('hidden_div_not_cover').style.display = 'none';
                            document.getElementById('hidden_div_cover').style.display = 'block';
                        } else {
                            document.getElementById('hidden_div_not_cover').style.display = 'block';
                            document.getElementById('hidden_div_cover').style.display = 'none';
                        }

                        if (value == 'left' || value == 'right') {
                            document.getElementById('hidden_div_left_right').style.display = 'block';
                            document.getElementById('hidden_div_top_bottom').style.display = 'none';
                        } else {
                            document.getElementById('hidden_div_left_right').style.display = 'none';
                            document.getElementById('hidden_div_top_bottom').style.display = 'block';
                        }
                    }
                </script>

                <div id="hidden_div_not_cover" style="display: @if (($settings->image_position ?? null) == 'cover') none @else block @endif" class="mt-4">
                    <div class="form-group mb-3">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="shadow" name="shadow" @if ($settings->shadow ?? null) checked @endif>
                            <label class="form-check-label" for="shadow">{{ __('Add shadow to image') }}</label>
                        </div>
                    </div>

                    <div class="form-group mb-3">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="img_click" name="img_click" @if ($settings->img_click ?? null) checked @endif>
                            <label class="form-check-label" for="img_click">{{ __('Clickable image') }}</label>
                        </div>
                    </div>

                    <div id="hidden_div_left_right" style="display: @if (($settings->image_position ?? null) == 'left' || ($settings->image_position ?? null) == 'right') block @else none @endif" class="mt-4">
                        <div class="col-md-4 col-lg-3 col-xl-2 col-12 form-group mt-2">
                            <label class="form-label">{{ __('Image column width') }}</label>
                            <select name="img_col" class="form-select">
                                <option @if (($settings->img_col ?? null) == '50') selected @endif value="50">{{ __('1/2 (50%)') }}</option>
                                <option @if (($settings->img_col ?? null) == '33') selected @endif value="33">{{ __('1/3 (33%)') }}</option>
                                <option @if (($settings->img_col ?? null) == '25') selected @endif value="25">{{ __('1/4 (25%)') }}</option>
                            </select>
                        </div>
                    </div>

                    <div id="hidden_div_top_bottom" style="display: @if (($settings->image_position ?? null) == 'top' || ($settings->image_position ?? null) == 'bottom') block @else none @endif" class="mt-4">
                        <div class="col-md-4 col-lg-3 col-xl-2 col-12 form-group mt-2">
                            <label class="form-label">{{ __('Image width') }}</label>
                            <select name="img_container_width" class="form-select">
                                <option @if (($settings->img_container_width ?? null) == 'col-12') selected @endif value="col-12">{{ __('Full width') }}</option>
                                <option @if (($settings->img_container_width ?? null) == 'col-12 col-md-8 offset-md-2') selected @endif value="col-12 col-md-8 offset-md-2">{{ __('75%') }}</option>
                                <option @if (($settings->img_container_width ?? null) == 'col-12 col-md-6 offset-md-3') selected @endif value="col-12 col-md-6 offset-md-3">{{ __('50%') }}</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div id="hidden_div_cover" style="display: @if (($settings->use_image ?? null) && ($settings->image_position ?? null) == 'cover') ) block @else none @endif" class="mt-4">
                    <div class="form-group col-xl-2 col-md-3 col-sm-4">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="cover_dark" name="cover_dark" @if ($settings->cover_dark ?? null) checked @endif>
                            <label class="form-check-label" for="cover_dark">{{ __('Add dark layer to background cover') }}</label>
                        </div>
                    </div>

                    <div class="form-group col-xl-2 col-md-3 col-sm-4">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="cover_fixed" name="cover_fixed" @if ($settings->cover_fixed ?? null) checked @endif>
                            <label class="form-check-label" for="cover_fixed">{{ __('Fixed background') }}</label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4 col-lg-3 col-xl-2 col-12 form-group">
                    <label>{{ __('Padding (top / bottom)') }}</label>
                    <div class="input-group mb-1">
                        <input type="text" class="form-control" name="padding_y" aria-describedby="addonPadding" value="{{ $settings->padding_y ?? null }}">
                        <span class="input-group-text" id="addonPadding">px</span>
                    </div>
                    <div class="form-text">{{ __('Leave empty for default padding value') }}</div>
                </div>
            </div>

            <div class="form-group mb-3">
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" id="shadow_title" name="shadow_title" @if ($settings->shadow_title ?? null) checked @endif>
                    <label class="form-check-label" for="shadow_title">{{ __('Add shadow to title text') }}</label>
                </div>
            </div>

            <div class="form-group mb-3">
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" id="shadow_content" name="shadow_content" @if ($settings->shadow_content ?? null) checked @endif>
                    <label class="form-check-label" for="shadow_content">{{ __('Add shadow to content text') }}</label>
                </div>
            </div>

            @foreach ($block->all_languages_contents as $block_content)
                @if (count(admin_languages()) > 1)
                    <h5 class="mb-3">{!! flag($block_content->lang_code) !!} {{ $block_content->lang_name }}</h5>
                @endif

                @php
                    $content_array = json_decode($block_content->content, true);
                @endphp


                <div class="form-group">
                    <label>{{ __('Title') }}</label>
                    <input class="form-control" name="title_{{ $block_content->lang_id }}" value="{{ $content_array['title'] ?? null }}">
                </div>

                <div class="form-group">
                    <label>{{ __('Content') }}</label>
                    <textarea class="form-control trumbowyg" name="content_{{ $block_content->lang_id }}">{{ $content_array['content'] ?? null }}</textarea>
                </div>

                <div class="row">
                    <div class="col-md-4 col-lg-3 col">
                        <div class="form-group">
                            <label>{{ __('Button 1 style') }} [<a target="_blank" href="{{ route('admin.theme-buttons.index') }}">{{ __('Manage buttons') }}</a>]</label>
                            <select class="form-select" name="btn1_id_{{ $block_content->lang_id }}">
                                @foreach ($buttons as $button)
                                    <option @if (($content_array['btn1_id'] ?? null) == $button->id) selected @endif value="{{ $button->id }}">{{ $button->label }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-md-4 col-lg-3 col-xl-2">
                        <div class="form-group">
                            <label>{{ __('Button 1 label') }}</label>
                            <input type="text" class="form-control" name="btn1_label_{{ $block_content->lang_id }}" value="{{ $content_array['btn1_label'] ?? null }}">
                            <div class="form-text">{{ __('Leave empty to hide button') }}</div>
                        </div>
                    </div>

                    <div class="col-md-4 col-lg-3">
                        <div class="form-group">
                            <label>{{ __('Button 1 URL') }}</label>
                            <input type="text" class="form-control" name="btn1_url_{{ $block_content->lang_id }}" value="{{ $content_array['btn1_url'] ?? null }}">
                        </div>
                    </div>


                    <div class="col-md-4 col-lg-3 col-xl-2">
                        <div class="form-group">
                            <label>{{ __('Button 1 icon') }} ({{ __('optional') }})</label>
                            <input type="text" class="form-control" name="btn1_icon_{{ $block_content->lang_id }}" value="{{ $content_array['btn1_icon'] ?? null }}">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4 col-lg-3">
                        <div class="form-group">
                            <label>{{ __('Button 2 style') }} [<a target="_blank" href="{{ route('admin.theme-buttons.index') }}">{{ __('Manage buttons') }}</a>]</label>
                            <select class="form-select" name="btn2_id_{{ $block_content->lang_id }}">
                                @foreach ($buttons as $button)
                                    <option @if (($content_array['btn2_id'] ?? null) == $button->id) selected @endif value="{{ $button->id }}">{{ $button->label }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-md-4 col-lg-3 col-xl-2">
                        <div class="form-group">
                            <label>{{ __('Button 2 label') }}</label>
                            <input type="text" class="form-control" name="btn2_label_{{ $block_content->lang_id }}" value="{{ $content_array['btn2_label'] ?? null }}">
                            <div class="form-text">{{ __('Leave empty to hide button') }}</div>
                        </div>
                    </div>

                    <div class="col-md-4 col-lg-3">
                        <div class="form-group">
                            <label>{{ __('Button 2 URL') }}</label>
                            <input type="text" class="form-control" name="btn2_url_{{ $block_content->lang_id }}" value="{{ $content_array['btn2_url'] ?? null }}">
                        </div>
                    </div>


                    <div class="col-md-4 col-lg-3 col-xl-2">
                        <div class="form-group">
                            <label>{{ __('Button 2 icon') }} ({{ __('optional') }})</label>
                            <input type="text" class="form-control" name="btn2_icon_{{ $block_content->lang_id }}" value="{{ $content_array['btn2_icon'] ?? null }}">
                        </div>
                    </div>
                </div>


                <div class="mb-4"></div>

                @if (count(admin_languages()) > 1 && !$loop->last)
                    <hr>
                @endif
            @endforeach

            <div class="form-group">
                <input type="hidden" name="type" value="{{ $type }}">
                <button type="submit" class="btn btn-primary">{{ __('Update') }}</button>
            </div>

        </form>

    </div>
</div>
