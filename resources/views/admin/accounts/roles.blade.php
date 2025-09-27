<div class="page-title">
    <div class="row">
        <div class="col-12">
            <nav aria-label="breadcrumb" class="breadcrumb-header">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin') }}">{{ __('Dashboard') }}</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.accounts.index') }}">{{ __('Accounts') }}</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ __('Roles') }}</li>
                </ol>
            </nav>
        </div>
    </div>
</div>


<div class="card">

    <div class="card-header">
        <div class="float-end ms-3">
            <a class="btn btn-primary" href="#" id="createAccount" data-bs-toggle="modal" data-bs-target="#create-role">
                <i class="bi bi-plus-circle"></i> {{ __('Create role') }}
            </a>
            @include('admin.accounts.includes.modal-create-role')

        </div>

        <h4 class="card-title">{{ __('Users roles') }}</h4>
    </div>


    <div class="card-body">

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

        @if ($message = Session::get('error'))
            <div class="alert alert-danger">
                 @if ($message == 'duplicate')
                    {{ __('Error. This role exists.') }}
                @endif
                @if ($message == 'exists_users')
                    {{ __('Role can not be deleted because there are users with this role.') }}
                @endif
            </div>
        @endif

        <div class="table-responsive-md">
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>{{ __('Role') }}</th>
                        <th width="150">{{ __('Accounts') }}</th>
                        <th width="150">{{ __('Permissions') }}</th>
                        <th width="160">{{ __('Actions') }}</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach ($roles as $role)
                        <tr>
                            <td>
                                @if ($role->plugin_id)
                                    <span class="float-end ms-2 badge bg-info fw-normal">{{ __('Plugin') }}</span>
                                @endif

                                @if ($role->is_core == 1)
                                    <span class="float-end ms-2 badge bg-info fw-normal">{{ __('Pre-defined') }}</span>
                                @endif

                                <div class="fw-bold">{{ $role->label }} ({{ $role->role }})</div>
                                <div class="text-black-50">{{ $role->description }}</div>
                            </td>

                            <td>
                                <a href="{{ route('admin.accounts.index', ['search_role' => $role->role]) }}">{{ $role->users_count }} {{ trans_choice('account|accounts', $role->users_count) }}</a>
                            </td>

                            <td>
                                @if ($role->role == 'admin')
                                    {{ __('All permissions ') }}
                                @else
                                    <a href="{{ route('admin.roles.show', ['role' => $role->role]) }}">
                                        {{ $role->permissions_count }} {{ trans_choice('permission|permissions', $role->permissions_count) }}
                                    </a>
                                @endif
                            </td>

                            <td>
                                <div class="d-grid gap-2">
                                    @if ($role->role != 'admin')
                                        <a class="btn btn-primary btn-sm" href="{{ route('admin.roles.show', ['role' => $role->role]) }}">{{ __('Manage permissions') }}</a>
                                    @endif

                                    @if ($role->is_core == 0 && !$role->plugin_id)
                                        <a href="#" data-bs-toggle="modal" data-bs-target=".confirm-{{ $role->id }}" class="btn btn-danger btn-sm">{{ __('Delete') }}</a>
                                        <div class="modal fade confirm-{{ $role->id }}" tabindex="-1" role="dialog" aria-labelledby="ConfirmDeleteLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="ConfirmDeleteLabel">{{ __('Confirm delete') }}</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        {{ __('Are you sure you want to delete this role?') }}
                                                    </div>
                                                    <div class="modal-footer">
                                                        <form method="POST" action="{{ route('admin.roles.show', ['role' => $role->role]) }}">
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

    </div>
    <!-- end card-body -->

</div>
