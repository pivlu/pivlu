{{-- Pivlu CE | Copyright (c) Iosif Gabriel Chimilevschi | AGPL-3.0 License | https://pivlu.com --}}
<!doctype html>
<html lang="{{ $lang ?? 'en' }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Reset Password - {{ config('app.name') }}</title>

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

                <div class="fs-5 mb-3 mt-3 fw-bold">Reset Password</div>

                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif

                <form method="POST" action="{{ url('/reset-password') }}">
                    @csrf

                    <input type="hidden" name="token" value="{{ $request->route('token') }}">

                    <div class="form-group row mb-3">
                        <label for="email" class="col-md-4 col-form-label text-md-right">Email address</label>
                        <div class="col-md-8">
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $request->email ?? old('email') }}" required autocomplete="email" autofocus>
                        </div>
                    </div>

                    <div class="form-group row mb-3">
                        <label for="password" class="col-md-4 col-form-label text-md-right">New Password</label>
                        <div class="col-md-8">
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                        </div>
                    </div>

                    <div class="form-group row mb-3">
                        <label for="password-confirm" class="col-md-4 col-form-label text-md-right">Confirm Password</label>
                        <div class="col-md-8">
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary">Reset Password</button>

                    <!-- Divider -->
                    <div class="form-group col-lg-12 mx-auto d-flex align-items-center my-3">
                        <div class="border-bottom w-100"></div>
                        <span class="px-2 small" style="color: var(--pv-text-muted, #94a3b8);">or</span>
                        <div class="border-bottom w-100"></div>
                    </div>

                    <!-- Back to login -->
                    <div class="text-center w-100">
                        <p class="fw-bold" style="color: var(--pv-text-muted, #94a3b8);">Remember your password? <a href="{{ route('login') }}" class="text-secondary">Login</a></p>
                    </div>
                </form>

            </div>

            @include('auth.includes.footer-text')

        </div>

    </div>
</body>

</html>
