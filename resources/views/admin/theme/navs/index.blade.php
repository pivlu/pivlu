<div class="page-title">
    <div class="row">
        <div class="col-12">
            <nav aria-label="breadcrumb" class="breadcrumb-header">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin') }}">{{ __('Dashboard') }}</a></li>
                    <li class="breadcrumb-item" aria-current="page"><a href="{{ route('admin.themes.index') }}">{{ __('Website appearance') }}</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ __('Navigations') }}</li>
                </ol>
            </nav>
        </div>
    </div>
</div>


<div class="card">

    <div class="card-header">

        <div class="float-end">
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#create-nav"><i class="bi bi-plus-circle"></i> {{ __('Create navigation') }}</button>
            @include('pivlu::admin.theme.navs.includes.modal-create-nav')
        </div>

        <h4 class="card-title">{{ __('Manage navigations') }}</h4>

        <div class="text-muted">{{ __('Navigations or navbars are tailored menus placed at the top of your site that organize links and controls for quick, consistent access to important pages and features.') }}</div>

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
                    {{ __('Error. This menu exists') }}
                @endif
            </div>
        @endif

        <div class="table-responsive-md">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th width="50">{{ __('ID') }}</th>
                        <th>{{ __('Label') }}</th>
                        <th width="180">{{ __('Actions') }}</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach ($navs as $nav)
                        <tr>
                            <td>
                                {{ $nav->id }}
                            </td>

                            <td>
                                @if ($nav->is_default == 1)
                                    <span class="badge bg-light text-secondary fw-normal float-end"></i> {{ __('Default navigation') }}</span>
                                @endif

                                <div class="fs-5 fw-bold">
                                    {{ $nav->label }}
                                </div>

                                <div class="small text-muted">
                                    {{ __('Created at') }} {{ $nav->created_at }}
                                </div>

                            </td>

                            <td>
                                <div class="d-grid gap-2">

                                    <a class="btn btn-gear mb-2" href="{{ route('admin.theme-navs.show', ['id' => $nav->id]) }}">{{ __('Manage navigation') }}</a>

                                    @if ($nav->is_default == 0)
                                        <a href="#" data-bs-toggle="modal" data-bs-target=".confirm-{{ $nav->id }}" class="btn btn-danger btn-sm">{{ __('Delete navigation') }}</a>
                                        <div class="modal fade confirm-{{ $nav->id }}" tabindex="-1" role="dialog" aria-labelledby="ConfirmDeleteLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="ConfirmDeleteLabel">{{ __('Confirm delete') }}</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        {{ __('Are you sure you want to delete this navigation?') }}
                                                    </div>
                                                    <div class="modal-footer">
                                                        <form method="POST" action="{{ route('admin.theme-navs.show', ['id' => $nav->id]) }}">
                                                            {{ csrf_field() }}
                                                            {{ method_field('DELETE') }}
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('Close') }}</button>
                                                            <button type="submit" class="btn btn-danger">{{ __('Yes. Delete') }}</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                </div>

                            </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>

        {{ $navs->links() }}

    </div>
    <!-- end card-body -->

</div>
