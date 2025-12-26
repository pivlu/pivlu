<form method="post">
    @csrf
    @method('PUT')

    <div class="row">

        <div class="col-12 col-lg-6">

            <div class="card bg-light p-3 mb-3">

                <h5 class="fw-bold">{{ __('Font family') }}</h5>

                <div class="row">
                    <div class="col-sm-6 col-md-6 col-12">
                        <div class="form-group">
                            <select class="form-select" name="default_font_family_data">
                                @foreach ($fonts as $font)
                                    <option @if (($theme_config->default_font_family_data ?? null) == $font->value . '|' . $font->import) selected @endif value="{{ $font->value . '|' . $font->import }}" style="font-size: 1.6em; font-family: {{ $font->value }};">
                                        [{{ $font->name }}]
                                        Almost before we knew it, we had left the ground.</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>


                <div class="fw-bold fs-5 mb-2">{{ __('Sizes') }}</div>

                <div class="row">
                    <div class="col-sm-4 col-md-3 col-12">
                        <div class="form-group mb-4">
                            <label>{{ __('Text font size') }}</label>
                            <select class="form-select" name="default_font_size">
                                @foreach ($font_sizes as $font_size)
                                    <option @if (($theme_config->default_font_size ?? null) == $font_size->value) selected @endif @if (!($theme_config->default_font_size ?? null) && $font_size->value == '1rem') selected @endif value="{{ $font_size->value }}">{{ $font_size->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-sm-4 col-md-3 col-12">
                        <div class="form-group mb-4">
                            <label>{{ __('Heading 1 (h1) font size') }}</label>
                            <select class="form-select" name="default_h1_size">
                                @foreach ($font_sizes as $font_size)
                                    <option @if (($theme_config->default_h1_size ?? null) == $font_size->value) selected @endif @if (!($theme_config->default_h1_size ?? null) && $font_size->value == '2rem') selected @endif value="{{ $font_size->value }}">{{ $font_size->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-sm-4 col-md-3 col-12">
                        <div class="form-group mb-4">
                            <label>{{ __('Heading 2 (h2) font size') }}</label>
                            <select class="form-select" name="default_h2_size">
                                @foreach ($font_sizes as $font_size)
                                    <option @if (($theme_config->default_h2_size ?? null) == $font_size->value) selected @endif @if (!($theme_config->default_h2_size ?? null) && $font_size->value == '1.5rem') selected @endif value="{{ $font_size->value }}">{{ $font_size->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-sm-4 col-md-3 col-12">
                        <div class="form-group mb-4">
                            <label>{{ __('Heading 3 (h3) font size') }}</label>
                            <select class="form-select" name="default_h3_size">
                                @foreach ($font_sizes as $font_size)
                                    <option @if (($theme_config->default_h3_size ?? null) == $font_size->value) selected @endif @if (!($theme_config->default_h3_size ?? null) && $font_size->value == '1.2rem') selected @endif value="{{ $font_size->value }}">{{ $font_size->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-sm-4 col-md-3 col-12">
                        <div class="form-group mb-4">
                            <label>{{ __('Caption font size') }}</label>
                            <select class="form-select" name="default_caption_size">
                                @foreach ($font_sizes as $font_size)
                                    <option @if (($theme_config->default_caption_size ?? null) == $font_size->value) selected @endif @if (!($theme_config->default_caption_size ?? null) && $font_size->value == '0.95rem') selected @endif value="{{ $font_size->value }}">{{ $font_size->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>


                <div class="fw-bold fs-5 mb-2">{{ __('Font weights') }}</div>

                <div class="row">
                    <div class="col-sm-4 col-md-3 col-12">
                        <div class="form-group mb-4">
                            <label>{{ __('Heading 1 (h1) font weight') }}</label>
                            <select class="form-select col-md-6 col-lg-4 col-xl-3" name="default_h1_font_weight">
                                <option @if (($theme_config->default_h1_font_weight ?? null) == 'normal') selected @endif value="normal">{{ __('Normal') }}</option>
                                <option @if (($theme_config->default_h1_font_weight ?? null) == 'bold') selected @endif value="bold">{{ __('Bold') }}</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-sm-4 col-md-3 col-12">
                        <div class="form-group mb-4">
                            <label>{{ __('Heading 2 (h2) font weight') }}</label>
                            <select class="form-select col-md-6 col-lg-4 col-xl-3" name="default_h2_font_weight">
                                <option @if (($theme_config->default_h2_font_weight ?? null) == 'normal') selected @endif value="normal">{{ __('Normal') }}</option>
                                <option @if (($theme_config->default_h2_font_weight ?? null) == 'bold') selected @endif value="bold">{{ __('Bold') }}</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-sm-4 col-md-3 col-12">
                        <div class="form-group mb-4">
                            <label>{{ __('Heading 3 (h3) font weight') }}</label>
                            <select class="form-select col-md-6 col-lg-4 col-xl-3" name="default_h3_font_weight">
                                <option @if (($theme_config->default_h3_font_weight ?? null) == 'normal') selected @endif value="normal">{{ __('Normal') }}</option>
                                <option @if (($theme_config->default_h3_font_weight ?? null) == 'bold') selected @endif value="bold">{{ __('Bold') }}</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-sm-4 col-md-3 col-12">
                        <div class="form-group mb-4">
                            <label>{{ __('Caption font style') }}</label>
                            <select class="form-select col-md-6 col-lg-4 col-xl-3" name="default_caption_font_style">
                                <option @if (($theme_config->default_caption_font_style ?? null) == 'normal') selected @endif value="normal">{{ __('Normal') }}</option>
                                <option @if (($theme_config->default_caption_font_style ?? null) == 'italic') selected @endif value="italic">{{ __('Italic') }}</option>
                            </select>
                        </div>
                    </div>
                </div>


                <div class="fw-bold fs-5 mb-2">{{ __('Links underline') }}</div>

                <div class="row">
                    <div class="col-sm-4 col-md-3 col-12">
                        <div class="form-group mb-4">
                            <label>{{ __('Link decoration') }}</label>
                            <select class="form-select col-md-6 col-lg-4 col-xl-3" name="default_link_decoration">
                                <option @if (($theme_config->default_link_decoration ?? null) == 'none') selected @endif value="none">{{ __('None') }}</option>
                                <option @if (($theme_config->default_link_decoration ?? null) == 'underline') selected @endif value="underline">{{ __('Underline') }}</option>
                                <option @if (($theme_config->default_link_decoration ?? null) == 'dotted') selected @endif value="dotted">{{ __('Dotted') }}</option>
                                <option @if (($theme_config->default_link_decoration ?? null) == 'dashed') selected @endif value="dashed">{{ __('Dashed') }}</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-sm-4 col-md-3 col-12">
                        <div class="form-group mb-4">
                            <label>{{ __('Link decoration on hover') }}</label>
                            <select class="form-select col-md-6 col-lg-4 col-xl-3" name="default_link_hover_decoration">
                                <option @if (($theme_config->default_link_hover_decoration ?? null) == 'none') selected @endif value="none">{{ __('None') }}</option>
                                <option @if (($theme_config->default_link_hover_decoration ?? null) == 'underline') selected @endif value="underline">{{ __('Underline') }}</option>
                                <option @if (($theme_config->default_link_hover_decoration ?? null) == 'dotted') selected @endif value="dotted">{{ __('Dotted') }}</option>
                                <option @if (($theme_config->default_link_hover_decoration ?? null) == 'dashed') selected @endif value="dashed">{{ __('Dashed') }}</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-sm-4 col-md-3 col-12">
                        <div class="form-group mb-4">
                            <label>{{ __('Underline line thickness') }}</label>
                            <select class="form-select col-md-6 col-lg-4 col-xl-3" name="default_link_underline_thickness">
                                <option @if (($theme_config->default_link_underline_thickness ?? null) == 'auto') selected @endif value="auto">{{ __('Normal') }}</option>
                                <option @if (($theme_config->default_link_underline_thickness ?? null) == '3px') selected @endif value="3px">{{ __('Bold') }}</option>
                                <option @if (($theme_config->default_link_underline_thickness ?? null) == '6px') selected @endif value="6px">{{ __('Bolder') }}</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-sm-4 col-md-3 col-12">
                        <div class="form-group mb-4">
                            <label>{{ __('Underline offset') }}</label>
                            <select class="form-select col-md-6 col-lg-4 col-xl-3" name="default_link_underline_offset">
                                <option @if (($theme_config->default_link_underline_offset ?? null) == 'auto') selected @endif value="auto">{{ __('Normal (no offset)') }}</option>
                                <option @if (($theme_config->default_link_underline_offset ?? null) == '0.17em') selected @endif value="0.17em">{{ __('Small offset') }}</option>
                                <option @if (($theme_config->default_link_underline_offset ?? null) == '0.35em') selected @endif value="0.35em">{{ __('Medium offset') }}</option>
                                <option @if (($theme_config->default_link_underline_offset ?? null) == '0.6em') selected @endif value="0.6em">{{ __('Big offset') }}</option>
                            </select>
                            <div class="text-muted small">{{ __('Distance between text and underline') }}</div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary mt-3">{{ __('Update style') }}</button>
                    </div>
                </div>

            </div>

        </div>

        <div class="col-12 col-lg-6">

            <div class="card bg-light p-3 mb-3">

                <div class="fw-bold fs-5 mb-2">{{ __('Colors') }}</div>

                <div class="row">
                    <div class="col-sm-4 col-md-3 col-12">
                        <div class="form-group mb-4">
                            <input id="default_text_color" name="default_text_color" value="{{ $theme_config->default_text_color ?? config('pivlu.pivlu.defaults.font_color') }}">
                            <label>{{ __('Main text color') }}</label>
                            <div class="mt-1 small"> {{ strtoupper($theme_config->default_text_color ?? config('pivlu.pivlu.defaults.font_color')) }}</div>
                            <script>
                                $('#default_text_color').spectrum({
                                    type: "color",
                                    showInput: true,
                                    showInitial: true,
                                    showAlpha: false,
                                    showButtons: false,
                                    allowEmpty: false,
                                });
                            </script>
                        </div>
                    </div>

                    <div class="col-sm-4 col-md-3 col-12">
                        <div class="form-group mb-4">
                            <input id="default_link_color" name="default_link_color" value="{{ $theme_config->default_link_color ?? config('pivlu.pivlu.defaults.link_color') }}">
                            <label>{{ __('Link color') }}</label>
                            <div class="mt-1 small"> {{ strtoupper($theme_config->default_link_color ?? config('pivlu.pivlu.defaults.link_color')) }}</div>
                            <script>
                                $('#default_link_color').spectrum({
                                    type: "color",
                                    showInput: true,
                                    showInitial: true,
                                    showAlpha: false,
                                    showButtons: false,
                                    allowEmpty: false,
                                });
                            </script>
                        </div>
                    </div>

                    <div class="col-sm-4 col-md-3 col-12">
                        <div class="form-group mb-4">
                            <input id="default_link_hover_color" name="default_link_hover_color" value="{{ $theme_config->default_link_hover_color ?? config('pivlu.pivlu.defaults.link_color_hover') }}">
                            <label>{{ __('Link color on mouse hover') }}</label>
                            <div class="mt-1 small"> {{ strtoupper($theme_config->default_link_hover_color ?? config('pivlu.pivlu.defaults.link_color_hover')) }}</div>
                            <script>
                                $('#default_link_hover_color').spectrum({
                                    type: "color",
                                    showInput: true,
                                    showInitial: true,
                                    showAlpha: false,
                                    showButtons: false,
                                    allowEmpty: false,
                                });
                            </script>
                        </div>
                    </div>

                    <div class="col-sm-4 col-md-3 col-12">
                        <div class="form-group mb-4">
                            <input id="default_link_color_underline" name="default_link_color_underline" value="{{ $theme_config->default_link_color_underline ?? config('pivlu.pivlu.defaults.link_color_underline') }}">
                            <label>{{ __('Underline color') }}</label>
                            <div class="mt-1 small"> {{ strtoupper($theme_config->default_link_color_underline ?? config('pivlu.pivlu.defaults.link_color_underline')) }}</div>
                            <script>
                                $('#default_link_color_underline').spectrum({
                                    type: "color",
                                    showInput: true,
                                    showInitial: true,
                                    showAlpha: false,
                                    showButtons: false,
                                    allowEmpty: false,
                                });
                            </script>
                        </div>
                    </div>

                    <div class="col-sm-4 col-md-3 col-12">
                        <div class="form-group mb-4">
                            <input id="default_link_color_underline_hover" name="default_link_color_underline_hover"
                                value="{{ $theme_config->default_link_color_underline_hover ?? config('pivlu.pivlu.defaults.link_color_underline_hover') }}">
                            <label>{{ __('Underline color on hover') }}</label>
                            <div class="mt-1 small"> {{ strtoupper($theme_config->default_link_color_underline_hover ?? config('pivlu.pivlu.defaults.link_color_underline_hover')) }}</div>
                            <script>
                                $('#default_link_color_underline_hover').spectrum({
                                    type: "color",
                                    showInput: true,
                                    showInitial: true,
                                    showAlpha: false,
                                    showButtons: false,
                                    allowEmpty: false,
                                });
                            </script>
                        </div>
                    </div>

                    <div class="col-sm-4 col-md-3 col-12">
                        <div class="form-group mb-4">
                            <input id="default_caption_color" name="default_caption_color" value="{{ $theme_config->default_caption_color ?? 'grey' }}">
                            <label>{{ __('Caption text color') }}</label>
                            <div class="mt-1 small"> {{ strtoupper($theme_config->default_caption_color ?? 'grey') }}</div>
                            <script>
                                $('#default_caption_color').spectrum({
                                    type: "color",
                                    showInput: true,
                                    showInitial: true,
                                    showAlpha: false,
                                    showButtons: false,
                                    allowEmpty: false,
                                });
                            </script>
                        </div>
                    </div>

                    <div class="col-sm-4 col-md-3 col-12">
                        <div class="form-group mb-4">
                            <input id="default_bg_color" name="default_bg_color" value="{{ $theme_config->default_bg_color ?? config('pivlu.pivlu.defaults.bg_color') }}">
                            <label>{{ __('Background color') }}</label>
                            <div class="mt-1 small"> {{ strtoupper($theme_config->default_bg_color ?? config('pivlu.pivlu.defaults.bg_color')) }}</div>
                            <script>
                                $('#default_bg_color').spectrum({
                                    type: "color",
                                    showInput: true,
                                    showInitial: true,
                                    showAlpha: false,
                                    showButtons: false,
                                    allowEmpty: false,
                                });
                            </script>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary mt-3">{{ __('Update style') }}</button>
                    </div>
                </div>


            </div>
        </div>
    </div>
</form>
