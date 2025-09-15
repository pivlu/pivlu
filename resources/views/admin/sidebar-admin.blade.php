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


                <li class="sidebar-item has-sub @if (($active_menu ?? null) == 'users') active @endif">
                    <a href="#" class='sidebar-link'>
                        <i class="bi bi-person-bounding-box"></i>
                        <span>{{ __('Accounts and Users') }}</span>
                    </a>
                    <ul class="submenu @if (($active_menu ?? null) == 'users') active @endif">
                        <li class="submenu-item @if (($active_submenu ?? null) == 'users.internal') active @endif">
                            <a href="{{ route('admin.accounts.index', ['role' => 'internal']) }}">{{ __('Internal accounts') }}</a>
                        </li>

                        <li class="submenu-item @if (($active_submenu ?? null) == 'users.user') active @endif">
                            <a href="{{ route('admin.accounts.index', ['role' => 'user']) }}">{{ __('Registered users') }}</a>
                        </li>

                        <li class="submenu-item @if (($active_submenu ?? null) == 'users.admin') active @endif">
                            <a href="{{ route('admin.accounts.index', ['role' => 'admin']) }}">{{ __('Administrator accounts') }}</a>
                        </li>
                    </ul>
                </li>


                <li class="sidebar-item has-sub @if (($active_menu ?? null) == 'website') active @endif">
                    <a href="#" class='sidebar-link'>
                        <i class="bi bi-globe"></i>
                        <span>{{ __('Website') }}</span>
                    </a>
                    <ul class="submenu @if (($active_menu ?? null) == 'website') active @endif">

                        @foreach ($posts_types as $sidebar_post_type)
                            @if (($sidebar_post_type->module->status ?? null) != 'disabled')
                                <li class="submenu-item @if (($active_submenu ?? null) == 'post_type_' . $sidebar_post_type->id) active @endif">
                                    <a href="{{ route('admin.posts.index', ['post_type_id' => $sidebar_post_type->id]) }}">
                                        {!! $sidebar_post_type->admin_menu_icon ?? '<i class="bi bi-file-text"></i>' !!}
                                        @if ($sidebar_post_type->type == 'page')
                                            <span>{{ __('Pages') }}</span>
                                        @else
                                            <span>{{ $sidebar_post_type->default_language_content->name }}</span>
                                        @endif
                                    </a>
                                </li>
                            @endif
                        @endforeach

                        <li class="submenu-item @if (($active_submenu ?? null) == 'forms') active @endif">
                            <a href="{{ route('admin.forms') }}"><i class="bi bi-envelope-arrow-up"></i> {{ __('Forms messages') }}</a>
                        </li>

                        <li class="submenu-item @if (($active_submenu ?? null) == 'appearance') active @endif">
                            <a href="{{ route('admin.themes.index') }}"><i class="bi bi-easel"></i> {{ __('Theme builder') }}</a>
                        </li>

                        <li class="submenu-item @if (($active_submenu ?? null) == 'blocks') active @endif">
                            <a href="{{ route('admin.block-components') }}"><i class="bi bi-bounding-box"></i> {{ __('Block components') }}</a>
                        </li>

                        <li class="submenu-item @if (($active_submenu ?? null) == 'config') active @endif">
                            <a href="{{ route('admin.config', ['tab' => 'website']) }}"><i class="bi bi-gear"></i> {{ __('Website settings') }}</a>
                        </li>

                        <li class="submenu-item @if (($active_submenu ?? null) == 'post-types') active @endif">
                            <a href="{{ route('admin.post-types.index') }}"><i class="bi bi-check2-square"></i> {{ __('Manage post types') }}</a>
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
                            <a href="{{ route('admin.modules') }}">{{ __('Plugins / Modules') }}</a>
                        </li>
                    </ul>
                </li>

                <li class="sidebar-item has-sub @if (($active_menu ?? null) == 'tools') active @endif">
                    <a href="#" class='sidebar-link'>
                        <i class="bi bi-tools"></i>
                        <span>{{ __('Tools') }}</span>
                    </a>
                    <ul class="submenu @if (($active_menu ?? null) == 'tools') active @endif">

                        <li class="submenu-item @if (($active_submenu ?? null) == 'recycle_bin') active @endif">
                            <a href="{{ route('admin.recycle_bin') }}">{{ __('Recycle Bin') }}</a>
                        </li>

                    </ul>
                </li>
            </ul>
        </div>
        <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
    </div>
</div>
<!-- End Sidebar -->
