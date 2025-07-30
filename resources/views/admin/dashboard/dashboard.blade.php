<div class="row">

    <div class="col-md-8">
        <div class="card">
            <div class="card-header">

                <div class="row">

                    <div class="col-12">
                       
                        <h4 class="card-title">{{ __('Dashboard') }}</h4>
                    </div>

                </div>

            </div>


            <div class="card-body">
                @if ($message = Session::get('error'))
                    <div class="alert alert-danger">
                        @if ($message == 'demo')
                            {{ __('Error. This action is disabled in demo mode') }}
                        @endif
                    </div>
                @endif               

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
                                                        src="{{ avatar($account->id) }}" /></span>
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
                <h4 class="card-title mb-0">{{ __('XXX') }}</h4>
            </div>

            <div class="card-body">
                <div class="mb-2">
                    
                </div>

            </div>
        </div>


        <div class="card">

            <div class="card-header">
                <h4 class="card-title mb-0">{{ __('Website status') }}</h4>
            </div>

            <div class="card-body">
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

                @if (!($config->website_disabled ?? null) && !($config->website_maintenance_enabled ?? null))
                    <div class="fw-bold text-success mb-2">
                        <i class="bi bi-info-circle"></i> {{ __('Public website is active.') }}
                    </div>
                @endif

                @if ($config->registration_disabled ?? null)
                    <div class="fw-bold text-danger mb-2">
                        <i class="bi bi-info-circle"></i> {{ __('Warning! Users registration is disabled.') }}
                    </div>
                @endif

                <div class="mt-2">
                    <a class="fw-bold" href="{{ route('admin.config', ['tab' => 'website']) }}">{{ __('Change website status') }}</a>
                </div>
            </div>


            <div class="card-header">
                <h4 class="card-title mb-0">{{ __('Modules') }}</h4>
            </div>

            <div class="card-body">
                <i class="bi bi-dot"></i> {{ __('Posts (articles, news, announcements, blog...)') }}:
                @if (($config->module_posts ?? null) == 'active')
                    <span class="fw-bold text-success"> {{ __('active') }}</span>
                @elseif (($config->module_posts ?? null) == 'inactive')
                    <span class="fw-bold text-warning"> {{ __('inactive') }}</span>
                @else
                    <span class="fw-bold text-danger"> {{ __('disabled') }}</span>
                @endif

                <div class="mb-2"></div>

                <i class="bi bi-dot"></i> {{ __('Contact Page') }}:
                @if (($config->module_contact ?? null) == 'active')
                    <span class="fw-bold text-success"> {{ __('active') }}</span>
                @elseif (($config->module_contact ?? null) == 'inactive')
                    <span class="fw-bold text-warning"> {{ __('inactive') }}</span>
                @else
                    <span class="fw-bold text-danger"> {{ __('disabled') }}</span>
                @endif

                <div class="mb-2"></div>

                <i class="bi bi-dot"></i> {{ __('Community Forum') }}:
                @if (($config->module_forum ?? null) == 'active')
                    <span class="fw-bold text-success"> {{ __('active') }}</span>
                @elseif (($config->module_forum ?? null) == 'inactive')
                    <span class="fw-bold text-warning"> {{ __('inactive') }}</span>
                @else
                    <span class="fw-bold text-danger"> {{ __('disabled') }}</span>
                @endif

                <div class="mb-2"></div>

                <i class="bi bi-dot"></i> {{ __('Knowledge Base') }}:
                @if (($config->module_docs ?? null) == 'active')
                    <span class="fw-bold text-success"> {{ __('active') }}</span>
                @elseif (($config->module_docs ?? null) == 'inactive')
                    <span class="fw-bold text-warning"> {{ __('inactive') }}</span>
                @else
                    <span class="fw-bold text-danger"> {{ __('disabled') }}</span>
                @endif

                <div class="mb-2"></div>

                <i class="bi bi-dot"></i> {{ __('Support Tickets') }}:
                @if (($config->module_tickets ?? null) == 'active')
                    <span class="fw-bold text-success"> {{ __('active') }}</span>
                @elseif (($config->module_tickets ?? null) == 'inactive')
                    <span class="fw-bold text-warning"> {{ __('inactive') }}</span>
                @else
                    <span class="fw-bold text-danger"> {{ __('disabled') }}</span>
                @endif

                <div class="mt-2">
                    <a class="fw-bold" href="{{ route('admin.config', ['tab' => 'general']) }}">{{ __('Go to modules settings') }}</a>
                </div>

            </div>

        </div>
    </div>

</div>
