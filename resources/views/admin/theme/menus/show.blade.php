<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.1.1/dist/select2-bootstrap-5-theme.min.css" />

@include('admin.includes.color-picker')

<div class="page-title">
    <div class="row">
        <div class="col-12">
            <nav aria-label="breadcrumb" class="breadcrumb-header">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin') }}">{{ __('Dashboard') }}</a></li>
                    <li class="breadcrumb-item" aria-current="page"><a href="{{ route('admin.themes.index') }}">{{ __('Website template') }}</a></li>
                    <li class="breadcrumb-item" aria-current="page"><a href="{{ route('admin.theme-menus.index') }}">{{ __('Menus') }}</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ $menu->label }}</li>
                </ol>
            </nav>
        </div>
    </div>
</div>



<div class="card">

    @include('admin.theme.includes.menu-themes')

    <div class="card-header">

        <div class="float-end">
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#create-menu-link"><i class="bi bi-plus-circle"></i> {{ __('Add link') }}</button>
            @include('admin.theme.menus.includes.modal-create-menu-link')
        </div>

        <h4 class="card-title">{{ __('Menu links') }} - <b>{{ $menu->label }}</b></h4>

    </div>


    <div class="card-body">


        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

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
                        <th width="230">{{ __('Destination') }}</th>
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
                                    @if (count(admin_languages()) > 1)
                                        <span class="me-1">{!! flag($link_content->lang_code) !!}</span>
                                    @endif

                                    @if ($link_content->label)
                                        {!! $link->icon !!} {{ $link_content->label }}</a>
                                    @else
                                        <span class="text-danger">{{ __('not set') }}</span>
                                    @endif
                                    <div class="mb-1"></div>
                                @endforeach

                                @foreach ($languages as $lang)
                                    @if ($link->type == 'home')
                                        @if ($lang->is_default == 1)
                                            <a target="_blank" href="{{ route('home') }}">{{ route('home') }}</a>
                                        @else
                                            <a target="_blank" href="{{ route('locale.home', ['locale' => $lang->code]) }}">{{ route('locale.home', ['locale' => $lang->code]) }}</a>
                                        @endif
                                    @endif

                                    @if ($link->type == 'custom')
                                        <a target="_blank" href="{{ $link->value }}">{{ $link->value }}</a>
                                    @endif

                                    @if ($link->type == 'page')
                                        @php
                                            $link_url = 'TO DO';
                                        @endphp
                                        <a target="_blank" href="{{ $link_url }}">{{ $link_url }}</a>
                                    @endif

                                    <div class="mb-2"></div>
                                @endforeach
                            </td>

                            <td>
                                @if ($link->type == 'home')
                                    {{ __('Homepage') }}
                                @elseif($link->type == 'custom')
                                    {{ __('Custom link') }}
                                @elseif($link->type == 'page')
                                    {{ __('Page') }}
                                @elseif($link->type == 'dropdown')
                                    <a class="btn btn-primary mb-2" href="{{ route('admin.theme-menu.dropdown', ['parent_id' => $link->id]) }}">{{ __('Manage dropdown links') }}</a>
                                    {{ __('Dropdown menu') }}
                                @else
                                    {{ $link->type }}
                                @endif
                            </td>

                            <td>
                                <div class="d-grid gap-2">

                                    <button data-bs-toggle="modal" data-bs-target="#update-menu-link-{{ $link->id }}" class="btn btn-primary btn-sm mb-2">{{ __('Update link') }}</button>
                                    @include('admin.theme.menus.includes.modal-update-menu-link')


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
                                                    <form method="POST" action="{{ route('admin.theme-menus.item.delete', ['item_id' => $link->id]) }}">
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
                    url: '{{ route('admin.theme-menus.items.sortable', ['menu_id' => $menu->id]) }}',
                });
            }
        });

        $("ul, li, .actions").disableSelection();
    });
</script>
