<form method="post">
    @csrf
    @method('PUT')

    <div class="row">

        <div class="col-12">

            <div class="card bg-light p-3 mb-3">

                <h5 class="fw-bold">{{ __('Main navbar settings') }}</h5>
                <small class="mb-3">{{ __('This navbar contain navigation links') }}</small>

                <div class="row">

                    <div class="col-12 col-xl-2 col-lg-6 col-md-12">
                        <div class="form-group">
                            <label>{{ __('Select style') }} [<a href="{{ route('admin.theme-styles.index') }}">{{ __('Manage styles') }}</a>]</label>
                            <select name="navbar_style_id" class="form-select">
                                @foreach ($styles as $style)
                                    <option value="{{ $style->id }}">{{ $style->label }}</option>
                                @endforeach
                            </select>
                            <div class="text-muted small">{{ __('Style for links, colors, background...') }}</div>
                        </div>
                    </div>

                    <div class="col-12 col-xl-3 col-lg-6 col-md-12">
                        <div class="form-group">
                            <label>{{ __('Navigation layout') }}</label>
                            <select class="form-select" name="navbar_layout" id="navbar_layout" onchange="showLayoutDiv()">
                                <option @if (($theme_config->navbar_layout ?? null) == 'default') selected @endif value="default">{{ __('Default (one row)') }}</option>
                                <option @if (($theme_config->navbar_layout ?? null) == '2rows_1') selected @endif value="2rows_1">{{ __('2 rows (row 1 for logo and row 2 for links)') }}</option>
                                <option @if (($theme_config->navbar_layout ?? null) == 'default_search') selected @endif value="default_search">{{ __('Default (one row) with search form') }}</option>
                                <option @if (($theme_config->navbar_layout ?? null) == '2rows_1_search_top') selected @endif value="2rows_1_search_top">{{ __('2 rows with search form on first row') }}</option>
                                <option @if (($theme_config->navbar_layout ?? null) == '2rows_1_search_bottom') selected @endif value="2rows_1_search_bottom">{{ __('2 rows with search form on second row') }}</option>
                            </select>
                        </div>
                    </div>

                    <script>
                        function showLayoutDiv() {
                            var select = document.getElementById('navbar_layout');
                            var value = select.options[select.selectedIndex].value;

                            if (value == '2rows_1' || value == '2rows_1_search_top') {
                                document.getElementById('hidden_div_layout').style.display = 'block';
                            } else {
                                document.getElementById('hidden_div_layout').style.display = 'none';
                            }
                        }
                    </script>

                    <div id="hidden_div_layout" style="display: @if (($theme_config->navbar_layout ?? null) == '2rows_1' || ($theme_config->navbar_layout ?? null) == '2rows_1_search_top')) block @else none @endif">
                        <div class="col-12 col-xl-2 col-lg-4 col-md-6">
                            <div class="form-group">
                                <label>{{ __('Links align') }}</label>
                                <select class="form-select" name="navbar_links_align">
                                    <option @if (($theme_config->navbar_links_align ?? null) == 'me-auto') selected @endif value="me-auto">{{ __('Left') }}</option>
                                    <option @if (($theme_config->navbar_links_align ?? null) == 'me-auto ms-auto') selected @endif value="me-auto ms-auto">{{ __('Center') }}</option>
                                    <option @if (($theme_config->navbar_links_align ?? null) == 'ms-auto') selected @endif value="ms-auto">{{ __('Right') }}</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                <hr>

                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <div class="form-check form-switch">
                                <input type='hidden' value='' name='navbar_shaddow'>
                                <input class="form-check-input" type="checkbox" id="navbar_shaddow" name="navbar_shaddow" @if ($theme_config->navbar_shaddow ?? null) checked @endif>
                                <label class="form-check-label" for="navbar_shaddow">{{ __('Add shaddow under main navigation') }}</label>
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="form-group">
                            <div class="form-check form-switch">
                                <input type='hidden' value='' name='navbar_hide_logo'>
                                <input class="form-check-input" type="checkbox" id="navbar_hide_logo" name="navbar_hide_logo" @if ($theme_config->navbar_hide_logo ?? null) checked @endif>
                                <label class="form-check-label" for="navbar_hide_logo">{{ __('Hide logo') }}</label>
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="form-group">
                            <div class="form-check form-switch">
                                <input type='hidden' value='' name='navbar_hide_auth'>
                                <input class="form-check-input" type="checkbox" id="navbar_hide_auth" name="navbar_hide_auth" @if ($theme_config->navbar_hide_auth ?? null) checked @endif>
                                <label class="form-check-label" for="navbar_hide_auth">{{ __('Hide authentification (login page)') }}</label>
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="form-group">
                            <div class="form-check form-switch">
                                <input type='hidden' value='' name='navbar_hide_langs'>
                                <input class="form-check-input" type="checkbox" id="navbar_hide_langs" name="navbar_hide_langs" @if ($theme_config->navbar_hide_langs ?? null) checked @endif>
                                <label class="form-check-label" for="navbar_hide_langs">{{ __('Hide language selector (if multiple languages are available)') }}</label>
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="form-group mb-0">
                            <div class="form-check form-switch">
                                <input type='hidden' value='' name='navbar_sticky'>
                                <input class="form-check-input" type="checkbox" id="navbar_sticky" name="navbar_sticky" @if ($theme_config->navbar_sticky ?? null) checked @endif>
                                <label class="form-check-label" for="navbar_sticky">{{ __('Sticky navigation') }}</label>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </div>



        <div class="col-12">
            <div class="card bg-light p-3 mb-3">
                <h5 class="fw-bold">{{ __('Dropdown settings') }}</h5>
                <div class="row">
                    <div class="col-12 col-xl-2 col-lg-6 col-md-12">
                        <div class="form-group">
                            <label>{{ __('Select style') }} [<a href="{{ route('admin.theme-styles.index') }}">{{ __('Manage styles') }}</a>]</label>
                            <select name="dropdown_style_id" class="form-select">
                                @foreach ($styles as $style)
                                    <option @if (($theme_config->dropdown_style_id ?? null) == $style->id) selected @endif value="{{ $style->id }}">{{ $style->label }}</option>
                                @endforeach
                            </select>
                            <div class="text-muted small">{{ __('Style for links, colors, background...') }}</div>
                        </div>
                    </div>
                </div>

                <hr>

                <div class="row">
                    <div class="col-12">
                        <div class="form-group mb-0">
                            <div class="form-check form-switch">
                                <input type='hidden' value='' name='dropdown_shaddow'>
                                <input class="form-check-input" type="checkbox" id="dropdown_shaddow" name="dropdown_shaddow" @if ($theme_config->dropdown_shaddow ?? null) checked @endif>
                                <label class="form-check-label" for="dropdown_shaddow">{{ __('Add shaddow to dropdown box') }}</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="col-12">
            <div class="card bg-light p-3 mb-3">
                <h5 class="fw-bold">{{ __('Notiffications top bar') }}</h5>
                <small class="mb-3">{{ __('Add a top bar with text content. HTML code is allowed.') }}</small>

                <div class="form-group mb-3">
                    <div class="form-check form-switch">
                        <input type='hidden' value='' name='navbar2_show'>
                        <input class="form-check-input" type="checkbox" id="navbar2_show" name="navbar2_show" @if ($theme_config->navbar2_show ?? null) checked @endif>
                        <label class="form-check-label" for="navbar2_show">{{ __('Show notiffication bar') }}</label>
                    </div>
                </div>

                <script>
                    $('#navbar2_show').change(function() {
                        select = $(this).prop('checked');
                        if (select)
                            document.getElementById('hidden_div_nav3').style.display = 'block';
                        else
                            document.getElementById('hidden_div_nav3').style.display = 'none';
                    })
                </script>

                <div id="hidden_div_nav3" style="display: @if ($theme_config->navbar2_show ?? null) block @else none @endif">

                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label>{{ __('Content') }}</label>
                                <textarea class="form-control" name="navbar2_content" rows="2">{{ $theme_config->navbar2_content ?? null }}</textarea>
                            </div>
                        </div>

                        <div class="col-12 col-xl-2 col-lg-4 col-md-6">
                            <div class="form-group">
                                <label>{{ __('Content align') }}</label>
                                <select class="form-select" name="navbar2_content_align">
                                    <option @if (($theme_config->navbar2_content_align ?? null) == 'text-start') selected @endif value="text-start">{{ __('Left') }}</option>
                                    <option @if (($theme_config->navbar2_content_align ?? null) == 'text-center') selected @endif value="text-center">{{ __('Center') }}</option>
                                    <option @if (($theme_config->navbar2_content_align ?? null) == 'text-end') selected @endif value="text-end">{{ __('Right') }}</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-12 col-xl-2 col-lg-4 col-md-6">
                            <label>{{ __('Select style') }} [<a href="{{ route('admin.theme-styles.index') }}">{{ __('Manage styles') }}</a>]</label>
                            <select name="navbar2_style_id" class="form-select">
                                @foreach ($styles as $style)
                                    <option @if (($theme_config->navbar2_style_id ?? null) == $style->id) selected @endif value="{{ $style->id }}">{{ $style->label }}</option>
                                @endforeach
                            </select>
                            <div class="text-muted small">{{ __('Style for links, colors, background...') }}</div>
                        </div>
                    </div>

                    <div class="form-group mb-0">
                        <div class="form-check form-switch">
                            <input type='hidden' value='' name='navbar2_sticky'>
                            <input class="form-check-input" type="checkbox" id="navbar2_sticky" name="navbar2_sticky" @if ($theme_config->navbar2_sticky ?? null) checked @endif>
                            <label class="form-check-label" for="navbar2_sticky">{{ __('Sticky bar') }}</label>
                        </div>
                        <div class="form-text">{{ __('Note: notification bar can be sticky only if main navbar navigation is not sticky') }}</div>
                    </div>

                </div>

            </div>

        </div>

    </div>

    <input type="hidden" name="theme_tab" value="{{ $theme_tab ?? null }}">
    <button type="submit" class="btn btn-primary mt-3">{{ __('Update') }}</button>

</form>
