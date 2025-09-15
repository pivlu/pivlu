    <div class="row">

        <div class="col-md-3 col-sm-6 col-12">
            <div class="builder-col sortable" id="sortable_1">
                <div class="mb-4 text-center">
                    <a class="btn btn-danger" href="#" data-bs-toggle="modal" data-bs-target="#addBlock1"><i class="bi bi-plus-circle"></i>
                        {{ __('Add content block') }}</a>
                    @include('admin.theme.footer.includes.modal-add-footer-block', ['col' => 1])
                </div>

                @foreach (footer_blocks($theme->id, $footer, $col = 1) as $block)
                    <div class="builder-block movable" id="item-{{ $block->id }}">
                        <div class="float-end ms-2">
                            <a href="{{ route('admin.theme-footer.block', ['id' => $block->id, 'footer' => $footer, 'slug' => $theme->slug]) }}" class="btn btn-primary btn-sm">{{ __('Manage content') }}</a>
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
                                            <form method="POST" action="{{ route('admin.theme-footer.content.delete', ['footer' => $footer, 'block_id' => $block->id, 'slug' => $theme->slug]) }}">
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
                        <b>
                            @include('admin.includes.block_type_label', ['type' => $block->block_type->type])
                        </b>
                        @if ($block->updated_at)
                            <div class="small text-muted">{{ __('Updated at') }}: {{ date_locale($block->updated_at, 'datetime') }}</div>
                        @endif
                    </div>
                @endforeach
            </div>
        </div>


        <div class="col-md-3 col-sm-6 col-12">
            <div class="builder-col sortable" id="sortable_2">
                <div class="mb-4 text-center">
                    <a class="btn btn-danger" href="#" data-bs-toggle="modal" data-bs-target="#addBlock2"><i class="bi bi-plus-circle"></i>
                        {{ __('Add content block') }}</a>
                    @include('admin.theme.footer.includes.modal-add-footer-block', ['col' => 2])
                </div>

                @foreach (footer_blocks($theme->id, $footer, $col = 2) as $block)
                    <div class="builder-block movable" id="item-{{ $block->id }}">
                        <div class="float-end ms-2">
                            <a href="{{ route('admin.theme-footer.block', ['id' => $block->id, 'footer' => $footer, 'slug' => $theme->slug]) }}" class="btn btn-primary btn-sm">{{ __('Manage content') }}</a>
                            <a href="#" data-bs-toggle="modal" data-bs-target=".confirm-{{ $block->id }}" class="btn btn-outline-danger btn-sm ms-2"><i class="bi bi-trash"></i></a>
                            <div class="modal fade confirm-{{ $block->id }}" tabindex="-1" role="dialog" aria-labelledby="ConfirmDeleteLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="ConfirmDeleteLabel">{{ __('Confirm delete') }}</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            {{ __('Are you sure you want to remove this block from this page? Block content will be deleted also.') }}
                                        </div>
                                        <div class="modal-footer">
                                            <form method="POST" action="{{ route('admin.theme-footer.content.delete', ['footer' => $footer, 'block_id' => $block->id, 'slug' => $theme->slug]) }}">
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
                        <b>
                            @include('admin.includes.block_type_label', ['type' => $block->block_type->type])
                        </b>
                        @if ($block->updated_at)
                            <div class="small text-muted">{{ __('Updated at') }}: {{ date_locale($block->updated_at, 'datetime') }}</div>
                        @endif

                    </div>
                @endforeach
            </div>
        </div>


        <div class="col-md-3 col-sm-6 col-12">
            <div class="builder-col sortable" id="sortable_3">
                <div class="mb-4 text-center">
                    <a class="btn btn-danger" href="#" data-bs-toggle="modal" data-bs-target="#addBlock3"><i class="bi bi-plus-circle"></i>
                        {{ __('Add content block') }}</a>
                    @include('admin.theme.footer.includes.modal-add-footer-block', ['col' => 3])
                </div>

                @foreach (footer_blocks($theme->id, $footer, $col = 3) as $block)
                    <div class="builder-block movable" id="item-{{ $block->id }}">
                        <div class="float-end ms-2">
                            <a href="{{ route('admin.theme-footer.block', ['id' => $block->id, 'footer' => $footer, 'slug' => $theme->slug]) }}" class="btn btn-primary btn-sm">{{ __('Manage content') }}</a>
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
                                            <form method="POST" action="{{ route('admin.theme-footer.content.delete', ['footer' => $footer, 'block_id' => $block->id, 'slug' => $theme->slug]) }}">
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
                        <b>
                            @include('admin.includes.block_type_label', ['type' => $block->block_type->type])
                        </b>
                        @if ($block->updated_at)
                            <div class="small text-muted">{{ __('Updated at') }}: {{ date_locale($block->updated_at, 'datetime') }}</div>
                        @endif

                    </div>
                @endforeach
            </div>
        </div>


        <div class="col-md-3 col-sm-6 col-12">
            <div class="builder-col sortable" id="sortable_4">
                <div class="mb-4 text-center">
                    <a class="btn btn-danger" href="#" data-bs-toggle="modal" data-bs-target="#addBlock4"><i class="bi bi-plus-circle"></i>
                        {{ __('Add content block') }}</a>
                    @include('admin.theme.footer.includes.modal-add-footer-block', ['col' => 4])
                </div>

                @foreach (footer_blocks($theme->id, $footer, $col = 4) as $block)
                    <div class="builder-block movable" id="item-{{ $block->id }}">
                        <div class="float-end ms-2">
                            <a href="{{ route('admin.theme-footer.block', ['id' => $block->id, 'footer' => $footer, 'slug' => $theme->slug]) }}" class="btn btn-primary btn-sm">{{ __('Manage content') }}</a>
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
                                            <form method="POST" action="{{ route('admin.theme-footer.content.delete', ['footer' => $footer, 'block_id' => $block->id, 'slug' => $theme->slug]) }}">
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
                        <b>
                            @include('admin.includes.block_type_label', ['type' => $block->block_type->type])
                        </b>
                        @if ($block->updated_at)
                            <div class="small text-muted">{{ __('Updated at') }}: {{ date_locale($block->updated_at, 'datetime') }}</div>
                        @endif

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

            $("#sortable_1").sortable({
                axis: 'y',
                opacity: 0.8,
                revert: true,

                update: function(event, ui) {
                    var data = $(this).sortable('serialize');
                    $.ajax({
                        data: data,
                        type: 'POST',
                        url: "{{ route('admin.theme-footer.sortable', ['footer' => $footer, 'col' => 1, 'slug' => $theme->slug]) }}",
                    });
                }
            });
            $("#sortable_1").disableSelection();


            $("#sortable_2").sortable({
                axis: 'y',
                opacity: 0.8,
                revert: true,

                update: function(event, ui) {
                    var data = $(this).sortable('serialize');
                    $.ajax({
                        data: data,
                        type: 'POST',
                        url: "{{ route('admin.theme-footer.sortable', ['footer' => $footer, 'col' => 2, 'slug' => $theme->slug]) }}",
                    });
                }
            });
            $("#sortable_2").disableSelection();


            $("#sortable_3").sortable({
                axis: 'y',
                opacity: 0.8,
                revert: true,

                update: function(event, ui) {
                    var data = $(this).sortable('serialize');
                    $.ajax({
                        data: data,
                        type: 'POST',
                        url: "{{ route('admin.theme-footer.sortable', ['footer' => $footer, 'col' => 3, 'slug' => $theme->slug]) }}",
                    });
                }
            });
            $("#sortable_3").disableSelection();


            $("#sortable_4").sortable({
                axis: 'y',
                opacity: 0.8,
                revert: true,

                update: function(event, ui) {
                    var data = $(this).sortable('serialize');
                    $.ajax({
                        data: data,
                        type: 'POST',
                        url: "{{ route('admin.theme-footer.sortable', ['footer' => $footer, 'col' => 4, 'slug' => $theme->slug]) }}",
                    });
                }
            });
            $("#sortable_4").disableSelection();

        });
    </script>
