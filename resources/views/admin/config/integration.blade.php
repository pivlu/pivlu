<div class="page-title">
    <div class="row">
        <div class="col-12">
            <nav aria-label="breadcrumb" class="breadcrumb-header">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin') }}">{{ __('Dashboard') }}</a></li>
                    <li class="breadcrumb-item" aria-current="page"><a href="{{ route('admin.config', ['tab' => 'website']) }}">{{ __('Configuration') }}</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ __('Integration') }}</li>
                </ol>
            </nav>
        </div>
    </div>
</div>

<div class="card">

    <div class="card-header">

        @include('admin.config.includes.menu-config-website')

    </div>


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

        <form method="post">
            @csrf

            <h5 class="mt-2">{{ __('Google reCAPTCHA') }}</h5>
            <p>{{ __('Create site / secret keys here') }}: <a target="_blank" href="https://www.google.com/recaptcha/admin/create"><b>{{ __('Create Google reCAPTCHA keys') }}</b></a></p>

            <div class="row">

                <div class="form-group">
                    @if (!($config->google_recaptcha_enabled ?? null))
                        <div class="alert alert-light text-danger"><i class="bi bi-info-circle"></i> {{ __('Google reCAPTCHA is disabled') }}</div>
                    @endif

                    <div class="form-check form-switch">
                        <input type="hidden" name="google_recaptcha_enabled" value="">
                        <input class="form-check-input" type="checkbox" id="SwitchRecaptcha" name="google_recaptcha_enabled" @if ($config->google_recaptcha_enabled ?? null) checked @endif>
                        <label class="form-check-label" for="SwitchRecaptcha">{{ __('Enable Google reCAPTCHA') }}</label>
                    </div>
                </div>

                <div class="col-12 col-md-4">
                    <div class="form-group">
                        <label>{{ __('Google reCAPTCHA site key') }}:</label>
                        <input class="form-control" name="google_recaptcha_site_key" value="{!! $config->google_recaptcha_site_key ?? null !!}" />
                    </div>
                </div>

                <div class="col-12 col-md-4">
                    <div class="form-group">
                        <label>{{ __('Google reCAPTCHA secrtet key') }}:</label>
                        <input type="password" class="form-control" name="google_recaptcha_secret_key" value="{!! $config->google_recaptcha_secret_key ?? null !!}" />
                    </div>
                </div>
            </div>

            <hr>

            <h5>{{ __('Google Analytics') }}</h5>
            <p class="form-text">{{ __('Get this code from') }} <a target="_blank" href="https://google.com/analytics"><b>{{ __('Google Analytics account') }}</b></a></p>

            <div class="form-group">
                @if (!($config->google_analytics_enabled ?? null))
                    <div class="alert alert-light text-danger"><i class="bi bi-info-circle"></i> {{ __('Google analytics is disabled') }}</div>
                @endif

                <div class="form-check form-switch">
                    <input type="hidden" name="google_analytics_enabled" value="">
                    <input class="form-check-input" type="checkbox" id="SwitchAnalytics" name="google_analytics_enabled" @if ($config->google_analytics_enabled ?? null) checked @endif>
                    <label class="form-check-label" for="SwitchAnalytics">{{ __('Enable Google analytics') }}</label>
                </div>
            </div>

            <div class="form-group col-md-4 col-12">
                <label>{{ __('Google Analytics ID') }} (UA-XXXXX-Y or G-XXXXXX):</label>
                <input type="text" class="form-control" name="google_analytics_id" aria-describedby="analyticsHelp" value="{{ $config->google_analytics_id ?? null }}">
            </div>

            <hr>


            <h5>{{ __('Google Maps API') }}</h5>
            <p class="form-text">{{ __('Get Google Maps API key') }}: <a target="_blank" href="https://developers.google.com/maps/get-started#api-key"><b>{{ __('Google Maps API') }}</b></a></p>

            <div class="form-group">
                @if (!($config->google_maps_api ?? null))
                    <div class="alert alert-light text-danger"><i class="bi bi-info-circle"></i> {{ __('Google Maps API is disabled') }}</div>
                @endif

                <div class="form-check form-switch">
                    <input type="hidden" name="google_maps_api" value="">
                    <input class="form-check-input" type="checkbox" id="SwitchMapsAPI" name="google_maps_api" @if ($config->google_maps_api ?? null) checked @endif>
                    <label class="form-check-label" for="SwitchMapsAPI">{{ __('Enable Google Maps API') }}</label>
                </div>
            </div>

            <div class="form-group col-md-4 col-12">
                <label>{{ __('Google Maps API key') }}</label>
                <input type="text" class="form-control" name="google_maps_api_key" aria-describedby="mapsHelp" value="{{ $config->google_maps_api_key ?? null }}">
            </div>

            <hr>

            <div class="form-group">
                <button type="submit" class="btn btn-primary">{{ __('Update') }}</button>
            </div>

        </form>

    </div>
    <!-- end card-body -->

</div>
