<li class="sidebar-item @if (($active_menu ?? null) == 'dashboard') active @endif">
    <a class="sidebar-link" href="{{ route('admin.website.dashboard') }}">
        <i class="bi bi-grid-fill"></i>
        <span>{{ __('Website dashboard') }}</span>
    </a>
</li>

@foreach ($posts_types as $sidebar_post_type)
    @if ($sidebar_post_type->active != 0)
        @can('index', [App\Models\Post::class, $sidebar_post_type->id])
            <li class="sidebar-item @if (($active_menu ?? null) == 'post_type_' . $sidebar_post_type->id) active @endif">
                <a class="sidebar-link" href="{{ route('admin.posts.index', ['post_type_id' => $sidebar_post_type->id]) }}">
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
        <a class="sidebar-link" href="{{ route('admin.forms') }}">
            <i class="bi bi-envelope-arrow-up"></i> <span>{{ __('Forms') }}</span>
        </a>
    </li>
@endcan

<li class="sidebar-item @if (($active_menu ?? null) == 'themes') active @endif">
    <a class="sidebar-link" href="{{ route('admin.themes.index') }}">
        <i class="bi bi-easel"></i> <span>{{ __('Website template') }}</span>
    </a>
</li>

<li class="sidebar-item has-sub @if (($active_menu ?? null) == 'config') active @endif">
    <a href="#" class='sidebar-link'>
        <i class="bi bi-gear"></i>
        <span>{{ __('Configuration') }}</span>
    </a>
    <ul class="submenu @if (($active_menu ?? null) == 'config') active @endif">
        @if (Auth::user()->hasRole('admin'))
            <li class="submenu-item @if (($active_submenu ?? null) == 'settings') active @endif">
                <a href="{{ route('admin.website.config', ['tab' => 'website']) }}">{{ __('Website settings') }}</a>
            </li>

            <li class="submenu-item @if (($active_submenu ?? null) == 'post-types') active @endif">
                <a href="{{ route('admin.post-types.index') }}">{{ __('Manage content types') }}</a>
            </li>
        @endif
    </ul>
</li>

<li class="sidebar-item has-sub @if (($active_menu ?? null) == 'tools') active @endif">
    <a href="#" class='sidebar-link'>
        <i class="bi bi-tools"></i>
        <span>{{ __('Tools') }}</span>
    </a>
    <ul class="submenu @if (($active_menu ?? null) == 'tools') active @endif">
        @if (Auth::user()->hasRole('admin'))
            <li class="submenu-item @if (($active_submenu ?? null) == 'recycle_bin') active @endif">
                <a href="{{ route('admin.trash') }}">{{ __('Recycle Bin') }}</a>
            </li>
        @endif
    </ul>
</li>
