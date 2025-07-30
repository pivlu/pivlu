<!DOCTYPE html>
<html lang="en">

<head>

    <title>{{ __('Maintenance mode') }}</title>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="shortcut icon" href="{{ asset('assets/img/favicon.png') }}">

    <!-- Bootstrap CSS-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">

</head>

<body class="style_global">

    <!-- Start Main Content -->
    <div class="content">

        <div class="container">
            <div class="mt-5">
                {!! $config->website_maintenance_text ?? __('Maintenance mode') !!}
            </div>

            @if (Auth::user() ?? null)
                <hr>
                <i class="bi bi-info-circle"></i> {{ __('You are logged as') }} <b>{{ Auth::user()->name }}</b>.

                @if (Auth::user()->role == 'admin' || Auth::user()->role == 'internal')
                    <div class="mt-3">
                        <a class="fw-bold" href="{{ route('admin') }}">{{ __('Go to my account') }}</a>

                        <span class="ms-3">
                            <a class="fw-bold" href="{{ route('home') }}">{{ __('Preview website') }}</a>
                        </span>
                    </div>
                @else
                    <a class="fw-bold" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">{{ __('Logout') }}</a>
                    <form id="logout-form" action="{{ route('logout') }}" method="post" style="display: none;">
                        @csrf
                    </form>
                @endif
            @endif
        </div>
    </div>
    <!-- End Main Content -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
    {!! $config->template_global_footer_code ?? null !!}

</body>

</html>
