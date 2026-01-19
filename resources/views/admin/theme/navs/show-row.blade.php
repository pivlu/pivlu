<div class="page-title">
    <div class="row">
        <div class="col-12">
            <nav aria-label="breadcrumb" class="breadcrumb-header">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin') }}">{{ __('Dashboard') }}</a></li>
                    <li class="breadcrumb-item" aria-current="page"><a href="{{ route('admin.themes.index') }}">{{ __('Website appearance') }}</a></li>
                    <li class="breadcrumb-item" aria-current="page"><a href="{{ route('admin.theme-navs.index') }}">{{ __('Navigations') }}</a></li>
                    <li class="breadcrumb-item" aria-current="page"><a href="{{ route('admin.theme-navs.show', ['id' => $nav->id]) }}">{{ __('Navigation rows') }}</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ $nav->label }}</li>
                </ol>
            </nav>
        </div>
    </div>
</div>


@if ($message = Session::get('success'))
    <div class="alert alert-success">
        @if ($message == 'updated')
            {{ __('Updated') }}
        @endif
        @if ($message == 'deleted')
            {{ __('Deleted') }}
        @endif
    </div>
@endif


<h5 class="fw-bold">{{ __('Navigation row content') }}</h5>

<div class="card bg-light p-3 mb-4">

    @if ($row->active == 0)
        <div class="text-danger fw-bold mb-3"><i class="bi bi-exclamation-triangle-fill"></i> {{ __('The navigation row is disabled. Enable it to show on website.') }}</div>
    @endif


    <div class="row">

        <div class="col-md-4">

            <div class="dropdown float-end ms-2 mb-2">
                <a class="btn btn-secondary dropdown-toggle btn-sm" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Add item
                </a>

                @include('pivlu::admin.theme.navs.includes.theme-nav-item-add-button', ['row_id' => $row->id, 'nav_id' => $nav->id, 'column' => 'left'])
            </div>

            <div class="fw-bold mb-3">{{ __('Items aligned left') }}</div>

            <div class="builder-col sortable" id="sortable_left">

                @foreach ($row_items->where('column', 'left') as $item)
                    <div class="builder-block movable" id="item-{{ $item->id }}">

                        @include('pivlu::admin.theme.navs.includes.theme-nav-item-block')

                        @include('pivlu::admin.theme.navs.includes.theme-nav-item-label', ['item' => $item])
                    </div>
                @endforeach

            </div>
        </div>

        <div class="col-md-4">

            <div class="dropdown float-end ms-2 mb-2">
                <a class="btn btn-secondary dropdown-toggle btn-sm" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Add item
                </a>

                @include('pivlu::admin.theme.navs.includes.theme-nav-item-add-button', ['row_id' => $row->id, 'nav_id' => $nav->id, 'column' => 'center'])
            </div>


            <div class="fw-bold text-center mb-3">{{ __('Items aligned center') }}</div>

            <div class="builder-col sortable" id="sortable_center">

                @foreach ($row_items->where('column', 'center') as $item)
                    <div class="builder-block movable" id="item-{{ $item->id }}">

                        @include('pivlu::admin.theme.navs.includes.theme-nav-item-block')

                        @include('pivlu::admin.theme.navs.includes.theme-nav-item-label', ['item' => $item])
                    </div>
                @endforeach

            </div>
        </div>

        <div class="col-md-4">

            <div class="dropdown float-end ms-2 mb-2">
                <a class="btn btn-secondary dropdown-toggle btn-sm" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Add item
                </a>

                @include('pivlu::admin.theme.navs.includes.theme-nav-item-add-button', ['row_id' => $row->id, 'nav_id' => $nav->id, 'column' => 'right'])
            </div>

            <div class="fw-bold text-center mb-3">{{ __('Items aligned right') }}</div>

            <div class="builder-col sortable" id="sortable_right">

                @foreach ($row_items->where('column', 'right') as $item)
                    <div class="builder-block movable" id="item-{{ $item->id }}">

                        @include('pivlu::admin.theme.navs.includes.theme-nav-item-block')

                        @include('pivlu::admin.theme.navs.includes.theme-nav-item-label', ['item' => $item])
                    </div>
                @endforeach

            </div>
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

        $("#sortable_left").sortable({
            axis: 'y',
            opacity: 0.8,
            revert: true,

            update: function(event, ui) {
                var data = $(this).sortable('serialize');
                $.ajax({
                    data: data,
                    type: 'POST',
                    url: "{{ route('admin.theme-nav-rows.sortable-item', ['nav_id' => $nav->id, 'row_id' => $row->id, 'column' => 'left']) }}",
                });
            }
        });

        $("#sortable_center").sortable({
            axis: 'y',
            opacity: 0.8,
            revert: true,

            update: function(event, ui) {
                var data = $(this).sortable('serialize');
                $.ajax({
                    data: data,
                    type: 'POST',
                    url: "{{ route('admin.theme-nav-rows.sortable-item', ['nav_id' => $nav->id, 'row_id' => $row->id, 'column' => 'center']) }}",
                });
            }
        });

        $("#sortable_right").sortable({
            axis: 'y',
            opacity: 0.8,
            revert: true,

            update: function(event, ui) {
                var data = $(this).sortable('serialize');
                $.ajax({
                    data: data,
                    type: 'POST',
                    url: "{{ route('admin.theme-nav-rows.sortable-item', ['nav_id' => $nav->id, 'row_id' => $row->id, 'column' => 'right']) }}",
                });
            }
        });
    

        $("#sortable_left").disableSelection();
        $("#sortable_center").disableSelection();
        $("#sortable_right").disableSelection();        
    });
</script>
