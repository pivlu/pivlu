<li class="sidebar-item @if (($active_menu ?? null) == 'accounts') active @endif">
    <a href="{{ route('admin.accounts.index') }}" class='sidebar-link'>
        <i class="bi bi-people-fill"></i>
        <span>{{ __('Accounts') }}</span>
    </a>
</li>

<li class="sidebar-item @if (($active_menu ?? null) == 'roles') active @endif">
    <a href="{{ route('admin.accounts.roles') }}" class='sidebar-link'>
        <i class="bi bi-person-fill-lock"></i>
        <span>{{ __('Roles and permissions') }}</span>
    </a>
</li>

<li class="sidebar-item @if (($active_menu ?? null) == 'invitations') active @endif">
    <a href="{{ route('admin.accounts.invitations') }}" class='sidebar-link'>
        <i class="bi bi-person-plus-fill"></i>
        <span>{{ __('Invitations') }}</span>
    </a>
</li>
