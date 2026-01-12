<!DOCTYPE html>
<html lang="{{ theme_meta('locale') }}" dir="{{ theme_meta('dir') }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>{{ __('Maintenance mode') }}</title>
    <!-- Favicon -->
    @if ($config->favicon ?? null)
        <link rel="shortcut icon" href="{{ asset('uploads/' . $config->favicon) }}">
    @else
        <link rel="shortcut icon" href="{{ asset('assets/img/favicon.png') }}">
    @endif

    <!-- Bootstrap CSS-->
    @if (theme_meta('dir') == 'rtl')
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.rtl.min.css" integrity="sha384-7mQhpDl5nRA5nY9lr8F1st2NbIly/8WqhjTp+0oFxEA/QUuvlbF6M1KXezGBh3Nb"
            crossorigin="anonymous">
    @else
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    @endif

</head>

<body class="style_global">

    <!-- Start Main Content -->
    <div class="content">

        <div class="container">
            <div class="mt-5">
                {!! $tpl_config->website_maintenance_text ?? __('Maintenance mode') !!}
            </div>

            @if (Auth::user() ?? null)
                <hr>
                <i class="bi bi-info-circle"></i> {{ __('You are logged as') }} <b>{{ Auth::user()->name }}</b>.

                @if (Auth::user()->role_group == 'admin' || Auth::user()->role_group == 'internal')
                    <div class="mt-3">
                        <a class="fw-bold" href="{{ route('admin') }}">{{ __('Go to my account') }}</a>
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


</body>

</html>
