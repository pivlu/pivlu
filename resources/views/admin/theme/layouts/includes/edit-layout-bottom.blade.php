<div class="col-12">
    <div class="builder-col sortable" id="sortable_bottom">
        <div class="mb-4 text-center">
            <div class="fw-bold fs-5">{{ __('Bottom content') }}</div>
            <a class="btn btn-danger" href="#" data-bs-toggle="modal" data-bs-target="#addBlock-bottom"><i class="bi bi-plus-circle"></i>
                {{ __('Add content block') }}</a>
            @include('admin.theme.layouts.includes.modal-create-layout-block', ['section' => 'bottom'])
        </div>

        @foreach (layout_blocks($item->id, 'bottom', $show_hidden = 1) as $block)
            <div class="builder-block movable" id="item-{{ $block->id }}">
                <div class="float-end ms-2">
                    @if ($block->hide == 1)
                        <div class="badge bg-danger fs-6 me-2">{{ __('Hidden') }}</div>
                    @endif

                    <a href="{{ route('admin.theme.layouts.block', ['id' => $block->id]) }}" class="btn btn-primary btn-sm">{{ __('Manage content') }}</a>
                    <a href="#" data-bs-toggle="modal" data-bs-target=".confirm-{{ $block->id }}" class="btn btn-outline-danger btn-sm ms-2"><i class="bi bi-trash"></i></a>
                    <div class="modal fade confirm-{{ $block->id }}" tabindex="-1" role="dialog" aria-labelledby="ConfirmDeleteLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="ConfirmDeleteLabel">{{ __('Confirm delete') }}</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    {{ __('Are you sure you want to remove this block? Block content will be deleted also.') }}
                                </div>
                                <div class="modal-footer">
                                    <form method="POST" action="{{ route('admin.theme.layouts.content.delete', ['id' => $item->id, 'block_id' => $block->id]) }}">
                                        {{ csrf_field() }}
                                        {{ method_field('DELETE') }}
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('Close') }}</button>
                                        <button type="submit" class="btn btn-danger">{{ __('Yes. Delete') }}</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                @if ($block->label)
                    <div class="listing">{{ $block->label }}</div>
                @endif

                <b>
                    @include('admin.includes.block_type_label', ['type' => $block->type])
                </b>

                @if ($block->updated_at)
                    <div class="small text-muted">{{ __('Updated at') }}: {{ date_locale($block->updated_at, 'datetime') }}</div>
                @endif

            </div>
        @endforeach
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

        $("#sortable_bottom").sortable({
            axis: 'y',
            opacity: 0.8,
            revert: true,

            update: function(event, ui) {
                var data = $(this).sortable('serialize');
                $.ajax({
                    data: data,
                    type: 'POST',
                    url: "{{ route('admin.theme.layouts.sortable', ['id' => $item->id, 'section' => 'bottom']) }}",
                });
            }
        });
        $("#sortable_bottom").disableSelection();

    });
</script>
