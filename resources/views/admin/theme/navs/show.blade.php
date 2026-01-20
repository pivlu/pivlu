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


                    <form method="post" action="{{ route('admin.theme-nav-row.update', ['nav_id' => $nav->id, 'row_id' => $row->id]) }}">
                        @csrf
                        @method('PUT')
                        <div class="form-check form-switch">
                            <input type='hidden' value='' name='active'>
                            <input class="form-check-input" type="checkbox" id="row_{{ $row->id }}_active" name="active" @if ($row->active ?? null) checked @endif onchange="this.form.submit()">
                            <label class="form-check-label" for="row_{{ $row->id }}_active">{{ __('Show this navigation row') }}</label>
                        </div>

                        <div class="row mt-3">
                            <div class="form-group col-xl-3 col-lg-4 col-md-6 mb-2">
                                <label>{{ __('Select style for this navigation row') }}</label>
                                <select class="form-select" id="style_id_row_{{ $row->id }}" name="style_id" onchange="this.form.submit()">
                                    <option value="">-- {{ __('select') }} --</option>
                                    @foreach ($styles as $style)
                                        <option @if (($row->configs['style_id'] ?? null) == $style->id) selected @endif value="{{ $style->id }}">{{ $style->label }}</option>
                                    @endforeach
                                </select>
                                <div class="text-muted small">{{ __('Style for background, links, color...') }}</div>

                                @if (!($row->configs['style_id'] ?? null))
                                    <div class="mt-1 text-muted"><span class="text-danger">{{ __('no style selected') }}</span></div>
                                @endif
                            </div>

                            <div class="form-group col-xl-3 col-lg-4 col-md-6 mb-2">
                                <label>{{ __('Navigation row size') }}</label>
                                <select class="form-select" id="nav_size_row_{{ $row->id }}" name="nav_size" onchange="this.form.submit()">
                                    <option @if (($row->configs['nav_size'] ?? null) == 'normal') selected @endif value="normal">{{ __('Normal') }}</option>
                                    <option @if (($row->configs['nav_size'] ?? null) == 'large') selected @endif value="large">{{ __('Large') }}</option>
                                    <option @if (($row->configs['nav_size'] ?? null) == 'extra_large') selected @endif value="extra_large">{{ __('Extra large') }}</option>
                                    <option @if (($row->configs['nav_size'] ?? null) == 'small') selected @endif value="small">{{ __('Small') }}</option>
                                </select>
                                <div class="text-muted small">{{ __('The height of the navigation row') }}</div>
                            </div>

                            <div class="form-group col-xl-3 col-lg-4 col-md-6 mb-2">
                                <label>{{ __('Navigation position') }}</label>
                                <select class="form-select" id="nav_position_row_{{ $row->id }}" name="nav_position" onchange="this.form.submit()">
                                    <option @if (($row->configs['nav_position'] ?? null) == 'scroll') selected @endif value="scroll">{{ __('Scroll') }}</option>
                                    <option @if (($row->configs['nav_position'] ?? null) == 'sticky') selected @endif value="sticky">{{ __('Sticky') }}</option>
                                </select>
                                <div class="text-muted small">{{ __('The position of the navigation row. Only one navigation row can be sticky.') }}</div>
                            </div>

                            <div class="form-group col-xl-3 col-lg-4 col-md-6 mb-2">
                                <label>{{ __('Navigation row shadow') }}</label>
                                <select class="form-select" id="nav_shadow_row_{{ $row->id }}" name="nav_shadow" onchange="this.form.submit()">
                                    <option @if (($row->configs['nav_shadow'] ?? null) == 'none') selected @endif value="none">{{ __('None') }}</option>
                                    <option @if (($row->configs['nav_shadow'] ?? null) == 'small') selected @endif value="small">{{ __('Small') }}</option>
                                    <option @if (($row->configs['nav_shadow'] ?? null) == 'regular') selected @endif value="regular">{{ __('Regular') }}</option>
                                    <option @if (($row->configs['nav_shadow'] ?? null) == 'large') selected @endif value="large">{{ __('Large') }}</option>
                                </select>
                                <div class="text-muted small">{{ __('The shadow of the navigation row. Only one navigation row can have a shadow.') }}</div>
                            </div>
                        </div>
                    </form>
                </div>
            @endforeach
        </div>

        <div class="text-muted small mt-3">
            <i class="bi bi-arrows-move"></i> {{ __('Drag and drop the navigation rows to reorder them.') }}
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
