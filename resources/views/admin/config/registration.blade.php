<div class="page-title">
    <div class="row">
        <div class="col-12">
            <nav aria-label="breadcrumb" class="breadcrumb-header">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin') }}">{{ __('Dashboard') }}</a></li>
                    <li class="breadcrumb-item" aria-current="page"><a href="{{ route('admin.config', ['tab' => 'website']) }}">{{ __('Configuration') }}</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ __('Registration') }}</li>
                </ol>
            </nav>
        </div>
    </div>
</div>



<div class="card">

    @include('pivlu::admin.config.includes.menu-config-website')

    <div class="card-body">

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if ($message = Session::get('success'))
            <div class="alert alert-success">
                @if ($message == 'updated')
                    {{ __('Updated') }}
                @endif
            </div>
        @endif

        @if ($config->registration_disabled ?? null)
            <div class="alert alert-danger">
                {{ __('Warning! Users registration is disabled') }}
            </div>
        @endif

        <form method="post">
            @csrf

            <div class="row">

                <div class="form-group">
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" id="SwitchRegDisabled" name="registration_disabled" @if ($config->registration_disabled ?? null) checked @endif>
                        <label class="form-check-label" for="SwitchRegDisabled">{{ __('Disable registration') }}</label>
                        <div class="form-text">{{ __('If you disable registration, visitors can not register accounts. Administrators can manually create accounts from accounts area.') }}</div>
                    </div>
                </div>

                <div class="form-group mt-3">
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" id="SwitchEmailVerify" name="registration_verify_email_disabled" @if ($config->registration_verify_email_disabled ?? null) checked @endif>
                        <label class="form-check-label" for="SwitchEmailVerify">{{ __('Disable email verification for registration') }}</label>
                        <div class="form-text"><span class="text-danger fw-bold">{{ __('This action is not recommended.') }}</span>.
                            {{ __('If you disable email verification, visitors can register and use their accounts without to verify their email address.') }}</div>
                    </div>
                </div>

            </div>

            <hr>

            <div class="form-group">
                <button type="submit" class="btn btn-primary">{{ __('Update') }}</button>
            </div>

        </form>

    </div>
    <!-- end card-body -->

</div>
