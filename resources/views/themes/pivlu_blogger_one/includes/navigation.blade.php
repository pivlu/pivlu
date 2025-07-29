<header class="header">
    <div class="navbar-area">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-12">
                    <nav class="navbar navbar-expand-lg">
                        <a class="navbar-brand" href="{{ route('home') }}">
                            <img src="{{ theme_asset('assets/img/logo.png') }}" alt="Site title" />
                        </a>
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                            aria-label="Toggle navigation">
                            <span class="toggler-icon"></span>
                            <span class="toggler-icon"></span>
                            <span class="toggler-icon"></span>
                        </button>

                        <div class="collapse navbar-collapse sub-menu-bar" id="navbarSupportedContent">
                            <ul id="nav" class="navbar-nav ms-auto">
                                <li class="nav-item d-lg-none d-xl-block">
                                    <a href="{{ route('home') }}">{{ __('Home') }}</a>
                                </li>

                                <li class="nav-item">
                                    <a href="blog-post.php">Blog Post</a>
                                </li>

                                <li class="nav-item">
                                    <a href="about.php">About</a>
                                </li>

                                <li class="nav-item">
                                    <a href="faq.php">FAQ</a>
                                </li>

                                <li class="nav-item">
                                    <a href="{{ route('home') }}">{{ __('Contact') }}</a>
                                </li>
                            </ul>
                        </div>
                        <!-- navbar collapse -->
                    </nav>
                    <!-- navbar -->
                </div>
            </div>
            <!-- row -->
        </div>
        <!-- container -->
    </div>
    <!-- navbar area -->
</header>
