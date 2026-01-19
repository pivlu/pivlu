<div class="page-title">
    <div class="row">
        <div class="col-12">
            <nav aria-label="breadcrumb" class="breadcrumb-header">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin') }}">{{ __('Dashboard') }}</a></li>
                    <li class="breadcrumb-item" aria-current="page"><a href="{{ route('admin.themes.index') }}">{{ __('Website appearance') }}</a></li>
                    <li class="breadcrumb-item" aria-current="page"><a href="{{ route('admin.theme-navs.index') }}">{{ __('Navigations') }}</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ $nav->label }}</li>
                </ol>
            </nav>
        </div>
    </div>
</div>

<div class="card">

    <div class="card-header">

        <div class="float-end">
            <a class="btn btn-primary" href="{{ route('admin.theme-nav-rows.create', ['nav_id' => $nav->id]) }}"><i class="bi bi-plus-circle"></i> {{ __('Add row') }}</a>
        </div>

        <h4 class="card-title">{{ __('Navigation rows') }} - <b>{{ $nav->label }}</b></h4>

        <div class="text-muted">
            {{ __('A navigation section can contain one or more rows. Navigation rows are horizontal sections that make up a navigation menu. Each row can contain different items (logo, links, dropdown menus, search input, custom text...) aligned to the left, center, or right.') }}
        </div>
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

        <div class="builder-col sortable" id="sortable_rows">

            @foreach ($rows as $row)
                <div class="builder-block movable" id="item-{{ $row->id }}">

                    <div class="float-end ms-2">
                        <a href="#" data-bs-toggle="modal" data-bs-target=".confirm-{{ $row->id }}" class="btn btn-outline-danger btn-sm ms-2"><i class="bi bi-trash"></i></a>

                        <div class="modal fade confirm-{{ $row->id }}" tabindex="-1" role="dialog" aria-labelledby="ConfirmDeleteLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="ConfirmDeleteLabel">{{ __('Confirm delete') }}</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        {{ __('Are you sure you want to remove this navigation row?') }}
                                    </div>
                                    <div class="modal-footer">
                                        <form method="POST" action="{{ route('admin.theme-nav-rows.delete', ['nav_id' => $nav->id, 'row_id' => $row->id]) }}">
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

                    <div class="fw-bold mb-2">
                        <a href="{{ route('admin.theme-nav-rows.show', ['nav_id' => $nav->id, 'row_id' => $row->id]) }}" class="btn btn-primary">{{ __('Manage row content') }}</a>
                    </div>
                    
                    
                    <form method="post" action="{{ route('admin.theme-nav-row.status', ['nav_id' => $nav->id, 'row_id' => $row->id]) }}">
                        @csrf
                        @method('PUT')
                        <div class="form-check form-switch">
                            <input type='hidden' value='' name='active'>
                            <input class="form-check-input" type="checkbox" id="row_{{ $row->id }}_active" name="active" @if ($row->active ?? null) checked @endif onchange="this.form.submit()">
                            <label class="form-check-label" for="row_{{ $row->id }}_active">{{ __('Show this navigation row') }}</label>
                        </div>
                    </form>

                    <div class="small">{{ __('Created at') }}: {{ $row->created_at }}</div>

                </div>
            @endforeach

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

        $("#sortable_rows").sortable({
            revert: true,
            axis: 'y',
            opacity: 0.5,
            revert: true,

            update: function(event, ui) {
                var data = $(this).sortable('serialize');
                // POST to server using $.post or $.ajax
                $.ajax({
                    data: data,
                    type: 'POST',
                    url: '{{ route('admin.theme-nav-rows.sortable', ['nav_id' => $nav->id]) }}',
                });
            }
        });

        $("#sortable_rows").disableSelection();
    });
</script>
