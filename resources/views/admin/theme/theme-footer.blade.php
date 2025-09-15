<form action="{{ route('admin.theme-footer.update', ['slug' => $theme->slug]) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="row">

        <div class="col-12 col-md-6">

            <div class="card bg-light p-3 mb-3">

                <h5 class="fw-bold">{{ __('Main footer') }}</h5>


                <div class="row">
                    <div class="col-12 col-xl-5 col-md-6">
                        <div class="form-group">
                            <label>{{ __('Choose footer layout') }}</label><br>
                            <select class="form-select" name="tpl_footer_columns">
                                <option @if (($theme_config->tpl_footer_columns ?? null) == '1') selected @endif value="1">{{ __('One column') }}</option>
                                <option @if (($theme_config->tpl_footer_columns ?? null) == '2') selected @endif value="2">{{ __('Two columns') }}</option>
                                <option @if (($theme_config->tpl_footer_columns ?? null) == '3') selected @endif value="3">{{ __('Three columns') }}</option>
                                <option @if (($theme_config->tpl_footer_columns ?? null) == '4') selected @endif value="4">{{ __('Four columns') }}</option>
                            </select>
                            <div class="text-muted small">{{ __('Select number of columns for primary footer') }}</div>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="form-check form-switch">
                        <input type='hidden' value='' name='tpl_footer_use_custom_style'>
                        <input class="form-check-input" type="checkbox" id="tpl_footer_use_custom_style" name="tpl_footer_use_custom_style" @if ($theme_config->tpl_footer_use_custom_style ?? null) checked @endif>
                        <label class="form-check-label" for="tpl_footer_use_custom_style">{{ __('Use custom style for this section') }}</label>
                    </div>
                    <div class="text-muted small">{{ __('Manage background color, text size, links, text colour...') }}</div>
                </div>

                <script>
                    $('#tpl_footer_use_custom_style').change(function() {
                        select = $(this).prop('checked');
                        if (select)
                            document.getElementById('hidden_div_style_footer1').style.display = 'block';
                        else
                            document.getElementById('hidden_div_style_footer1').style.display = 'none';
                    })
                </script>

                <div id="hidden_div_style_footer1" style="display: @if (isset($theme_config->tpl_footer_use_custom_style)) block @else none @endif" class="mt-2">
                    <div class="form-group col-lg-6 col-md-12 mb-0">
                        <label>{{ __('Select custom style') }} <br>
                            <a target="_blank" href="{{ route('admin.theme-styles.index') }}"><i class="bi bi-palette"></i> {{ __('Add new style') }}</a>
                            <a class="ms-2" onclick="location.reload();" href="#"><i class="bi bi-arrow-clockwise"></i> {{ __('Refresh page') }}</a>
                        </label>
                        <select class="form-select" id="tpl_footer_style_id" name="tpl_footer_style_id">
                            <option value="">-- {{ __('select') }} --</option>
                            @foreach ($styles as $style)
                                <option @if (($theme_config->tpl_footer_style_id ?? null) == $style->id) selected @endif value="{{ $style->id }}">{{ $style->label }}</option>
                            @endforeach
                        </select>
                        @if (count($styles) == 0)
                            <div class="small text-info mt-1">{{ __("You don't have custom styles created") }}</div>
                        @endif
                    </div>
                </div>

            </div>
        </div>


        <div class="col-12 col-md-6">

            <div class="card bg-light p-3 pb-0 mb-3">

                <h5 class="fw-bold">{{ __('Secondary footer') }}</h5>
                <div class="text-muted small">{{ __('This footer is below main footer') }}</div>

                <div class="form-group mb-3 mt-3">
                    <div class="form-check form-switch">
                        <input type='hidden' value='' name='tpl_footer2_show'>
                        <input class="form-check-input" type="checkbox" id="tpl_footer2_show" name="tpl_footer2_show" @if ($theme_config->tpl_footer2_show ?? null) checked @endif>
                        <label class="form-check-label" for="tpl_footer2_show">{{ __('Show secondary footer') }}</label>
                    </div>
                </div>

                <script>
                    $('#tpl_footer2_show').change(function() {
                        select = $(this).prop('checked');
                        if (select)
                            document.getElementById('hidden_div_footer2').style.display = 'block';
                        else
                            document.getElementById('hidden_div_footer2').style.display = 'none';
                    })
                </script>

                <div id="hidden_div_footer2" style="display: @if ($theme_config->tpl_footer2_show ?? null) block @else none @endif">
                    <div class="row">
                        <div class="col-12 col-xl-5 col-md-6">
                            <div class="form-group">
                                <label>{{ __('Secondary footer layout') }}</label><br>
                                <select class="form-select" name="tpl_footer2_columns">
                                    <option @if (($theme_config->tpl_footer2_columns ?? null) == '1') selected @endif value="1">{{ __('One column') }}</option>
                                    <option @if (($theme_config->tpl_footer2_columns ?? null) == '2') selected @endif value="2">{{ __('Two columns') }}</option>
                                    <option @if (($theme_config->tpl_footer2_columns ?? null) == '3') selected @endif value="3">{{ __('Three columns') }}</option>
                                    <option @if (($theme_config->tpl_footer2_columns ?? null) == '4') selected @endif value="4">{{ __('Four columns') }}</option>
                                </select>
                                <div class="text-muted small">{{ __('Select number of columns for secondary footer') }}</div>
                            </div>
                        </div>
                    </div>


                    <div class="form-group">
                        <div class="form-check form-switch">
                            <input type='hidden' value='' name='tpl_footer2_use_custom_style'>
                            <input class="form-check-input" type="checkbox" id="tpl_footer2_use_custom_style" name="tpl_footer2_use_custom_style" @if ($theme_config->tpl_footer2_use_custom_style ?? null) checked @endif>
                            <label class="form-check-label" for="tpl_footer2_use_custom_style">{{ __('Use custom style for this section') }}</label>
                        </div>
                        <div class="text-muted small">{{ __('Manage background color, text size, links, text colour...') }}</div>
                    </div>

                    <script>
                        $('#tpl_footer2_use_custom_style').change(function() {
                            select = $(this).prop('checked');
                            if (select)
                                document.getElementById('hidden_div_style_footer2').style.display = 'block';
                            else
                                document.getElementById('hidden_div_style_footer2').style.display = 'none';
                        })
                    </script>

                    <div id="hidden_div_style_footer2" style="display: @if (isset($theme_config->tpl_footer2_use_custom_style)) block @else none @endif" class="mt-2">
                        <div class="form-group col-lg-6 col-md-12 mb-0">
                            <label>{{ __('Select custom style') }} <br>
                                <a target="_blank" href="{{ route('admin.theme-styles.index') }}"><i class="bi bi-palette"></i> {{ __('Add new style') }}</a>
                                <a class="ms-2" onclick="location.reload();" href="#"><i class="bi bi-arrow-clockwise"></i> {{ __('Refresh page') }}</a>
                            </label>
                            <select class="form-select" id="tpl_footer2_style_id" name="tpl_footer2_style_id">
                                <option value="">-- {{ __('select') }} --</option>
                                @foreach ($styles as $style)
                                    <option @if (($theme_config->tpl_footer2_style_id ?? null) == $style->id) selected @endif value="{{ $style->id }}">{{ $style->label }}</option>
                                @endforeach
                            </select>
                            @if (count($styles) == 0)
                                <div class="small text-info mt-1">{{ __("You don't have custom styles created") }}</div>
                            @endif
                        </div>
                    </div>

                </div>

            </div>

        </div>

    </div>

    <input type="hidden" name="theme_id" value="{{ $theme->id }}">
    <button type="submit" name="submit_action" value="update" class="btn btn-primary">{{ __('Update settings') }}</button>
    <button type="submit" name="submit_action" value="footer_content" class="btn btn-gear ms-2">{{ __('Manage primary footer content') }}</button>
    @if ($theme_config->tpl_footer2_show ?? null)
        <button type="submit" name="submit_action" value="footer2_content" class="btn btn-gear ms-2">{{ __('Manage secondary footer content') }}</button>
    @endif
</form>
