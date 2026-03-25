{{-- Pivlu CE | Copyright (c) Iosif Gabriel Chimilevschi | AGPL-3.0 License | https://pivlu.com --}}
<aside class="sidebar" id="accountSidebar">
    <div class="sidebar-inner">

        @if (isset($currentApp) && $currentApp)
            <div class="sidebar-header">
                <i class="bi bi-{{ $currentAppIcon ?? 'grid' }} me-2"></i>
                <span class="fw-bold">{{ $currentAppName ?? $currentApp }}</span>
            </div>
        @endif

        <nav class="sidebar-nav">
            <ul class="nav flex-column">

                @if (isset($sidebarMenu) && is_array($sidebarMenu))
                    @foreach ($sidebarMenu as $item)
                        @if (isset($item['divider']) && $item['divider'])
                            <li class="sidebar-divider"></li>
                        @elseif (isset($item['label']))
                            <li class="sidebar-section-label">{{ $item['label'] }}</li>
                        @else
                            <li class="nav-item">
                                <a class="nav-link {{ (isset($item['active']) && $item['active']) ? 'active' : '' }}" href="{{ $item['url'] ?? '#' }}">
                                    @if (isset($item['icon']))
                                        <i class="bi bi-{{ $item['icon'] }} me-2"></i>
                                    @endif
                                    {{ $item['title'] ?? '' }}
                                </a>
                            </li>
                        @endif
                    @endforeach
                @endif

            </ul>
        </nav>
    </div>
</aside>
