@if (count(languages()) > 1)
    <li class="nav-item dropdown">
        <a href="#" class="nav-link dropdown-toggle no-decoration" id="navbarDropdownLangs" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="bi bi-globe"></i> <i class="bi bi-chevron-down"></i>
        </a>
        <ul class="dropdown-menu dropdown-menu-lg-end style_nav_dropdown" aria-labelledby="navbarDropdownLangs">
            @foreach (languages() as $nav_lang)
                <li><a class="dropdown-item" @if ($nav_lang->is_default == 1) href="{{ route('home') }}" @else href="{{ route('locale.home', ['lang' => $nav_lang->code]) }}" @endif>{{ $nav_lang->name }}</a></li>
            @endforeach
        </ul>
    </li>
@endif
