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

            @foreach ($block->all_languages_contents as $block_content)
                @if (count(admin_languages()) > 1)
                    <h5 class="mb-3">{!! flag($block_content->lang_code) !!} {{ $block_content->lang_name }}</h5>
                @endif

                @php
                    $content_array = json_decode($block_content->content, true);
                @endphp

                @if ($content_array)
                    @for ($i = 0; $i < count($content_array); $i++)
                        <div class="card px-3 py-2 bg-light mb-4">
                            <div class="row">

                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label>{{ __('Link title') }}</label>
                                        <input type="text" class="form-control" name="title_{{ $block_content->lang_id }}[]" value="{{ $content_array[$i]['title'] ?? null }}">
                                    </div>
                                </div>

                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label>{{ __('Link') }} ({{ __('optional') }})</label>
                                        <div class="input-group mb-1">
                                            <span class="input-group-text" id="basic-addon1">https://</span>
                                            <input type="text" class="form-control" name="url_{{ $block_content->lang_id }}[]" value="{{ $content_array[$i]['url'] ?? null }}">
                                        </div>
                                        <div class="form-text text-muted small">{{ __('If you add URL, a button with "Read more" will be added.') }}</div>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="form-group">
                                        <label>{{ __('Content') }}</label>
                                        <textarea class="form-control trumbowyg" name="content_{{ $block_content->lang_id }}[]">{{ $content_array[$i]['content'] ?? null }}</textarea>
                                    </div>
                                </div>

                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="formFile" class="form-label">{{ __('Image') }} ({{ __('optional') }})</label>
                                        <input class="form-control" type="file" id="formFile" name="image_{{ $block_content->lang_id }}[]" multiple>
                                        <div class="text-muted small">{{ __('Image file. Maximum 2.5 MB.') }} {{ __('If you do not add an image, the slider text will be displayed in full width') }}</div>

                                        @if ($content_array[$i]['media_id'] ?? null)
                                            <a target="_blank" href="{{ image($content_array[$i]['media_id']) }}"><img style="max-width: 300px; max-height: 100px;"
                                                    src="{{ image($content_array[$i]['media_id'], 'small') }}" class="img-fluid mt-2"></a>
                                            <input type="hidden" name="existing_image_{{ $block_content->lang_id }}[{{ $i }}]" value="{{ $content_array[$i]['media_id'] ?? null }}">

                                            <div class="form-group mb-0 mt-2">
                                                <div class="form-check form-switch">
                                                    <input type="hidden" name="delete_image_media_id_{{ $block_content->lang_id }}_{{ $i }}" value="{{ $content_array[$i]['media_id'] ?? null }}">
                                                    <input class="form-check-input" type="checkbox" id="delete_image_{{ $block_content->lang_id }}_{{ $i }}"
                                                        name="delete_image_{{ $block_content->lang_id }}_{{ $i }}">
                                                    <label class="form-check-label" for="delete_image_{{ $block_content->lang_id }}_{{ $i }}">{{ __('Delete image') }}</label>
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-3 col-12">
                                    <div class="form-group">
                                        <label>{{ __('Position') }}</label>
                                        <input type="text" class="form-control" name="position_{{ $block_content->lang_id }}[]" value="{{ $content_array[$i]['position'] ?? null }}">
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

                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label>{{ __('Title') }}</label>
                                    <input type="text" class="form-control" name="title_{{ $block_content->lang_id }}[]" />
                                </div>
                            </div>

                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label>{{ __('Link') }} ({{ __('optional') }})</label>
                                    <div class="input-group mb-1">
                                        <span class="input-group-text" id="basic-addon1">https://</span>
                                        <input type="text" class="form-control" name="url_{{ $block_content->lang_id }}[]">
                                    </div>
                                    <div class="form-text text-muted small">{{ __('If you add URL, a button with "Read more" will be added.') }}</div>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="form-group">
                                    <label>{{ __('Content') }}</label>
                                    <textarea class="form-control trumbowyg_{{ $block_content->lang_id }}" name="content_{{ $block_content->lang_id }}[]"></textarea>
                                </div>
                            </div>

                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="formFile" class="form-label">{{ __('Change image') }} ({{ __('optional') }})</label>
                                    <input class="form-control" type="file" id="formFile" name="image_{{ $block_content->lang_id }}[]" multiple>
                                    <div class="text-muted small">{{ __('Image file. Maximum 2.5 MB.') }} {{ __('If you do not add an image, the slider text will be displayed in full width') }}</div>
                                </div>
                            </div>

                            <div class="col-md-3 col-12">
                                <div class="form-group">
                                    <label>{{ __('Position') }}</label>
                                    <input type="text" class="form-control" name="position_{{ $block_content->lang_id }}[]" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mb-3 mt-3">
                    <button type="button" class="btn btn-gear addButton_{{ $block_content->lang_id }}"><i class="bi bi-plus-circle"></i> {{ __('Add slide') }} </button>
                </div>

                <script>
                    $(document).ready(function() {
                        urlIndex_{{ $block_content->lang_id }} = 0;
                        $('#updateBlock')
                            // Add button click handler
                            .on('click', '.addButton_{{ $block_content->lang_id }}', function() {
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
                                    .find('[name="url_{{ $block_content->lang_id }}"]').attr('name', 'updateBlock[' + urlIndex_{{ $block_content->lang_id }} + '].url_{{ $block_content->lang_id }}').end()
                                    .find('[name="content_{{ $block_content->lang_id }}"]').attr('name', 'updateBlock[' + urlIndex_{{ $block_content->lang_id }} + '].content_{{ $block_content->lang_id }}').end()
                                    .find('[name="image_{{ $block_content->lang_id }}"]').attr('name', 'updateBlock[' + urlIndex_{{ $block_content->lang_id }} + '].image_{{ $block_content->lang_id }}').end()
                                    .find('[name="position_{{ $block_content->lang_id }}"]').attr('name', 'updateBlock[' + urlIndex_{{ $block_content->lang_id }} + '].position_{{ $block_content->lang_id }}').end()
                                    .find('textarea').trumbowyg();
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
                <button type="submit" class="btn btn-primary">{{ __('Update') }}</button>
            </div>

        </form>

    </div>
</div>
