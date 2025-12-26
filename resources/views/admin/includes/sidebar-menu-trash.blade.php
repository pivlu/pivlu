<li class="sidebar-item @if (($active_menu ?? null) == 'trash') active @endif">
    <a class="sidebar-link" href="{{ route('admin.trash') }}">
        <i class="bi bi-trash"></i>
        <span>{{ __('Trash') }}</span>
    </a>
</li>

