<form method="post">
    @csrf
    @method('PUT')

    <div class="row">

        <div class="col-lg-6">

            <div class="card bg-light p-3 mb-3">


                <h5 class="fw-bold">{{ __('Main navbar settings') }}</h5>
                <small class="mb-3">{{ __('This navbar contain navigation links') }}</small>


                <div class="row">
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <label>{{ __('Select links menu') }} <br>
                                <a target="_blank" href="{{ route('admin.theme-menus.index') }}"><i class="bi bi-menu-up"></i> {{ __('Manage links menus') }}</a>
                                <a class="ms-2" onclick="location.reload();" href="#"><i class="bi bi-arrow-clockwise"></i> {{ __('Refresh page') }}</a>
                            </label>
                            <select class="form-select" id="menu_id" name="menu_id">
                                <option value="">-- {{ __('select') }} --</option>
                                @foreach ($menus as $menu)
                                    <option @if (($theme_config->menu_id ?? null) == $menu->id) selected @endif value="{{ $menu->id }}">{{ $menu->label }} @if ($menu->is_default == 1)
                                            ({{ __('default menu') }})
                                        @endif
                                    </option>
                                @endforeach
                            </select>
                            @if (count($menus) == 0)
                                <div class="small text-info mt-1">{{ __("You don't have menus created") }}</div>
                            @endif
                        </div>

                    </div>
                </div>

                <div class="form-group">
                    <div class="form-check form-switch">
                        <input type='hidden' value='' name='navbar_shaddow'>
                        <input class="form-check-input" type="checkbox" id="navbar_shaddow" name="navbar_shaddow" @if ($theme_config->navbar_shaddow ?? null) checked @endif>
                        <label class="form-check-label" for="navbar_shaddow">{{ __('Add shaddow under main navigation') }}</label>
                    </div>
                </div>

                <div class="form-group">
                    <div class="form-check form-switch">
                        <input type='hidden' value='' name='navbar_hide_logo'>
                        <input class="form-check-input" type="checkbox" id="navbar_hide_logo" name="navbar_hide_logo" @if ($theme_config->navbar_hide_logo ?? null) checked @endif>
                        <label class="form-check-label" for="navbar_hide_logo">{{ __('Hide logo') }}</label>
                    </div>
                </div>

                <div class="form-group">
                    <div class="form-check form-switch">
                        <input type='hidden' value='' name='navbar_sticky'>
                        <input class="form-check-input" type="checkbox" id="navbar_sticky" name="navbar_sticky" @if ($theme_config->navbar_sticky ?? null) checked @endif>
                        <label class="form-check-label" for="navbar_sticky">{{ __('Sticky navigation') }}</label>
                    </div>
                </div>

                <div class="form-group">
                    <div class="form-check form-switch">
                        <input type='hidden' value='' name='navbar_hide_auth'>
                        <input class="form-check-input" type="checkbox" id="navbar_hide_auth" name="navbar_hide_auth" @if ($theme_config->navbar_hide_auth ?? null) checked @endif>
                        <label class="form-check-label" for="navbar_hide_auth">{{ __('Hide authentification (login page)') }}</label>
                    </div>
                </div>

                @if (count(admin_languages()) > 1)
                    <div class="form-group mb-3">
                        <div class="form-check form-switch">
                            <input type='hidden' value='' name='navbar_hide_langs'>
                            <input class="form-check-input" type="checkbox" id="navbar_hide_langs" name="navbar_hide_langs" @if ($theme_config->navbar_hide_langs ?? null) checked @endif>
                            <label class="form-check-label" for="navbar_hide_langs">{{ __('Hide language selector') }}</label>
                        </div>
                    </div>
                @endif

                <div class="row">
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary mt-0">{{ __('Update settings') }}</button>
                    </div>
                </div>

            </div>
        </div>


        <div class="col-lg-6">

            <div class="card bg-light p-3 mb-3">

                <h5 class="fw-bold">{{ __('Select navigation template') }}</h5>


                <form method="post">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        @foreach ($nav_templates as $nav_template)
                            <div class="col-sm-6 col-md-6 col-lg-4">
                                <div class="card">
                                    <div class="card-body text-center">
                                        <div class="fw-bold mb-1">{{ $nav_template['name'] }}</div>

                                        <div class="mb-2">{{ $nav_template['description'] }}</div>

                                        <input type="radio" class="btn-check" name="theme_nav" value="{{ $nav_template['slug'] }}" id="{{ $nav_template['slug'] }}" autocomplete="off"
                                            @if (($theme_config->theme_nav ?? 'default') == $nav_template['slug']) checked @endif>
                                        <label class="btn btn-outline-secondary" for="{{ $nav_template['slug'] }}">
                                            @if (($theme_config->theme_nav ?? 'default') == $nav_template['slug'])
                                                {{ __('Active navigation') }}
                                            @else
                                                {{ __('Select') }}
                                            @endif
                                        </label>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </form>

                <h5 class="fw-bold">{{ __('Navigation template settings') }}</h5>

                @if (!($theme_config->theme_nav ?? null))
                    @include('pivlu::template-parts.navigations.default.settings')
                @else
                    @include("pivlu::template-parts.navigations.$theme_config->theme_nav.settings")
                @endif

                <hr>

                <div class="row">
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary mt-3">{{ __('Update settings') }}</button>
                    </div>
                </div>


            </div>

        </div>

    </div>
</form>

<script>
    $('input[type=radio]').on('change', function() {
        $(this).closest("form").submit();
    });
</script>
