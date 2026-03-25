{{-- Pivlu CE | Copyright (c) Iosif Gabriel Chimilevschi | AGPL-3.0 License | https://pivlu.com --}}
<!doctype html>
<html lang="{{ $lang ?? 'en' }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Verify Email - {{ config('app.name') }}</title>

    @include('auth.includes.global-head')
</head>

<body class="bg-light">

    <div class="container mt-5">

        <div class="row py-5 mt-5 align-items-center">

            @include('auth.includes.auth-header')

            <div class="col-md-6 offset-md-3 bg-white rounded">

                @if ($errors->any())
                    <div class="alert alert-danger mt-3 mb-3">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="fs-5 mt-3 mb-3 fw-bold">Verify Your Email</div>

                @if (session('status') == 'verification-link-sent')
                    <div class="alert alert-success mb-3" role="alert">
                        A new verification link has been sent to your email address.
                    </div>
                @endif

                <div class="mb-3">
                    Thanks for signing up! Before getting started, please verify your email address by clicking the link we just sent to you.
                    If you didn't receive the email,
                    <form class="d-inline" method="POST" action="{{ url('/email/verification-notification') }}">
                        @csrf
                        <button type="submit" class="btn btn-link p-0 m-0 align-baseline">click here to request another</button>.
                    </form>
                </div>

            </div>

            @include('auth.includes.footer-text')

        </div>
    </div>

</body>

</html>
