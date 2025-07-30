<!-- Left Sidebar -->
<div id="sidebar" class="active">

    <div class="sidebar-wrapper active">

        <div class="sidebar-header">
            <div class="d-flex justify-content-between">
                <div class="logo">
                    <a href="{{ route('admin') }}"><img src="{{ asset('assets/img/logo-backend.png') }}" class="img-fluid" alt="{{ config('app.name') }}"></a>
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

                @foreach ($posts_types as $sidebar_post_type)                    
                    <li class="sidebar-item @if (($active_menu ?? null) == $sidebar_post_type->type) active @endif">
                        <a href="{{ route('admin.posts.index', ['type' => $sidebar_post_type->type]) }}" class='sidebar-link'>
                            {!! $sidebar_post_type->admin_menu_icon ?? '<i class="bi bi-file-text"></i>' !!}
                            <span>{{ $sidebar_post_type->name }}</span>
                        </a>
                    </li>
                @endforeach

                <li class="sidebar-item has-sub @if (($active_menu ?? null) == 'config') active @endif">
                    <a href="#" class='sidebar-link'>
                        <i class="bi bi-gear-fill"></i>
                        <span>{{ __('Configuration') }}</span>
                    </a>
                    <ul class="submenu @if (($active_menu ?? null) == 'config') active @endif">

                        <li class="submenu-item @if (($active_submenu ?? null) == 'config.plugins') active @endif">
                            <a href="{{ route('admin.config', ['tab' => 'apps']) }}">{{ __('Apps') }}</a>
                        </li>

                        <li class="submenu-item @if (($active_submenu ?? null) == 'config.website') active @endif">
                            <a href="{{ route('admin.config', ['tab' => 'website']) }}">{{ __('Website') }}</a>
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
