<header class='mb-0'>
    <nav class="navbar navbar-expand navbar-navigation ">
        <div class="container-fluid">
            <a href="#" class="burger-btn d-block">
                <i class="bi bi-arrow-bar-left fs-4"></i>
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-1 mb-lg-0">                                      
                    <li class="nav-item me-3">
                        <a class="nav-link" target="_blank" href="{{ route('home') }}" title="{{ __('View website') }}">
                            <i class='bi bi-box-arrow-up-right'></i>
                        </a>
                    </li>
                </ul>

                <div class="dropdown">
                    <a href="#" data-bs-toggle="dropdown" aria-expanded="false">
                        <div class="user-menu d-flex">
                            <div class="user-img d-flex align-items-center">
                                <div class="avatar avatar-md">
                                    <img src="{{ Auth::user()->getFirstMediaUrl('avatars', 'thumb') }}" class="img-fluid" />
                                </div>
                            </div>
                        </div>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton">
                        <li>
                            <div class="dropdown-header fw-bold fs-6 line-clamp-1">{{ Auth::user()->name }}</h6>
                        </li>
                        <li><a class="dropdown-item" href="{{ route('admin.accounts.show', ['id' => Auth::user()->id]) }}"><i class="icon-mid bi bi-person me-2"></i> {{ __('Profile') }}</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i class="icon-mid bi bi-box-arrow-left me-2"></i> {{ __('Logout') }}</a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
</header>
