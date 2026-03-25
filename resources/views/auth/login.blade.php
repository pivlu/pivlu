{{-- Pivlu CE | Copyright (c) Iosif Gabriel Chimilevschi | AGPL-3.0 License | https://pivlu.com --}}
<!doctype html>
<html lang="{{ $lang ?? 'en' }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Login - {{ config('app.name') }}</title>

    @include('auth.includes.global-head')
</head>

<body class="bg-light">

    <div class="container mt-5">

        @if ($message = Session::get('error'))
            <div class="alert alert-danger">
                {{ $message }}
            </div>
        @endif

        <div class="row py-5 mt-5 align-items-center">

            @include('auth.includes.auth-header')

            <div class="col-md-6 offset-md-3 bg-white rounded">

                <div class="fs-5 mt-3 mb-3 fw-bold">Login to your account</div>

                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="row">

                        <!-- Email Address -->
                        <div class="input-group col-12 mb-4">
                            <div class="input-group mb-1">
                                <span class="input-group-text" id="addonEmail"><i class="bi bi-envelope"></i></span>
                                <input type="email" name="email" class="form-control form-control-lg @error('email') is-invalid @enderror" placeholder="Email address" aria-label="Email address" aria-describedby="addonEmail"
                                    required autocomplete="email" value="{{ old('email') }}">
                            </div>

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <!-- Password -->
                        <div class="input-group col-12 mb-4">
                            <div class="input-group mb-1">
                                <span class="input-group-text" id="addonPw"><i class="bi bi-lock"></i></span>
                                <input type="password" name="password" class="form-control form-control-lg @error('password') is-invalid @enderror" placeholder="Password" aria-label="Password" aria-describedby="addonPw"
                                    required>
                            </div>

                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="input-group col-12 mb-4">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }} checked>

                                <label class="form-check-label" for="remember">
                                    Remember me
                                </label>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="form-group col-lg-12 mx-auto">
                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-primary btn-block py-2">
                                    <span class="fw-bold">Login</span>
                                </button>
                            </div>
                        </div>

                        <!-- Divider Text -->
                        <div class="form-group col-lg-12 mx-auto d-flex align-items-center my-3">
                            <div class="border-bottom w-100"></div>
                            <span class="px-2 small" style="color: var(--pv-text-muted, #94a3b8);">or</span>
                            <div class="border-bottom w-100"></div>
                        </div>

                        <!-- Links -->
                        <div class="text-center w-100 mb-3 fw-bold">
                            @if (Route::has('password.request'))
                                <span><a href="{{ route('password.request') }}" class="text-secondary">Forgot password?</a></span>
                            @endif

                            @if (Route::has('register'))
                                | <span><a href="{{ route('register') }}" class="text-secondary">Create an account</a></span>
                            @endif
                        </div>

                    </div>

                </form>
            </div>

            @include('auth.includes.footer-text')

        </div>
    </div>

</body>

</html>
