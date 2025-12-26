<div class="row">

    <div class="col-12 col-lg-6">

        <div class="card bg-light p-3 mb-3">

            <form method="post">
                @csrf
                @method('PUT')

                <h5 class="fw-bold">{{ __('Homepage') }}</h5>

                <div class="row">
                    <div class="col-12 col-xxl-4 col-xl-5 col-lg-6 col-md-6 mb-2">
                        <div class="form-group">
                            <label>{{ __('Homepage content source') }}</label>
                            <select class="form-select" name="homepage_source">
                                <option @if (Pivlu\Models\ThemeConfig::get_config($theme->id, 'homepage_source') == 'manual') selected @endif value="manual">{{ __('Manually build homepage (using blocks)') }}</option>
                                <optgroup label="{{ __('Redirect to post type') }}">
                                    @foreach ($homepage_content_sources_post_types as $homepage_content_sources_post_type)
                                        <option @if (Pivlu\Models\ThemeConfig::get_config($theme->id, 'homepage_source') == 'post_type_' . $homepage_content_sources_post_type->type) selected @endif value="post_type_{{ $homepage_content_sources_post_type->type }}">
                                            {{ $homepage_content_sources_post_type->default_language_content->name }}
                                        </option>
                                    @endforeach
                                </optgroup>
                                <optgroup label="{{ __('Redirect to plugin') }}">
                                    @foreach ($homepage_content_sources_plugins as $homepage_content_sources_plugin)
                                        <option @if (Pivlu\Models\ThemeConfig::get_config($theme->id, 'homepage_source') == 'module_' . $homepage_content_sources_plugin->slug) selected @endif value="module_{{ $homepage_content_sources_plugin->slug }}">{{ $homepage_content_sources_plugin->name }}</option>
                                    @endforeach
                                </optgroup>
                            </select>
                        </div>
                    </div>
                </div>

                @foreach (admin_languages() as $lang)
                    <div class="form-group">
                        <label>
                            @if (count(admin_languages()) > 1)
                                {!! flag($lang->code) !!}
                                @endif{{ __('Homepage meta title') }} @if (count(admin_languages()) > 1)
                                    ({{ $lang->name }})
                                @endif
                        </label>
                        <input type="text" class="form-control" name="homepage_meta_title_{{ $lang->id }}" value="{{ Pivlu\Models\ThemeConfigLang::get_config($theme->id, $lang->id, 'homepage_meta_title') }}">
                    </div>

                    <div class="form-group">
                        <label>
                            @if (count(admin_languages()) > 1)
                                {!! flag($lang->code) !!}
                                @endif{{ __('Homepage meta description') }} @if (count(admin_languages()) > 1)
                                    ({{ $lang->name }})
                                @endif
                        </label>
                        <input type="text" class="form-control" name="homepage_meta_description_{{ $lang->id }}"
                            value="{{ Pivlu\Models\ThemeConfigLang::get_config($theme->id, $lang->id, 'homepage_meta_description') }}">
                    </div>

                    @if (count(admin_languages()) > 1 && !$loop->last)
                        <hr>
                    @endif
                @endforeach

                <button type="submit" class="btn btn-primary mt-3">{{ __('Update') }}</button>
            </form>
        </div>

    </div>

    <div class="col-12 col-lg-6">

        <div class="card bg-light p-3 mb-3">

            <h5 class="fw-bold">{{ __('Logo and icon') }}</h5>

            <form method="post" action="{{ route('admin.theme.logo', ['id' => $theme->id]) }}" enctype="multipart/form-data">
                @csrf

                <div class="row">
                    <div class="col-md-6">
                        <label for="logo" class="form-label">{{ __('Main logo') }} ({{ __('required') }})</label>
                        <input class="form-control" aria-describedby="logoHelp" id="logo" type="file" name="logo">
                        <div class="text-muted small">
                            {{ __('This logo is displayed on navigation. Recomended file type: PNG transparent image. Note: Original image will be uploaded, without any crop or resize.') }}
                        </div>

                        @if ($theme_config->logo_media_id ?? null)
                            <br><img class="img-fluid" src="{{ image($theme_config->logo_media_id) }}" />
                        @endif
                    </div>

                    <div class="col-md-6">
                        <label for="favicon" class="form-label">{{ __('Favicon') }} ({{ __('required') }})</label>
                        <input type="file" class="form-control" id="favicon" name="favicon" aria-describedby="faviconHelp">
                        <div class="text-muted small">
                            {{ __('PNG, JPG, JPEG or GIF. Recomended file type: 32px x 32px. Note: Original image will be uploaded, without any crop or resize.') }}
                        </div>

                        @if ($theme_config->favicon_media_id ?? null)
                            <br><img class="img-fluid" src="{{ image($theme_config->favicon_media_id) }}" />
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
