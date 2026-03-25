{{-- Pivlu CE | Copyright (c) Iosif Gabriel Chimilevschi | AGPL-3.0 License | https://pivlu.com --}}
<!doctype html>
<html lang="{{ $lang ?? 'en' }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Confirm Password - {{ config('app.name') }}</title>

    @include('auth.includes.global-head')
</head>

<body class="bg-light">

    <div class="container mt-5">

        <div class="row py-5 mt-5 align-items-center">

            @include('auth.includes.auth-header')

            <div class="col-md-6 offset-md-3 bg-white rounded">

                @if ($errors->any())
                    <div class="alert alert-danger mt-3">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="fs-5 mb-3 mt-3 fw-bold">Confirm Password</div>

                <p style="color: var(--pv-text-muted, #94a3b8);">This is a secure area. Please confirm your password before continuing.</p>

                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('password.confirm') }}">
                    @csrf

                    <div class="input-group mb-3 mt-3">
                        <span class="input-group-text" id="addonPw"><i class="bi bi-lock"></i></span>
                        <input type="password" name="password" class="form-control form-control-lg @error('password') is-invalid @enderror" placeholder="Password" aria-label="Password" aria-describedby="addonPw" required autocomplete="current-password">

                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary btn-block py-2">
                            Confirm Password
                        </button>
                    </div>

                    <div class="text-center mt-3 mb-3">
                        or <a class="fw-bold" href="{{ url('/account') }}">Return to dashboard</a>
                    </div>
                </form>

            </div>

            @include('auth.includes.footer-text')

        </div>
    </div>

</body>

</html>
