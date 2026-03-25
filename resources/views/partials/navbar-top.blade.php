{{-- Pivlu CE | Copyright (c) Iosif Gabriel Chimilevschi | AGPL-3.0 License | https://pivlu.com --}}
<nav class="navbar navbar-top navbar-expand-lg sticky-top">
    <div class="container-fluid px-3">

        {{-- Brand --}}
        <a class="navbar-brand d-flex align-items-center" href="{{ url('/account') }}">
            <span style="color: #fff; font-weight: 700; font-size: 1.15rem;">{{ config('app.name', 'Pivlu') }}</span>
        </a>

        {{-- Mobile sidebar toggle (visible when sidebar exists) --}}
        @if (isset($currentApp) && $currentApp)
            <button class="btn btn-sm d-lg-none me-2" id="sidebarToggle" type="button" style="color: var(--pv-nav-text);">
                <i class="bi bi-list fs-5"></i>
            </button>
        @endif

        {{-- Mobile navbar toggle --}}
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTopContent" aria-controls="navbarTopContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        {{-- Collapsible content --}}
        <div class="collapse navbar-collapse" id="navbarTopContent">

            {{-- App navigation --}}
            <ul class="navbar-nav nav-apps-list me-auto">
                <li class="nav-item">
                    <a class="nav-link nav-app-link {{ request()->is('account') ? 'active' : '' }}" href="{{ url('/account') }}">
                        <i class="bi bi-house"></i>
                        <span class="nav-app-label">Dashboard</span>
                    </a>
                </li>
            </ul>

            {{-- Right-side utilities --}}
            <ul class="navbar-nav ms-auto align-items-center gap-1">

                {{-- User dropdown --}}
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle d-flex align-items-center gap-2" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <span class="avatar-circle avatar-circle-sm">{{ auth()->user()->initials() }}</span>
                        <span class="d-none d-lg-inline" style="color: var(--pv-nav-text); font-size: .85rem;">{{ auth()->user()->name }}</span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li>
                            <h6 class="dropdown-header">{{ auth()->user()->name }}</h6>
                        </li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <a class="dropdown-item" href="#" id="darkModeToggle">
                                <i class="bi bi-moon me-2"></i> Dark Mode
                                <div class="form-check form-switch float-end ms-3 mb-0">
                                    <input class="form-check-input" type="checkbox" id="darkModeCheck" style="pointer-events: none;">
                                </div>
                            </a>
                        </li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="dropdown-item">
                                    <i class="bi bi-box-arrow-right me-2"></i> Logout
                                </button>
                            </form>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>
