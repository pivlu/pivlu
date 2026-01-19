<form method="post">
    @csrf
    @method('PUT')

    <div class="row">
        <div class="col-12 col-lg-4 col-md-6">
            <div class="form-group">
                <label>{{ __('Select footer') }} <br>
                    <a target="_blank" href="{{ route('admin.theme-footers.index') }}"><i class="bi bi-menu-up"></i> {{ __('Manage footers') }}</a>
                    <a class="ms-2" onclick="location.reload();" href="#"><i class="bi bi-arrow-clockwise"></i> {{ __('Refresh page') }}</a>
                </label>
                <select class="form-select" id="footer_id" name="footer_id">
                    <option value="">-- {{ __('select') }} --</option>
                    @foreach ($footers as $footer)
                        <option @if (($theme_config->footer_id ?? null) == $footer->id) selected @endif value="{{ $footer->id }}">{{ $footer->label }} @if ($footer->is_default == 1)
                                ({{ __('default footer') }})
                            @endif
                        </option>
                    @endforeach
                </select>
                @if (count($footers) == 0)
                    <div class="small text-info mt-1">{{ __("You don't have footers created") }}</div>
                @endif
            </div>

        </div>
    </div>

    <hr>

    <div class="row">
        <div class="col-md-6">

            <h5>{{ __('Primary footer settings') }}</h5>
            <div class="text-muted small mb-3">{{ __('Settings for the primary footer area.') }}</div>           

            <div class="form-group">
                <div class="form-check form-switch">
                    <input type='hidden' value='' name='footer_use_custom_style'>
                    <input class="form-check-input" type="checkbox" id="footer_use_custom_style" name="footer_use_custom_style" @if ($theme_config->footer_use_custom_style ?? null) checked @endif>
                    <label class="form-check-label" for="footer_use_custom_style">{{ __('Use custom style for primary footer') }}</label>
                </div>
                <div class="text-muted small">{{ __('Manage sizes and color for text, links and background.') }}</div>
            </div>

            <script>
                $('#footer_use_custom_style').change(function() {
                    select = $(this).prop('checked');
                    if (select)
                        document.getElementById('hidden_div_style_footer1').style.display = 'block';
                    else
                        document.getElementById('hidden_div_style_footer1').style.display = 'none';
                })
            </script>

            <div id="hidden_div_style_footer1" style="display: @if (isset($theme_config->footer_use_custom_style)) block @else none @endif" class="mt-2">
                <div class="form-group col-md-6 mb-3">
                    <label>{{ __('Select style form primary footer') }} <br>
                        <a target="_blank" href="{{ route('admin.theme-styles.index') }}"><i class="bi bi-palette"></i> {{ __('Manage styles') }}</a>
                        <a class="ms-2" onclick="location.reload();" href="#"><i class="bi bi-arrow-clockwise"></i> {{ __('Refresh page') }}</a>
                    </label>
                    <select class="form-select" id="footer_style_id" name="footer_style_id">
                        <option value="">-- {{ __('select') }} --</option>
                        @foreach ($styles as $style)
                            <option @if (($theme_config->footer_style_id ?? null) == $style->id) selected @endif value="{{ $style->id }}">{{ $style->label }}</option>
                        @endforeach
                    </select>
                    @if (count($styles) == 0)
                        <div class="small text-info mt-1">{{ __("You don't have custom styles created") }}</div>
                    @endif
                </div>
            </div>

        </div>

        <div class="col-md-6">
            <h5>{{ __('Secondary footer settings') }}</h5>
            <div class="text-muted small mb-3">{{ __('Settings for the secondary footer area, displayed under the primary footer (if enabled).') }}</div>

            <div class="form-group">
                <div class="form-check form-switch">
                    <input type='hidden' value='' name='footer2_use_custom_style'>
                    <input class="form-check-input" type="checkbox" id="footer2_use_custom_style" name="footer2_use_custom_style" @if ($theme_config->footer2_use_custom_style ?? null) checked @endif>
                    <label class="form-check-label" for="footer2_use_custom_style">{{ __('Use custom style for secondary footer (if enabled)') }}</label>
                </div>
                <div class="text-muted small">{{ __('Manage sizes and color for text, links and background.') }}</div>
            </div>

            <script>
                $('#footer2_use_custom_style').change(function() {
                    select = $(this).prop('checked');
                    if (select)
                        document.getElementById('hidden_div_style_footer2').style.display = 'block';
                    else
                        document.getElementById('hidden_div_style_footer2').style.display = 'none';
                })
            </script>

            <div id="hidden_div_style_footer2" style="display: @if (isset($theme_config->footer2_use_custom_style)) block @else none @endif" class="mt-2">
                <div class="form-group col-md-6 mb-3">
                    <label>{{ __('Select style form secondary footer') }} <br>
                        <a target="_blank" href="{{ route('admin.theme-styles.index') }}"><i class="bi bi-palette"></i> {{ __('Manage styles') }}</a>
                        <a class="ms-2" onclick="location.reload();" href="#"><i class="bi bi-arrow-clockwise"></i> {{ __('Refresh page') }}</a>
                    </label>
                    <select class="form-select" id="footer2_style_id" name="footer2_style_id">
                        <option value="">-- {{ __('select') }} --</option>
                        @foreach ($styles as $style)
                            <option @if (($theme_config->footer2_style_id ?? null) == $style->id) selected @endif value="{{ $style->id }}">{{ $style->label }}</option>
                        @endforeach
                    </select>
                    @if (count($styles) == 0)
                        <div class="small text-info mt-1">{{ __("You don't have custom styles created") }}</div>
                    @endif
                </div>
            </div>

        </div>
    </div>

    <hr>

    <input type="hidden" name="theme_id" value="{{ $theme->id }}">
    <button type="submit" name="submit_action" value="update" class="btn btn-primary">{{ __('Update settings') }}</button>
</form>
