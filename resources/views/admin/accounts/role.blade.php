<div class="page-title">
    <div class="row">
        <div class="col-12">
            <nav aria-label="breadcrumb" class="breadcrumb-header">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin') }}">{{ __('Dashboard') }}</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.accounts.index') }}">{{ __('Accounts') }}</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.roles.index') }}">{{ __('Roles') }}</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ $role->label ?? $role->name }}</li>
                </ol>
            </nav>
        </div>
    </div>
</div>


<div class="card">

    <div class="card-header">
        <h4 class="card-title">{{ __('Permissions for role') }} "{{ $role->label ?? $role->name }}" </h4>
        {{ $role->description }}
    </div>



    <div class="card-body">

        @if ($message = Session::get('success'))
            <div class="alert alert-success">
                @if ($message == 'updated')
                    {{ __('Updated') }}
                @endif
                @if ($message == 'created')
                    {{ __('Role created. You can set permissions below.') }}
                @endif
            </div>
        @endif

        <div class="mb-3"></div>

        <div class="table-responsive-md">

            <form method="post" action="{{ route('admin.roles.show', ['role' => $role->name]) }}">
                @csrf
                @method('PUT')
                <table class="table table-bordered table-hover">

                    <thead>
                        <tr>
                            <th width="130">{{ __('Type') }}</th>
                            <th width="260" style="width:260px !important">{{ __('Details') }}</th>
                            <th width="390" style="width:390px !important">{{ __('Permission') }}</th>
                            <th>{{ __('Enable / disable access') }}</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($all_permissions as $perm)
                            <tr @if (in_array($perm->id, $role_permissions_ids)) class="table-light" @endif>
                                <td>

                                    <div class="fw-bold">
                                        @if ($perm->plugin_id)
                                            <span class="badge bg-info fw-normal">{{ __('Plugin') }}</span>
                                        @elseif ($perm->post_type_id)
                                            <span class="badge bg-primary fw-normal">{{ __('Post type') }}</span>
                                        @elseif($perm->is_core == 1)
                                            <span class="badge bg-secondary fw-normal">{{ __('Core') }}</span>
                                        @endif
                                    </div>
                                </td>

                                <td>
                                    <div class="fw-bold">
                                        @if ($perm->post_type_id)
                                            {!! $perm->post_type->admin_menu_icon !!} {{ $perm->post_type->default_language_content->name ?? null }}
                                        @elseif ($perm->plugin_id)
                                            {{ $perm->plugin->slug }}
                                        @elseif($perm->is_core == 1)
                                            {{ __('Core') }}
                                        @endif
                                    </div>
                                </td>


                                <td>
                                    @if ($perm->attention == 1)
                                        <span class="float-end badge text-danger fw-bold"><i class="bi bi-exclamation-circle"></i></span>
                                    @endif
                                    <div class="fw-bold">{{ $perm->permission }}</div>
                                    <div class="small text-muted">{{ $perm->description }}</div>
                                </td>

                                <td>
                                    @php
                                        $actions = json_decode($perm->actions, true);
                                        $action_checked = $actions['checked'] ?? null;
                                        $action_unchecked = $actions['unchecked'] ?? null;
                                    @endphp

                                    <div class="row">
                                        <div class="form-check form-switch ms-4">
                                            <input class="form-check-input" type="checkbox" role="switch" name="perm_{{ $perm->id }}" id="switchCheck-{{ $perm->id }}"
                                                @if (in_array($perm->id, $role_permissions_ids)) checked @endif>
                                        </div>
                                    </div>
                                   
                                    <script>
                                        const checkbox_{{ $perm->id }} = document.getElementById('switchCheck-{{ $perm->id }}')
                                        checkbox_{{ $perm->id }}.addEventListener('change', (event) => {
                                            if (event.currentTarget.checked) {
                                                @if (is_array($action_checked))
                                                    @foreach ($action_checked as $item_action => $item_value)
                                                        @if ($item_value == 'enabled')
                                                            document.getElementById("{{ $item_action }}").checked = true;
                                                        @else
                                                            document.getElementById("{{ $item_action }}").checked = false;
                                                        @endif
                                                    @endforeach                                                   
                                                @endif
                                            } else {
                                                @if (is_array($action_unchecked))
                                                    @foreach ($action_unchecked as $item_action => $item_value)
                                                        @if ($item_value == 'disabled')
                                                            document.getElementById("{{ $item_action }}").checked = false;
                                                        @else
                                                            document.getElementById("{{ $item_action }}").checked = true;
                                                        @endif
                                                    @endforeach
                                                @endif
                                            }
                                        })
                                    </script>
                                </td>

                            </tr>
                        @endforeach
                    </tbody>

                </table>

                <input class="btn btn-gear" type="submit" value="{{ __('Update role permissions') }}">

            </form>
        </div>

        <div class="mt-3"></div>
        <span class="text-danger"><i class="bi bi-exclamation-circle"></i></span> - {{ __('These items require more attention. Be sure to grant these permissions only to trusted users.') }}


    </div>
    <!-- end card-body -->

</div>
