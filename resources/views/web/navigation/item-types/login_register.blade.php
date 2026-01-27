@if (Auth::user() ?? null)
    <li class="nav-item">
        <a href="{{ route('account') }}" class="nav-link no-decoration">
            <img class="avatar rounded-circle me-1" alt="{{ Auth::user()->name }}" src="{{ avatar(Auth::user(), 'thumb') }}" />
            {{ strtok(Auth::user()->name, ' ') }}
        </a>
    </li>
@else
    <li class="nav-item">
        <a href="{{ route('login') }}" class="nav-link"><i class="bi bi-person-circle me-1"></i> <span class="d-none d-md-inline-block"> {{ __('My account') }}</span></a>
    </li>
@endif
