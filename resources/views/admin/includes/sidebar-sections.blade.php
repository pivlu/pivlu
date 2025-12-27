<li class="sidebar-item drive-sidebar-upload-btn mb-4">
    <div class="dropdown">
        <button class="btn btn-sidebar-products dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
            @switch($nav_section ?? null)
                @case('website')
                    <i class="bi bi-globe"></i> {{ __('Website') }}
                @break

                @case('accounts')
                    <i class="bi bi-people"></i> {{ __('Accounts') }}
                @break

                @case('trash')
                    <i class="bi bi-trash"></i> {{ __('Trash') }}
                @break

                @case('settings')
                    <i class="bi bi-gear"></i> {{ __('Settings') }}
                @break

                @default
                    <i class="bi bi-grid-fill"></i> {{ __('Dashboard') }}
            @endswitch
        </button>
        <ul class="dropdown-menu w-100">
            <li><a class="dropdown-item" href="{{ route('admin') }}"><i class="bi bi-grid"></i> <span>{{ __('Dashboard') }}</span></a></li>
            <li><a class="dropdown-item" href="{{ route('admin.website.dashboard') }}"><i class="bi bi-globe"></i> <span>{{ __('Website') }}</span></a></li>
            <li>
                <hr class="dropdown-divider">
            </li>
            <li><a class="dropdown-item" href="{{ route('admin.accounts.index') }}"><i class="bi bi-people"></i> <span>{{ __('Accounts') }}</span></a></li>
            <li><a class="dropdown-item" href="{{ route('admin.config', ['tab' => 'general']) }}"><i class="bi bi-gear"></i> <span>{{ __('Settings') }}</span></a></li>
            <li><a class="dropdown-item" href="{{ route('admin.trash') }}"><i class="bi bi-trash"></i> <span>{{ __('Trash') }}</span></a></li>
            <li><a class="dropdown-item" href="{{ route('admin.accounts.show', ['id' => Auth::user()->id]) }}"><i class="bi bi-person"></i> <span>{{ __('My account') }}</span></a></li>
        </ul>
    </div>
</li>
