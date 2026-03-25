{{-- Pivlu CE | Copyright (c) Iosif Gabriel Chimilevschi | AGPL-3.0 License | https://pivlu.com --}}
<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-bs-theme="light">
<head>
    @include('partials.head')
</head>

<body class="d-flex flex-column min-vh-100">

    {{-- Top navigation --}}
    @include('partials.navbar-top')

    {{-- Body wrapper: sidebar + main content --}}
    <div class="app-wrapper d-flex flex-grow-1">

        {{-- Left sidebar (app-specific menu) --}}
        @if (isset($currentApp) && $currentApp)
            @include('partials.sidebar')
            <div class="sidebar-backdrop" id="sidebarBackdrop"></div>
        @endif

        {{-- Main content --}}
        <main class="main-content flex-grow-1">
            <div class="container-fluid py-3">

                {{-- Breadcrumb --}}
                @hasSection('breadcrumb')
                    <nav aria-label="breadcrumb">
                        @yield('breadcrumb')
                    </nav>
                @endif

                {{-- Page header --}}
                @hasSection('page-header')
                    <div class="d-flex flex-wrap justify-content-between align-items-center mb-4">
                        @yield('page-header')
                    </div>
                @endif

                {{-- Flash messages --}}
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                @if (session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                @yield('content')
            </div>
        </main>
    </div>

    {{-- Footer --}}
    @include('partials.footer')

    {{-- Scripts --}}
    @include('partials.scripts')

    {{-- Global confirm modal --}}
    @include('components.confirm-modal')

</body>
</html>
