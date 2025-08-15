<li class="nav-item dropdown">
    <a href="#" class="nav-link dropdown-toggle" id="navbarDropdownLangs" role="button" data-bs-toggle="dropdown" aria-expanded="false">
        {{ strtoupper($locale) }} <i class="bi bi-chevron-down"></i>
    </a>
    <ul class="dropdown-menu dropdown-menu-lg-end style_nav_dropdown" aria-labelledby="navbarDropdownLangs">
        @foreach ($languages as $nav_lang)
            <li><a class="dropdown-item" @if ($nav_lang->is_default == 1) href="{{ route('home') }}" @else href="{{ route('locale.home', ['locale' => $nav_lang->code]) }}" @endif>{{ $nav_lang->name }}</a></li>
        @endforeach
    </ul>
</li>
