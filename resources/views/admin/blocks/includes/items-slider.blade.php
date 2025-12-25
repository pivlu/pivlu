<div class="card">

    <div class="card-header">
        <div class="row">
            <div class="col-12 col-sm-5 col-md-6 order-md-1 order-first">
                <h4 class="card-title">{{ __('Manage slides') }}</h4>
            </div>

            <div class="col-12 col-sm-7 col-md-6 order-md-2 order-last">
                <div class="float-end">
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#create-item"><i class="bi bi-plus-circle"></i> {{ __('Add new slide') }}</button>
                    @include('admin.blocks.includes.modal-create-slider-item')
                </div>
            </div>
        </div>

        <hr>

    </div>

    <div class="card-body">

        <div class="sortable" id="sortable_top">
            @foreach ($content_array as $content_item)
                <div class="builder-block movable" id="item-{{ $content_item['code'] }}">

                    <a href="#" data-bs-toggle="modal" data-bs-target=".confirm-{{ $content_item['code'] }}" class="btn btn-danger btn-sm float-end ms-2"><i class="bi bi-trash"></i></a>
                    <div class="modal fade confirm-{{ $content_item['code'] }}" tabindex="-1" role="dialog" aria-labelledby="ConfirmDeleteLabel" aria-hidden="true">
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
                                    <form method="POST" action="{{ route('admin.block.delete-item', ['type' => 'slider', 'block_id' => $block->id, 'code' => $content_item['code']]) }}">
                                        {{ csrf_field() }}
                                        {{ method_field('DELETE') }}
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('Close') }}</button>
                                        <button type="submit" class="btn btn-danger">{{ __('Yes. Delete') }}</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <a href="#" data-bs-toggle="modal" data-bs-target=".update-{{ $content_item['code'] }}" class="btn btn-primary btn-sm float-end ms-2"><i class="bi bi-pencil-square"></i></a>
                    <div class="modal fade update-{{ $content_item['code'] }}" tabindex="-1" role="dialog" aria-labelledby="ConfirmUpdateLabel-{{ $content_item['code'] }}" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">

                                <form method="post" enctype="multipart/form-data" action="{{ route('admin.block.update-item', ['type' => 'slider', 'block_id' => $block->id]) }}">
                                    @csrf
                                    @method('PUT')

                                    <div class="modal-header">
                                        <h5 class="modal-title" id="ConfirmUpdateLabel-{{ $content_item['code'] }}">{{ __('Update') }}</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        @foreach (admin_languages() as $item_lang)
                                            @php
                                                $item_data = get_block_content_item($block->id, $item_lang->id, $content_item['code']);
                                            @endphp

                                            <div class="form-group">
                                                <label for="formFile_{{ $item_lang->id }}" class="form-label">{{ __('Change image') }} ({{ __('optional') }})</label>
                                                <input class="form-control" type="file" id="formFile_{{ $item_lang->id }}" name="image_{{ $item_lang->id }}">
                                            </div>

                                            <div class="form-group">
                                                <label>{{ __('Title') }}
                                                    @if (count(admin_languages()) > 1)
                                                        - {!! flag($item_lang->code) !!} {{ $item_lang->name }}
                                                    @endif
                                                </label>
                                                <input type="text" class="form-control" name="title_{{ $item_lang->id }}" value="{{ $item_data->title ?? null }}" />
                                            </div>

                                            <div class="form-group">
                                                <label>{{ __('Content') }}
                                                    @if (count(admin_languages()) > 1)
                                                        - {!! flag($item_lang->code) !!} {{ $item_lang->name }}
                                                    @endif
                                                </label>
                                                <textarea rows="4" class="form-control" name="content_{{ $item_lang->id }}">{{ $item_data->content ?? null }}</textarea>
                                            </div>

                                            <div class="form-group">
                                                <label>{{ __('URL') }} ({{ __('optional') }})
                                                    @if (count(admin_languages()) > 1)
                                                        - {!! flag($item_lang->code) !!} {{ $item_lang->name }}
                                                    @endif
                                                </label>
                                                <input type="text" class="form-control" name="url_{{ $item_lang->id }}" value="{{ $item_data->url ?? null }}">
                                            </div>

                                            <input type="hidden" name="media_id_{{ $item_lang->id }}" value="{{ $item_data->media_id ?? null }}">
                                            <input type="hidden" name="code_{{ $item_lang->id }}" value="{{ $item_data->code ?? null }}">

                                            @if (count(admin_languages()) > 1 && !$loop->last)
                                                <hr>
                                            @endif
                                        @endforeach
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-primary">{{ __('Update') }}</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    @if ($content_item['media_id'])
                        <a target="_blank" href="{{ image($content_item['media_id']) }}"><img class="float-start me-2" style="width: 90px; height: 90px; background-color:white"
                                src="{{ image($content_item['media_id'], 'thumb_square') }}" class="img-fluid mt-2"></a>
                    @endif

                    <div>
                        <b>{{ __('Title') }}:</b> {{ $content_item['title'] ?? null }}
                    </div>

                    <div>
                        <b>{{ __('Content') }}:</b> {{ $content_item['content'] ?? '-' }}
                    </div>

                    <div>
                        <b>{{ __('URL') }}:</b> {{ $content_item['url'] ?? '-' }}
                    </div>

                    <div>
                        <b>{{ __('Icon') }}:</b> {!! $content_item['icon'] ?? '-' !!}
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
                    url: "{{ route('admin.block.sortable-items', ['type' => 'slider', 'block_id' => $block->id]) }}",
                });
            }
        });
        $("#sortable_top").disableSelection();

    });
</script>
