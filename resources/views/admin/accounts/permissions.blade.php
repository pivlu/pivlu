<div class="page-title">
    <div class="row">
        <div class="col-12">
            <nav aria-label="breadcrumb" class="breadcrumb-header">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin') }}">{{ __('Dashboard') }}</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ __('Internal permissions') }}</li>
                </ol>
            </nav>
        </div>
    </div>
</div>


<div class="card">

    <div class="card-header">

        <h4 class="card-title">{{ __('Internal permissions') }}</h4>

        <i class="bi bi-info-circle"></i> {{ __('Manage internal users access to website modules') }}
    </div>



    <div class="card-body">

        @if ($message = Session::get('success'))
            <div class="alert alert-success">
                @if ($message == 'updated')
                    {{ __('Updated') }}
                @endif
            </div>
        @endif

        <section>
            <form action="{{ route('admin.accounts.permissions') }}" method="get" class="row row-cols-lg-auto g-3 align-items-center">

                <div class="col-12">
                    <input type="text" name="search_terms" placeholder="Search internal user" class="form-control me-2 @if ($search_terms) is-valid @endif" value="{{ $search_terms ?? '' }}" />
                </div>

                <div class="col-12">
                    <button class="btn btn-primary me-2" type="submit"><i class="bi bi-check2"></i> {{ __('Apply') }}</button>
                    <a class="btn btn-light" href="{{ route('admin.accounts.permissions') }}"><i class="bi bi-arrow-counterclockwise"></i></a>
                </div>

            </form>
        </section>

        <div class="mb-3"></div>


        @if ($internal_accounts->total() == 0)
            {{ __("You don't have any internal user.") }} <a class="fw-bold" href="{{ route('admin.accounts.index', ['role' => 'internal']) }}">{{ __('Manage internal users') }}</a>
        @else
            <div class="table-responsive-md">

                <form method="post">
                    @csrf
                    <table class="table table-bordered table-hover">
                        <tbody>
                            @foreach ($internal_accounts as $user)
                                <tr>
                                    <td width="240" style="width:250px !important">

                                        <span class="float-start me-2"><img style="max-width:25px; height:auto;" class="rounded rounded-circle img-fluid" src="{{ avatar('uploads/' . $user->id) }}" /></span>

                                        <a target="_blank" href="{{ route('admin.accounts.show', ['id' => $user->id]) }}">
                                            <div class="fw-bold fs-6">{{ $user->name }}</div>
                                        </a>
                                        <div class="clearfix"></div>
                                        <div class="small text-muted">{{ $user->email }}</div>
                                    </td>

                                    <td>
                                        <div class="row">
                                            @foreach ($modules_permissions as $key => $module_permissions)
                                                <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-12 mb-4">
                                                    <label class="mb-0 fs-6">{{ $module_permissions->label }}</label>
                                                    <div class="text-muted small mb-2">{{ $module_permissions->description }}</div>

                                                    <select class="form-control @if (!chekbox_module_permissions($key, $user->id)) is-invalid @else is-valid @endif" name="{{ $key }}#{{ $user->id }}">
                                                        <option @if (!chekbox_module_permissions($key, $user->id)) selected @endif value="0">- {{ __('No access') }} -</option>
                                                        @foreach ($module_permissions->perm as $permission)
                                                            <option @if (chekbox_permissions($user->id, $key, $permission->permission)) selected @endif value="{{ $permission->permission }}">{{ $permission->label }}</option>
                                                        @endforeach
                                                    </select>

                                                    <div class="small mt-2">
                                                        @foreach ($module_permissions->perm as $permission)
                                                            <b>{{ $permission->label }}</b>: {{ $permission->description }}</option>
                                                            <br>
                                                        @endforeach
                                                    </div>

                                                </div>
                                            @endforeach
                                        </div>
                                    </td>

                                </tr>
                            @endforeach
                        </tbody>

                    </table>

                    <input class="btn btn-gear" type="submit" name="action" value="{{ __('Update permissions') }}">

                </form>
            </div>

            {{ $internal_accounts->links() }}
        @endif

    </div>
    <!-- end card-body -->

</div>
