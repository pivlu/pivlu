@if ($error_message = Session::get('error'))
    <div class="alert alert-danger">
        @if ($error_message == 'no_permission')
            {{ __('Error. You do not have permission for this action.') }}
        @endif
    </div>
@endif

<div class="row">

    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">{{ __('Dashboard') }}</h4>
            </div>

            <div class="card-body">
                <div class="row">

                    <div class="col-12 col-md-6 col-lg-4">
                        <div class="card-box noradius noborder bg-light">
                            <i class="bi bi-people float-end text-secondary"></i>
                            <div class="text-dark text-uppercase mb-4 fw-bold">{{ __('Accounts') }}</div>
                            <div class="mb-3 text-secondary fs-6 fw-bold">{{ $count_accounts ?? 0 }} {{ __('total') }}</div>

                            <div class="dropdown">
                                <button class="btn btn-gear dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    {{ __('View accounts') }}
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="{{ route('admin.accounts.index', ['role' => 'user']) }}">{{ __('Registered users') }}</a></li>
                                    <li><a class="dropdown-item" href="{{ route('admin.accounts.index', ['role' => 'internal']) }}">{{ __('Internal accounts') }}</a></li>                                    
                                    <li><a class="dropdown-item" href="{{ route('admin.accounts.index', ['role' => 'admin']) }}">{{ __('Administrator accounts') }}</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end row -->


                <div class="row">

                    <div class="col-12 col-md-6 mt-4">

                        <h5 class="mt-2">{{ __('Last accounts created') }}:</h5>

                        <div class="table-responsive-md">
                            <table class="table table-hover">
                                <tbody>

                                    @foreach ($last_accounts as $account)
                                        <tr>
                                            <th scope="row">
                                                <div class="text-muted small float-end ms-2">{{ date_locale($account->created_at, 'datetime') }}</div>
                                                <span class="float-start me-2"><img class="rounded rounded-circle" alt="{{ $account->name }}" style="height: 20px; height: 20px;"
                                                        src="{{ $account->getFirstMediaUrl('avatars', 'thumb') }}" /></span>
                                                <div class="fw-bold">
                                                    <a href="{{ route('admin.accounts.show', ['id' => $account->id]) }}">{{ $account->name }}</a>
                                                    @if ($account->role == 'admin')
                                                        <span class="badge bg-light text-secondary me-2">{{ __('Administrator') }}</span>
                                                    @endif
                                                    @if ($account->role == 'user')
                                                        <span class="badge bg-light text-secondary me-2">{{ __('Registered user') }}</span>
                                                    @endif
                                                    @if ($account->role == 'internal')
                                                        <span class="badge bg-light text-secondary me-2">{{ __('Internal account') }}</span>
                                                    @endif
                                                </div>
                                                <div class="text-muted fw-normal">{{ $account->email }}<div>
                                            </th>
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>


                    </div>



                    <div class="col-12 col-md-6 mt-4">


                    </div>

                </div>

            </div>

        </div>
    </div>



    <div class="col-md-4">
        <div class="card">

            <div class="card-header">
                <h4 class="card-title mb-0">{{ __('Files') }}</h4>
            </div>

            <div class="card-body">
                <div class="mb-2">
                    <i class="bi bi-folder"></i> {{ __('Number of files') }}: <b>{{ $media_count_files ?? 0 }}</b>
                    <div class="mb-1"></div>
                    <i class="bi bi-hdd"></i> {{ __('Size of files') }}: <b>{{ $media_size_total ?? 0 }}MB</b>
                </div>


                @if ($config->website_disabled ?? null)
                    <div class="fw-bold text-danger mb-2">
                        <i class="bi bi-info-circle"></i> {{ __('Public website is disabled.') }}
                    </div>
                @endif

                @if ($config->website_maintenance_enabled ?? null)
                    <div class="fw-bold text-danger mb-2">
                        <i class="bi bi-info-circle"></i> {{ __('Website is in maintenance mode.') }}
                    </div>
                @endif

                <div class="mt-2">
                    <a class="fw-bold" href="{{ route('admin.config', ['tab' => 'website']) }}">{{ __('Change website status') }}</a>
                </div>

            </div>
        </div>



    </div>

</div>
