<div class="card">

    <div class="card-header">
        <div class="row">
            <div class="col-12 col-sm-5 col-md-6 order-md-1 order-first">
                <h4 class="card-title">{{ __('Manage cards') }}</h4>
            </div>

            <div class="col-12 col-sm-7 col-md-6 order-md-2 order-last">
                <div class="float-end">
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#create-item"><i class="bi bi-plus-circle"></i> {{ __('Add new card') }}</button>
                    @include('pivlu::admin.blocks.includes.modal-create-card-item')
                </div>
            </div>
        </div>

        <hr>

    </div>

    <div class="card-body">

        <div class="sortable" id="sortable_top">
            @foreach ($block_items as $block_item)
                @php
                    $block_item_default_lang_content = $block_item->default_language_content;
                    $block_item_content_data = json_decode($block_item_default_lang_content->data ?? null);
                @endphp

                <div class="builder-block movable d-block" style="height: 135px" id="item-{{ $block_item['id'] ?? '-' }}">

                    <a href="#" data-bs-toggle="modal" data-bs-target=".confirm-{{ $block_item['id'] ?? '-' }}" class="btn btn-danger btn-sm float-end ms-2 mb-2"><i class="bi bi-trash"></i></a>
                    <div class="modal fade confirm-{{ $block_item['id'] ?? '-' }}" tabindex="-1" role="dialog" aria-labelledby="ConfirmDeleteLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="ConfirmDeleteLabel">{{ __('Confirm delete') }}</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    {{ __('Are you sure you want to delete this item?') }}
                                </div>
                                <div class="modal-footer">
                                    <form method="POST" action="{{ route('admin.block.delete-item', ['block_item_id' => $block_item['id']]) }}">
                                        {{ csrf_field() }}
                                        {{ method_field('DELETE') }}
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('Close') }}</button>
                                        <button type="submit" class="btn btn-danger">{{ __('Yes. Delete') }}</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <a href="#" data-bs-toggle="modal" data-bs-target=".update-{{ $block_item['id'] ?? '-' }}" class="btn btn-primary btn-sm float-end ms-2 mb-2"><i class="bi bi-pencil-square"></i></a>
                    <div class="modal fade update-{{ $block_item['id'] ?? '-' }}" tabindex="-1" role="dialog" aria-labelledby="ConfirmUpdateLabel-{{ $block_item['id'] ?? '-' }}" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">

                                <form method="post" action="{{ route('admin.block.update-item', ['type' => 'card', 'block_id' => $block->id]) }}" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')

                                    <div class="modal-header">
                                        <h5 class="modal-title" id="ConfirmUpdateLabel-{{ $block_item['id'] ?? '-' }}">{{ __('Update') }}</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>

                                    <div class="modal-body">
                                        @foreach (admin_languages() as $item_lang)
                                            @php
                                                $block_item_content = get_block_content_item($block_item['id'], $item_lang->id) ?? null;
                                                $block_item_data = json_decode($block_item_content->data ?? null);
                                            @endphp

                                            @if ($block_item_content ?? null)
                                                <div class="form-group mb-3">
                                                    <a target="_blank" href="{{ $block_item_content->getFirstMediaUrl('block_item_media', 'large') }}">
                                                        <img src="{{ $block_item_content->getFirstMediaUrl('block_item_media', 'thumb') }}" class="img-fluid rounded">
                                                    </a>
                                                </div>
                                            @endif

                                            <div class="form-group mb-3">
                                                <label for="formFile_{{ $item_lang->id }}" class="form-label">{!! lang_label($item_lang, __('Change image')) !!}</label>
                                                <input class="form-control" type="file" id="formFile_{{ $item_lang->id }}" name="image_{{ $item_lang->id }}">
                                            </div>

                                            <div class="form-group">
                                                <label>{!! lang_label($item_lang, __('Title')) !!}</label>
                                                <input type="text" class="form-control line-clamp-1" name="title_{{ $item_lang->id }}" value="{{ $block_item_data->title ?? null }}" />
                                            </div>

                                            <div class="form-group">
                                                <label>{!! lang_label($item_lang, __('Content')) !!}</label>
                                                <textarea rows="4" class="form-control line-clamp-1" name="content_{{ $item_lang->id }}">{{ $block_item_data->content ?? null }}</textarea>
                                            </div>

                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label class="mb-2">{!! lang_label($item_lang, __('URL')) !!}</label>
                                                        <div class="input-group">
                                                            <span class="input-group-text" id="url-addon_{{ $item_lang->id }}">https://</span>
                                                            <input type="text" class="form-control" placeholder="URL" aria-label="URL" aria-describedby="url-addon_{{ $item_lang->id }}"
                                                                name="url_{{ $item_lang->id }}" value="{{ $block_item_data->url ?? null }}">
                                                        </div>
                                                        <div class="form-text">{{ __('Optional. Without "https://"') }}</div>
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="mb-2">{!! lang_label($item_lang, __('Icon')) !!}</label>
                                                        <input class="form-control" type="text" name="icon_{{ $item_lang->id }}" value="{{ $block_item_data->icon ?? null }}">
                                                        <div class="form-text">{{ __('optional') }}</div>
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="mb-2">{!! lang_label($item_lang, __('Button label - if buttons are enabled')) !!}</label>
                                                        <input class="form-control" type="text" name="button_label_{{ $item_lang->id }}" value="{{ $block_item_data->button_label ?? null }}">
                                                        <div class="form-text">{{ __('optional') }}</div>
                                                    </div>
                                                </div>
                                            </div>

                                            @if (count(admin_languages()) > 1 && !$loop->last)
                                                <hr>
                                            @endif
                                        @endforeach
                                    </div>
                                    <div class="modal-footer">
                                        <input type="hidden" name="block_item_id" value="{{ $block_item['id'] ?? null }}">
                                        <button type="submit" class="btn btn-primary">{{ __('Update') }}</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    @if ($block_item_default_lang_content->media_id)
                        <a target="_blank" href="{{ $block_item_default_lang_content->getFirstMediaUrl('block_item_media', 'large') }}">
                            <img class="float-start img-fluid me-2 rounded" style="width: 120px; max-height: 100px;" src="{{ $block_item_default_lang_content->getFirstMediaUrl('block_item_media', 'thumb') }}">
                        </a>
                    @endif

                    <div class="text-clamp-2">
                        <b>{{ $block_item_content_data->title ?? null }}</b>
                    </div>

                    <div class="text-clamp-2 text-muted">
                        {{ $block_item_content_data->content ?? '-' }}
                    </div>

                    <div class="text-clamp-1 small text-muted">
                        @if ($block_item_content_data->url ?? null)
                            <a target="_blank" href="{{ $block_item_content_data->url }}">{{ $block_item_content_data->url }}</a>
                        @endif
                    </div>

                    <div class="clearfix"></div>
                </div>
            @endforeach

        </div>
    </div>

</div>

<meta name="csrf-token" content="{{ csrf_token() }}">
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>
    $(function() {

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $("#sortable_top").sortable({
            axis: 'y',
            opacity: 0.8,
            revert: true,

            update: function(event, ui) {
                var data = $(this).sortable('serialize');
                $.ajax({
                    data: data,
                    type: 'POST',
                    url: "{{ route('admin.block.sortable-items', ['type' => 'card', 'block_id' => $block->id]) }}",
                });
            }
        });
        $("#sortable_top").disableSelection();

    });
</script>
