<style>
    .hide {
        display: none !important;
    }
</style>

<div class="page-title">
    <div class="row">
        <div class="col-12">
            <nav aria-label="breadcrumb" class="breadcrumb-header">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin') }}">{{ __('Dashboard') }}</a></li>
                    <li class="breadcrumb-item" aria-current="page"><a href="{{ route('admin.themes.index') }}">{{ __('Website template') }}</a></li>
                    <li class="breadcrumb-item" aria-current="page"><a href="{{ route('admin.theme-menus.index') }}">{{ __('Menus') }}</a></li>
                    <li class="breadcrumb-item" aria-current="page"><a href="{{ route('admin.theme-menus.show', ['id' => $menu->id]) }}">{{ $menu->label }}</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ $parent_item->default_language_content->label }}</li>
                </ol>
            </nav>
        </div>
    </div>
</div>


<div class="card">

    <div class="card-header">

        <div class="float-end">
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#create-menu-link"><i class="bi bi-plus-circle"></i> {{ __('Add link') }}</button>
            @include('pivlu::admin.theme.menus.includes.modal-create-menu-link')
        </div>

        <h4 class="card-title">{{ __('Dropdown links') }} </h4>

    </div>


    <div class="card-body">

        @if ($message = Session::get('success'))
            <div class="alert alert-success">
                @if ($message == 'created')
                    {{ __('Creates') }}
                @endif
                @if ($message == 'updated')
                    {{ __('Updated') }}
                @endif
                @if ($message == 'deleted')
                    {{ __('Deleted') }}
                @endif
            </div>
        @endif

        @if ($message = Session::get('error'))
            <div class="alert alert-danger">
                @if ($message == 'duplicate')
                    {{ __('Error. This menu exist') }}
                @endif
                @if ($message == 'error_delete')
                    {{ __('Error. This menu can not be deleted') }}
                @endif
            </div>
        @endif

        <div class="table-responsive-md">
            <table class="table table-bordered table-hover sortable">
                <thead>
                    <tr>
                        <th width="40"><i class="bi bi-arrow-down-up"></i></th>
                        <th>{{ __('Details') }}</th>
                        <th width="180">{{ __('Destination') }}</th>
                        <th width="160">{{ __('Actions') }}</th>
                    </tr>
                </thead>

                <tbody id="sortable">
                    @foreach ($links as $link)
                        <tr id="item-{{ $link->id }}">

                            <td class="movable">
                                <i class="bi bi-arrow-down-up"></i>
                            </td>

                            <td>
                                @foreach ($link->all_languages_contents as $link_content)
                                    @if ($link_content->label)
                                        {!! $link->icon !!} <b>{!! lang_label($link_content, $link_content->label) !!}</b>
                                    @else
                                        <span class="text-danger">{{ __('Label not set') }}</span>
                                    @endif

                                    <div class="mb-2">
                                        @if ($link_content->url)
                                            <a target="_blank" href="{{ $link_content->url }}">{{ $link_content->url }}</a>
                                        @else
                                            <span class="text-danger">{{ __('URL not set') }}</span>
                                        @endif
                                    </div>
                                @endforeach
                            </td>

                            <td>
                                @if ($link->type == 'home')
                                    {{ __('Homepage') }}
                                @elseif($link->type == 'custom')
                                    {{ __('Custom link') }}
                                @elseif($link->type == 'page')
                                    {{ __('Page') }}
                                    <br>
                                    <small class="text-muted"><a href="{{ route('admin.posts.show', ['id' => $link->value]) }}"><i class="bi bi-pencil-square"></i></a></small>
                                @elseif($link->type == 'post_type')
                                    {{ __('Post type') }}
                                @else
                                    {{ $link->type }}
                                @endif
                            </td>

                            <td>
                                <div class="d-grid gap-2">

                                    <button data-bs-toggle="modal" data-bs-target="#update-menu-link-dropdown-{{ $link->id }}" class="btn btn-primary btn-sm mb-2">{{ __('Update link') }}</button>
                                    @include('pivlu::admin.theme.menus.includes.modal-update-menu-link-dropdown')

                                    <a href="#" data-bs-toggle="modal" data-bs-target=".confirm-{{ $link->id }}" class="btn btn-danger btn-sm">{{ __('Delete link') }}</a>
                                    <div class="modal fade confirm-{{ $link->id }}" tabindex="-1" role="dialog" aria-labelledby="ConfirmDeleteLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="ConfirmDeleteLabel">{{ __('Confirm delete') }}</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    {{ __('Are you sure you want to delete this link?') }}
                                                </div>
                                                <div class="modal-footer">
                                                    <form method="POST" action="{{ route('admin.theme-menu.dropdown.delete', ['parent_id' => $parent_item->id, 'item_id' => $link->id]) }}">
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
                            </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>

    </div>
    <!-- end card-body -->

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

        $("#sortable").sortable({
            revert: true,
            axis: 'y',
            opacity: 0.5,
            revert: true,
            handle: ".movable",

            update: function(event, ui) {
                var data = $(this).sortable('serialize');
                // POST to server using $.post or $.ajax
                $.ajax({
                    data: data,
                    type: 'POST',
                    url: '{{ route('admin.theme-menu.dropdown.sortable', ['parent_id' => $parent_item->id]) }}',
                });
            }
        });

        $("ul, li, .actions").disableSelection();
    });
</script>
