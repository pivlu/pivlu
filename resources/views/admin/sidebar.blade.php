<!-- Left Sidebar -->
<div id="sidebar" class="active">

    <div class="sidebar-wrapper active">

        <div class="sidebar-header">
            <div class="d-flex justify-content-between">
                <div class="logo">
                    <a href="{{ route('admin') }}"><img src="{{ asset('assets/img/logo-backend.png') }}" class="img-fluid" alt="{{ config('app.name') }}"></a>
                </div>
                <div class="toggler">
                    <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle fs-3 text-white"></i></a>
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

                @can('view', App\Models\User::class)
                    <li class="sidebar-item has-sub @if (($active_menu ?? null) == 'accounts') active @endif">
                        <a href="#" class='sidebar-link'>
                            <i class="bi bi-person-bounding-box"></i>
                            <span>{{ __('Accounts') }}</span>
                        </a>
                        <ul class="submenu @if (($active_menu ?? null) == 'accounts') active @endif">
                            <li class="submenu-item @if (($active_submenu ?? null) == 'accounts') active @endif">
                                <a href="{{ route('admin.accounts.index') }}">{{ __('View accounts') }}</a>
                            </li>

                            @if (Auth::user()->role == 'admin')
                                <li class="submenu-item @if (($active_submenu ?? null) == 'roles') active @endif">
                                    <a href="{{ route('admin.roles.index') }}">{{ __('Roles and permissions') }}</a>
                                </li>
                            @endif
                        </ul>
                    </li>
                @endcan

                @foreach ($posts_types as $sidebar_post_type)
                    @if ($sidebar_post_type->active != 0)
                        @can('index', [App\Models\Post::class, $sidebar_post_type->id])
                            <li class="sidebar-item @if (($active_menu ?? null) == 'post_type_' . $sidebar_post_type->id) active @endif">
                                <a href="{{ route('admin.posts.index', ['post_type_id' => $sidebar_post_type->id]) }}" class='sidebar-link'>
                                    {!! $sidebar_post_type->admin_menu_icon ?? '<i class="bi bi-file-text"></i>' !!}

                                    @if ($sidebar_post_type->type == 'page')
                                        <span>{{ __('Pages') }}</span>
                                    @else
                                        <span>{{ $sidebar_post_type->default_language_content->name }}</span>
                                    @endif
                                </a>
                            </li>
                        @endcan
                    @endif
                @endforeach

                @can('view_forms_messages', [App\Models\FormData::class])
                    <li class="sidebar-item @if (($active_menu ?? null) == 'forms') active @endif">
                        <a href="{{ route('admin.forms') }}" class='sidebar-link'>
                            <i class="bi bi-envelope-arrow-up"></i> <span>{{ __('Forms') }}</span>
                        </a>
                    </li>
                @endcan

                <li class="sidebar-item has-sub @if (($active_menu ?? null) == 'appearance') active @endif">
                    <a href="#" class='sidebar-link'>
                        <i class="bi bi-easel"></i>
                        <span>{{ __('Website appearance') }}</span>
                    </a>
                    <ul class="submenu @if (($active_menu ?? null) == 'appearance') active @endif">
                        <li class="submenu-item @if (($active_submenu ?? null) == 'templates') active @endif">
                            <a href="{{ route('admin.themes.index') }}"><i class="bi bi-plugin"></i> {{ __('Templates') }}</a>
                        </li>

                        <li class="submenu-item @if (($active_submenu ?? null) == 'menus') active @endif">
                            <a href="{{ route('admin.theme-menus.index') }}"><i class="bi bi-menu-down"></i> {{ __('Website menus') }}</a>
                        </li>

                        <li class="submenu-item @if (($active_submenu ?? null) == 'footer') active @endif">
                            <a href="{{ route('admin.theme-footer') }}"><i class="bi bi-menu-up"></i> {{ __('Website footer') }}</a>
                        </li>

                        <li class="submenu-item @if (($active_submenu ?? null) == 'components') active @endif">
                            <a href="{{ route('admin.block-components') }}"><i class="bi bi-bounding-box"></i> {{ __('Block components') }}</a>
                        </li>

                        <li class="submenu-item @if (($active_submenu ?? null) == 'styles') active @endif">
                            <a href="{{ route('admin.theme-styles.index') }}"><i class="bi bi-palette"></i> {{ __('Block styles') }}</a>
                        </li>

                        <li class="submenu-item @if (($active_submenu ?? null) == 'buttons') active @endif">
                            <a href="{{ route('admin.theme-buttons.index') }}"><i class="bi bi-palette"></i> {{ __('Buttons') }}</a>
                        </li>

                        <li class="submenu-item @if (($active_submenu ?? null) == 'custom-code') active @endif">
                            <a href="{{ route('admin.theme-buttons.index') }}"><i class="bi bi-code-square"></i> {{ __('Custom code') }}</a>
                        </li>
                    </ul>
                </li>


                <li class="sidebar-item has-sub @if (($active_menu ?? null) == 'config') active @endif">
                    <a href="#" class='sidebar-link'>
                        <i class="bi bi-gear-fill"></i>
                        <span>{{ __('Configuration') }}</span>
                    </a>
                    <ul class="submenu @if (($active_menu ?? null) == 'config') active @endif">
                        <li class="submenu-item @if (($active_submenu ?? null) == 'modules') active @endif">
                            <a href="{{ route('admin.modules') }}"><i class="bi bi-plugin"></i> {{ __('Plugins') }}</a>
                        </li>

                        @if (Auth::user()->role == 'admin')
                            <li class="submenu-item @if (($active_submenu ?? null) == 'website') active @endif">
                                <a href="{{ route('admin.config', ['tab' => 'website']) }}"><i class="bi bi-gear"></i> {{ __('Website settings') }}</a>
                            </li>
                        @endif

                        <li class="submenu-item @if (($active_submenu ?? null) == 'post-types') active @endif">
                            <a href="{{ route('admin.post-types.index') }}"><i class="bi bi-check2-square"></i> {{ __('Manage content types') }}</a>
                        </li>
                    </ul>
                </li>

                <li class="sidebar-item has-sub @if (($active_menu ?? null) == 'tools') active @endif">
                    <a href="#" class='sidebar-link'>
                        <i class="bi bi-tools"></i>
                        <span>{{ __('Tools') }}</span>
                    </a>
                    <ul class="submenu @if (($active_menu ?? null) == 'tools') active @endif">
                        @if (Auth::user()->role == 'admin')
                            <li class="submenu-item @if (($active_submenu ?? null) == 'recycle_bin') active @endif">
                                <a href="{{ route('admin.recycle_bin') }}">{{ __('Recycle Bin') }}</a>
                            </li>
                        @endif
                    </ul>
                </li>
            </ul>
        </div>
        <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
    </div>
</div>
<!-- End Sidebar -->
