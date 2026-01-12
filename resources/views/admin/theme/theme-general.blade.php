<div class="row">

    

    <div class="col-12 col-lg-6">

        <div class="card bg-light p-3 mb-3">

            <h5 class="fw-bold">{{ __('Logo and icon') }}</h5>

            <form method="post" action="{{ route('admin.theme.logo', ['id' => $theme->id]) }}" enctype="multipart/form-data">
                @csrf

                <div class="row">
                    <div class="col-md-6">
                        <label for="logo" class="form-label">{{ __('Main logo') }} ({{ __('required') }})</label>
                        <input class="form-control" aria-describedby="logoHelp" id="logo" type="file" name="logo">
                        <div class="text-muted small mb-3">
                            {{ __('This logo is displayed on navigation. Recomended file type: PNG transparent image. Note: Original image will be uploaded, without any crop or resize.') }}
                        </div>                      
                        @if ($logo_model ?? null)
                            <img class="img-fluid" style="max-height: 200px; max-width: 200px;" src="{{ $logo_model->getFirstMediaUrl('theme_config_media') }}" />
                        @else
                            <div class="text-danger small">{{ __('No logo uploaded yet.') }}</div>
                        @endif
                    </div>

                    <div class="col-md-6">
                        <label for="favicon" class="form-label">{{ __('Favicon') }} ({{ __('required') }})</label>
                        <input type="file" class="form-control" id="favicon" name="favicon" aria-describedby="faviconHelp">
                        <div class="text-muted small mb-3">
                            {{ __('PNG, JPG, JPEG or GIF. Recomended file type: 32px x 32px. Note: Original image will be uploaded, without any crop or resize.') }}
                        </div>                     
                        @if ($favicon_model ?? null)
                        <img class="img-fluid" style="max-height: 200px; max-width: 200px;" src="{{ $favicon_model->getFirstMediaUrl('theme_config_media') }}" />
                        @else
                            <div class="text-danger small">{{ __('No favicon uploaded yet.') }}</div>
                        @endif
                    </div>
                </div>

                <div class="col-12 mt-4">
                    <button type="submit" class="btn btn-primary">{{ __('Update') }}</button>
                </div>

            </form>
        </div>
    </div>
</div>
