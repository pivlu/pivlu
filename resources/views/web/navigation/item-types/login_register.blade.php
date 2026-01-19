@if (Auth::user() ?? null)
    <li class="nav-item">
        <a href="{{ route('account') }}" class="nav-link">
            <img class="avatar rounded-circle me-1" alt="{{ Auth::user()->name }}" src="{{ avatar(Auth::user(), 'thumb') }}" />
            {{ strtok(Auth::user()->name, ' ') }}
        </a>
    </li>
@else
    <li class="nav-item">
        <a href="{{ route('user') }}" class="nav-link"><i class="bi bi-person me-2"></i> <span class="d-none d-md-inline-block"> {{ __('My account') }}</span></a>
    </li>
@endif
