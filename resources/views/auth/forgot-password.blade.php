{{-- Pivlu CE | Copyright (c) Iosif Gabriel Chimilevschi | AGPL-3.0 License | https://pivlu.com --}}
<!doctype html>
<html lang="{{ $lang ?? 'en' }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

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

                <form method="POST" action="{{ route('password.email') }}">
                    @csrf

                    <div class="input-group mb-3">
                        <span class="input-group-text" id="addonEmail"><i class="bi bi-envelope"></i></span>
                        <input type="email" name="email" class="form-control form-control-lg @error('email') is-invalid @enderror" placeholder="Email address" aria-label="Email address" aria-describedby="addonEmail"
                            required autocomplete="email" value="{{ old('email') }}">
                    </div>

                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror

                    <!-- Submit Button -->
                    <div class="form-group col-lg-12 mx-auto">
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary btn-block py-2">
                                <span class="fw-bold">Send Reset Link</span>
                            </button>
                        </div>
                    </div>

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
