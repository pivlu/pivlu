<!-- Left Sidebar -->
<div id="sidebar" class="active">
    <div class="sidebar-wrapper active">
        <div class="sidebar-header">
            <div class="d-flex justify-content-between">
                <div class="logo">
                    @if (($config->nura24_pro_active ?? null) == 0)
                        <a href="{{ route('admin') }}"><img src="{{ config('nura.cdn') }}/img/logo-backend.png" class="img-fluid" alt="{{ config('app.name') }}"></a>
                    @else
                        <a href="{{ route('admin') }}"><img src="{{ image($config->logo_backend ?? 'default/logo-backend.png') }}" class="img-fluid" alt="{{ $config->site_meta_author ?? 'Admin' }}"></a>
                    @endif
                </div>
                <div class="toggler">
                    <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
                </div>
            </div>
        </div>
        <div class="sidebar-menu">
            <ul class="menu">

                <li class="sidebar-item @if (($active_menu ?? null) == 'dashboard') active @endif">
                    <a href="{{ route('admin') }}" class='sidebar-link'>
                        <i class="bi bi-grid-fill"></i>
                        <span>{{ __('Dashboard') }}</span>
                    </a>
                </li>

                <li class="sidebar-item has-sub @if (($active_menu ?? null) == 'spaces') active @endif">
                    <a href="#" class='sidebar-link'>
                        <i class="bi bi-person-workspace"></i>
                        <span>{{ __('Workspaces') }}</span>
                    </a>
                    <ul class="submenu @if (($active_menu ?? null) == 'spaces') active @endif">                      
                        <li class="submenu-item @if (($active_submenu ?? null) == 'public') active @endif">
                            <a href="{{ route('admin.workspaces.show', ['code' => $publicSpace->code]) }}">
                                <i class="bi bi-eye me-1"></i> {{ __('Public workspace') }}
                            </a>
                        </li>

                        {{--
                        @if ($personalSpace ?? null)
                            <li class="submenu-item @if (($active_submenu ?? null) == 'personal') active @endif">
                                <a href="{{ route('admin.workspaces.show', ['code' => $personalSpace->code]) }}"><i class="bi bi-lock me-1"></i> {{ __('My personal space') }}</a>
                            </li>
                        @endif
                        --}}

                        @foreach ($sidebarPrivateSpaces as $sidebar_space)
                            <li class="submenu-item @if (($active_submenu ?? null) == "space_$sidebar_space->code") active @endif">
                                <a href="{{ route('admin.workspaces.show', ['code' => $sidebar_space->code]) }}">
                                    <i class="bi bi-square-fill me-1" style="color: {{ $sidebar_space->color ?? '#ffe599' }}"></i>
                                    {{ $sidebar_space->title }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </li>

                @if (check_access('accounts'))
                    <li class="sidebar-item has-sub @if (($active_menu ?? null) == 'users') active @endif">
                        <a href="#" class='sidebar-link'>
                            <i class="bi bi-people"></i>
                            <span>{{ __('Accounts and Users') }}</span>
                        </a>
                        <ul class="submenu @if (($active_menu ?? null) == 'users') active @endif">
                            <li class="submenu-item @if (($active_submenu ?? null) == 'users.internal') active @endif">
                                <a href="{{ route('admin.accounts.index', ['role' => 'internal']) }}">{{ __('Internal accounts') }}</a>
                            </li>

                            <li class="submenu-item @if (($active_submenu ?? null) == 'users.user') active @endif">
                                <a href="{{ route('admin.accounts.index', ['role' => 'user']) }}">{{ __('Registered users') }}</a>
                            </li>

                            <li class="submenu-item @if (($active_submenu ?? null) == 'invitations') active @endif">
                                <a href="{{ route('admin.accounts.invitations') }}">{{ __('Invitations') }}</a>
                            </li>
                        </ul>
                    </li>
                @endif


                @if (check_access('pages') || check_access('posts') || check_access('forum') || check_access('docs') || check_access('glossary') || check_access('developer'))
                    <li class="sidebar-item has-sub @if (($active_menu ?? null) == 'website') active @endif">
                        <a href="#" class='sidebar-link'>
                            <i class="bi bi-globe"></i>
                            <span>{{ __('Website') }}</span>
                        </a>
                        <ul class="submenu @if (($active_menu ?? null) == 'website') active @endif">
                            @if (check_access('pages'))
                                <li class="submenu-item @if (($active_submenu ?? null) == 'pages') active @endif">
                                    <a href="{{ route('admin.pages.index') }}">{{ __('Pages') }}</a>
                                </li>
                            @endif

                            @if (check_access('posts'))
                                <li class="submenu-item @if (($active_submenu ?? null) == 'posts') active @endif">
                                    <a href="{{ route('admin.posts.index') }}">{{ __('Posts') }}</a>
                                </li>
                            @endif

                            @if (check_access('forum'))
                                <li class="submenu-item @if (($active_submenu ?? null) == 'forum') active @endif">
                                    <a href="{{ route('admin.forum.topics') }}">{{ __('Community Forum') }}</a>
                                </li>
                            @endif

                            @if (check_access('docs'))
                                <li class="submenu-item @if (($active_submenu ?? null) == 'docs') active @endif">
                                    <a href="{{ route('admin.docs.index') }}">{{ __('Knowledge Base') }}</a>
                                </li>
                            @endif

                            @if (check_access('developer'))
                                <li class="submenu-item @if (($active_submenu ?? null) == 'template') active @endif">
                                    <a href="{{ route('admin.template') }}">{{ __('Website Template') }}</a>
                                </li>
                            @endif
                        </ul>
                    </li>
                @endif


                @if (check_access('tickets'))
                    <li class="sidebar-item @if (($active_menu ?? null) == 'tickets') active @endif">
                        <a href="{{ route('admin.tickets') }}" class='sidebar-link'>
                            <i class="bi bi-ticket"></i>
                            <span>{{ __('Support tickets') }}</span>
                        </a>
                    </li>
                @endif


                <li class="sidebar-item @if (($active_menu ?? null) == 'vault') active @endif">
                    <a href="{{ route('admin.vault') }}" class='sidebar-link'>
                        <i class="bi bi-shield-lock"></i>
                        <span>{{ __('Vault') }}</span>
                    </a>
                </li>


                @if (check_access('contact'))
                    <li class="sidebar-item @if (($active_menu ?? null) == 'contact') active @endif">
                        <a href="{{ route('admin.contact') }}" class='sidebar-link'>
                            <i class="bi bi-textarea-resize"></i>
                            <span>{{ __('Contact messages') }}</span>
                        </a>
                    </li>
                @endif

            </ul>
        </div>
        <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
    </div>
</div>
<!-- End Sidebar -->
