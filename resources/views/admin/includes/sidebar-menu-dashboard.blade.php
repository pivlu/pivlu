<li class="sidebar-item @if (($active_menu ?? null) == 'dashboard') active @endif">
    <a href="{{ route('admin') }}" class='sidebar-link'>
        <i class="bi bi-grid-fill"></i>
        <span>{{ __('Dashboard') }}</span>
    </a>
</li>
