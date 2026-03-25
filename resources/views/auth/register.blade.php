{{-- Pivlu CE | Copyright (c) Iosif Gabriel Chimilevschi | AGPL-3.0 License | https://pivlu.com --}}
<!doctype html>
<html lang="{{ $lang ?? 'en' }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Create Account - {{ config('app.name') }}</title>

    @include('auth.includes.global-head')
</head>

<body class="bg-light">

    <div class="container">

        <div class="row py-4 mt-2 align-items-center">

            @include('auth.includes.auth-header')

            <div class="col-md-6 offset-md-3 bg-white rounded">

                @if ($errors->any())
                    <div class="alert alert-danger mt-2">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="fs-5 fw-bold mt-3 mb-3">Create your account</div>

                <form method="POST" action="{{ route('register') }}" autocomplete="off" id="registerForm">
                    @csrf

                    <div class="row">

                        <!-- Name -->
                        <div class="col-12 mb-3">
                            <div class="input-group mb-1">
                                <span class="input-group-text" id="addonName"><i class="bi bi-person"></i></span>
                                <input type="text" name="name" class="form-control form-control-lg @error('name') is-invalid @enderror" placeholder="Full name" aria-label="Name" aria-describedby="addonName"
                                    required autocomplete="off" value="{{ old('name') }}">
                            </div>
                        </div>

                        <!-- Email -->
                        <div class="col-12 mb-3">
                            <div class="input-group mb-1">
                                <span class="input-group-text" id="addonEmail"><i class="bi bi-envelope"></i></span>
                                <input type="email" name="email" id="email" class="form-control form-control-lg @error('email') is-invalid @enderror" placeholder="Email address" aria-label="Email address"
                                    aria-describedby="addonEmail" required autocomplete="off" value="{{ old('email') }}">
                            </div>
                            <div class="form-text small" style="color: var(--pv-text-muted, #94a3b8);">This will be your login email.</div>
                        </div>

                        <!-- Password -->
                        <div class="col-md-6 col-12 mb-3">
                            <div class="input-group mb-1">
                                <span class="input-group-text" id="addonPw"><i class="bi bi-lock"></i></span>
                                <input type="password" name="password" class="form-control form-control-lg @error('password') is-invalid @enderror" placeholder="Password" aria-label="Password" aria-describedby="addonPw"
                                    required minlength="8" autocomplete="new-password" id="pwInput" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"
                                    title="Must contain at least 8 characters, including uppercase, lowercase, and a number.">
                            </div>
                            <div class="form-text small" style="color: var(--pv-text-muted, #94a3b8);">Min. 8 characters, mixed case + number.</div>
                        </div>

                        <!-- Confirm Password -->
                        <div class="col-md-6 col-12 mb-3">
                            <div class="input-group mb-1">
                                <span class="input-group-text" id="addonPw2"><i class="bi bi-lock"></i></span>
                                <input type="password" name="password_confirmation" id="pw2Input" class="form-control form-control-lg" placeholder="Confirm password"
                                    aria-label="Confirm password" aria-describedby="addonPw2" required minlength="8" autocomplete="new-password">
                            </div>
                            <div class="form-text small" style="color: var(--pv-text-muted, #94a3b8);">Confirm password</div>
                        </div>

                        <div class="col-12">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input mt-1" id="showPw">
                                <label for="showPw" class="fw-normal">Show password</label>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="form-group col-lg-12 mx-auto mb-0 mt-4">
                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-primary btn-block py-2" id="registerBtn">
                                    <span class="fw-bold">Create Account</span>
                                </button>
                            </div>
                        </div>

                        <div class="w-100">
                            <!-- Divider -->
                            <div class="form-group col-lg-12 mx-auto d-flex align-items-center my-3">
                                <div class="border-bottom w-100"></div>
                                <span class="px-2 small" style="color: var(--pv-text-muted, #94a3b8);">or</span>
                                <div class="border-bottom w-100"></div>
                            </div>

                            <!-- Already Registered -->
                            <div class="text-center w-100 fw-bold" style="color: var(--pv-text-muted, #94a3b8);">
                                <p>Already have an account? <a href="{{ route('login') }}" class="text-secondary">Login</a></p>
                            </div>
                        </div>
                    </div>
                </form>

            </div>

            @include('auth.includes.footer-text')

        </div>

    </div>

    <script>
        document.getElementById('showPw').addEventListener('change', function () {
            var pw = document.getElementById('pwInput');
            var pw2 = document.getElementById('pw2Input');
            var type = this.checked ? 'text' : 'password';
            pw.type = type;
            pw2.type = type;
        });

        document.getElementById('registerForm').addEventListener('submit', function () {
            var btn = document.getElementById('registerBtn');
            if (btn.disabled) return false;
            btn.disabled = true;
            btn.innerHTML = '<span class="spinner-border spinner-border-sm me-1"></span> Creating account...';
        });
    </script>

</body>

</html>
