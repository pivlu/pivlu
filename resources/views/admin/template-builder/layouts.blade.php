@include('admin.includes.color-picker')

<div class="page-title">
    <div class="row">
        <div class="col-12">
            <nav aria-label="breadcrumb" class="breadcrumb-header">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin') }}">{{ __('Dashboard') }}</a></li>
                    <li class="breadcrumb-item" aria-current="page"><a href="{{ route('admin.template') }}">{{ __('Template builder') }}</a></li>
                    <li class="breadcrumb-item active" aria-current="page"><a href="{{ route('admin.template.layouts') }}">{{ __('Layouts') }}</a></li>
                </ol>
            </nav>
        </div>
    </div>
</div>



<div class="card">

    <div class="card-header">

        <div class="row">

            <div class="col-12 mb-3">
                @include('admin.template.includes.menu-template')
            </div>

            <div class="col-12 col-sm-5 col-md-6 order-md-1 order-first">
                <h4 class="card-title">{{ __('Layouts') }}</h4>
            </div>

            <div class="col-12 col-sm-7 col-md-6 order-md-2 order-last">
                <div class="float-end">
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#create-layout"><i class="bi bi-plus-circle"></i> {{ __('Create layout') }}</button>
                    @include('admin.template.modals.create-layout')
                </div>
            </div>

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
                    {{ __('Error. This layout exists') }}
                @endif
            </div>
        @endif

        <div class="table-responsive-md">
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>{{ __('Label') }}</th>
                        <th width="220">{{ __('Layout') }}</th>
                        <th width="180">{{ __('Content') }}</th>
                        <th width="120">{{ __('Actions') }}</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach ($layouts as $layout)
                        <tr>
                            <td>
                                <div class="fs-5 fw-bold">{{ $layout->label }}</div>
                            </td>

                            <td>
                                {{ __('Top content') }}: @if ($layout->top == 1)
                                    <span class="fw-bold text-success">{{ __('yes') }} @if ($layout->bg_color_top)
                                            <i class="bi bi-square-fill" style="color: {{ $layout->bg_color_top }}"></i>
                                        @endif </span>
                                @else
                                    <span class="fw-bold text-danger">{{ __('no') }}</span>
                                @endif
                                <div class="mb-1"></div>
                                {{ __('Bottom content') }}: @if ($layout->bottom == 1)
                                    <span class="fw-bold text-success">{{ __('yes') }} @if ($layout->bg_color_bottom)
                                            <i class="bi bi-square-fill" style="color: {{ $layout->bg_color_bottom }}"></i>
                                        @endif
                                    </span>
                                @else
                                    <span class="fw-bold text-danger">{{ __('no') }}</span>
                                @endif
                                <div class="mb-1"></div>
                                {{ __('Sidebar') }}:
                                @if ($layout->sidebar == 'left')
                                    <span class="fw-bold text-success">{{ __('left') }} @if ($layout->bg_color_sidebar)
                                            <i class="bi bi-square-fill" style="color: {{ $layout->bg_color_sidebar }}"></i>
                                        @endif
                                    </span>
                                @elseif($layout->sidebar == 'right')
                                    <span class="fw-bold text-success">{{ __('right') }} @if ($layout->bg_color_sidebar)
                                            <i class="bi bi-square-fill" style="color: {{ $layout->bg_color_sidebar }}"></i>
                                        @endif
                                    </span>
                                @else
                                    <span class="fw-bold text-danger">{{ __('no') }}</span>
                                @endif
                            </td>

                            <td>
                                <div class="d-grid gap-2">
                                    <a class="btn btn-gear" href="{{ route('admin.template.layouts.show', ['id' => $layout->id]) }}">{{ __('Manage content') }}</a>
                                </div>
                            </td>

                            <td>
                                <div class="d-grid gap-2">
                                    <a href="#" data-bs-toggle="modal" data-bs-target="#update-{{ $layout->id }}" class="btn btn-primary btn-sm mb-2">{{ __('Update') }}</a>
                                    @include('admin.template.modals.update-layout')

                                    <a href="#" data-bs-toggle="modal" data-bs-target=".confirm-{{ $layout->id }}" class="btn btn-danger btn-sm">{{ __('Delete') }}</a>
                                </div>

                                <div class="modal fade confirm-{{ $layout->id }}" tabindex="-1" role="dialog" aria-labelledby="ConfirmDeleteLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="ConfirmDeleteLabel">{{ __('Confirm delete') }}</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                {{ __('Are you sure you want to delete this layout?') }}
                                                <div class="fw-bold text-danger mt-2"><i class="bi bi-exclamation-triangle"></i> {{ __('Warning! Layout content will be permanently deleted.') }}</div>
                                            </div>
                                            <div class="modal-footer">
                                                <form method="POST" action="{{ route('admin.template.layouts.show', ['id' => $layout->id]) }}">
                                                    {{ csrf_field() }}
                                                    {{ method_field('DELETE') }}
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('Close') }}</button>
                                                    <button type="submit" class="btn btn-danger">{{ __('Yes. Delete') }}</button>
                                                </form>
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

        {{ $layouts->links() }}

    </div>
    <!-- end card-body -->

</div>
