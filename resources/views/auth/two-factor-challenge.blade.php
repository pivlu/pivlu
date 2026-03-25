{{-- Pivlu CE | Copyright (c) Iosif Gabriel Chimilevschi | AGPL-3.0 License | https://pivlu.com --}}
<!doctype html>
<html lang="{{ $lang ?? 'en' }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Two-Factor Authentication - {{ config('app.name') }}</title>

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

                <div id="codeForm">
                    <div class="fs-5 mb-3 mt-3 fw-bold">Two-Factor Authentication</div>

                    <p class="small mb-3" style="color: var(--pv-text-muted, #94a3b8);">Please enter the authentication code from your authenticator app.</p>

                    <form method="POST" action="{{ url('/two-factor-challenge') }}">
                        @csrf

                        <div class="input-group mb-3">
                            <span class="input-group-text"><i class="bi bi-shield-lock"></i></span>
                            <input type="text" name="code" class="form-control form-control-lg" placeholder="Authentication code" autofocus autocomplete="one-time-code" inputmode="numeric">
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary btn-block py-2">
                                Verify
                            </button>
                        </div>
                    </form>

                    <div class="text-center mt-3 mb-3">
                        <button type="button" class="btn btn-link btn-sm" style="color: var(--pv-text-muted, #94a3b8);" id="useRecoveryCode">
                            Use a recovery code instead
                        </button>
                    </div>
                </div>

                <div id="recoveryForm" class="d-none">
                    <div class="fs-5 mb-3 mt-3 fw-bold">Recovery Code</div>

                    <p class="small mb-3" style="color: var(--pv-text-muted, #94a3b8);">Please enter one of your emergency recovery codes.</p>

                    <form method="POST" action="{{ url('/two-factor-challenge') }}">
                        @csrf

                        <div class="input-group mb-3">
                            <span class="input-group-text"><i class="bi bi-key"></i></span>
                            <input type="text" name="recovery_code" class="form-control form-control-lg" placeholder="Recovery code" autocomplete="one-time-code">
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary btn-block py-2">
                                Verify
                            </button>
                        </div>
                    </form>

                    <div class="text-center mt-3 mb-3">
                        <button type="button" class="btn btn-link btn-sm" style="color: var(--pv-text-muted, #94a3b8);" id="useAuthCode">
                            Use authentication code instead
                        </button>
                    </div>
                </div>

            </div>

            @include('auth.includes.footer-text')

        </div>
    </div>

    <script>
        document.getElementById('useRecoveryCode').addEventListener('click', function() {
            document.getElementById('codeForm').classList.add('d-none');
            document.getElementById('recoveryForm').classList.remove('d-none');
        });
        document.getElementById('useAuthCode').addEventListener('click', function() {
            document.getElementById('recoveryForm').classList.add('d-none');
            document.getElementById('codeForm').classList.remove('d-none');
        });
    </script>

</body>

</html>
