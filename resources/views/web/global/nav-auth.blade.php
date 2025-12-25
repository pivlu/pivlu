@if (Auth::user() ?? null)
    <li class="nav-item dropdown">
        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false" id="navbarDropdownAuth" role="button">
            <img class="avatar rounded-circle me-1" alt="{{ Auth::user()->name }}" src="{{ avatar(Auth::user()->avatar_media_id, 'thumb') }}" />
            {{ strtok(Auth::user()->name, ' ') }} <i class="bi bi-chevron-down"></i>
        </a>        

        <ul class="dropdown-menu dropdown-menu-lg-end style_nav_dropdown" aria-labelledby="navbarDropdownAuth">

            @if (Auth::user()->role == 'admin' || Auth::user()->role == 'internal')
                <li><a href="{{ route('admin') }}" class="dropdown-item"><i class="bi bi-person-workspace me-2"></i> {{ __('Admin area') }}</a></li>
            @endif

            @if (Auth::user()->role == 'user')
                @if (get_default_language()->code == $locale)
                    <li><a href="{{ route('user') }}" class="dropdown-item"><i class="bi bi-person-circle me-2"></i> {{ __('My account') }}</a></li>
                @else
                    <li><a href="{{ route('locale.user', ['locale' => $locale]) }}" class="dropdown-item"><i class="bi bi-person-circle me-2"></i> {{ __('My account') }}</a></li>
                @endif
            @endif

            <li><a href="{{ route('logout') }}" class="dropdown-item" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="bi bi-box-arrow-right me-2"></i>
                    {{ __('Sign out') }}</a></li>
            <form id="logout-form" action="{{ route('logout') }}" method="post" style="display: none;">
                @csrf
            </form>
        </ul>
    </li>
@else
    <li class="nav-item">
        <a href="{{ route('user') }}" class="nav-link"><i class="bi bi-person me-2"></i> <span class="d-none d-md-inline-block"> {{ __('My account') }}</span></a>
    </li>
@endif
