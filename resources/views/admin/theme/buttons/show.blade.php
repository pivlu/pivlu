@include('pivlu::admin.includes.color-picker')

<div class="page-title">
    <div class="row">
        <div class="col-12">
            <nav aria-label="breadcrumb" class="breadcrumb-header">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin') }}">{{ __('Dashboard') }}</a></li>
                    <li class="breadcrumb-item" aria-current="page"><a href="{{ route('admin.themes.index') }}">{{ __('Website template') }}</a></li>
                    <li class="breadcrumb-item" aria-current="page"><a href="{{ route('admin.theme-buttons.index') }}">{{ __('Buttons') }}</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ $button->label }}</li>
                </ol>
            </nav>
        </div>
    </div>
</div>



<div class="card">

    <div class="card-body">

        <div class="mb-2 fs-5">{{ __('Edit button') }}: <b>{{ $button->label }}</b></div>

        @if ($message = Session::get('success'))
            <div class="alert alert-success">
                @if ($message == 'updated')
                    <h4 class="alert-heading">{{ __('Updated') }}</h4>
                    <i class="bi bi-exclamation-triangle"></i>
                    {{ __('Info: If you don\'t see any changes on website, you can try to reload the website using CTRL+F5 or clear browser cache.') }}
                @endif
            </div>
        @endif

        <form method="post">
            @csrf
            @method('PUT')

            <style>
                .btn_style_{{ $button->id }} {
                    background-color: {{ $data->bg_color ?? config('pivlu.defaults.button_bg_color') }};
                    color: {{ $data->font_color ?? config('pivlu.defaults.button_font_color') }};
                    font-weight: {{ $data->font_weight ?? 'normal' }};
                    border-radius: {{ $data->rounded ?? 0 }};
                }

                .btn_style_{{ $button->id }}:hover {
                    background-color: {{ $data->bg_color_hover ?? config('pivlu.defaults.button_bg_color_hover') }};
                    color: {{ $data->font_color_hover ?? config('pivlu.defaults.button_font_color') }};
                    font-weight: {{ $data->font_weight ?? 'normal' }};
                }
            </style>

            <button class="btn btn_style_{{ $button->id }} @if ($data->shadow ?? null) {{ $data->shadow }} @endif">Preview button</button>
            <div class="form-text text-muted small mt-3"><i class="bi bi-info-circle"></i> {{ __('Update style to preview using new changes') }}</div>

            <hr>

            <div class="col-12 col-lg-3 col-md-4">
                <div class="form-group mb-4">
                    <div class="form-group">
                        <label>{{ __('Label') }}</label>
                        <input class="form-control" name="label" type="text" required value="{{ $button->label }}" />
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12 col-lg-3 col-md-4">
                    <div class="form-group mb-4">
                        <input id="bg_color" name="bg_color" value="{{ $data->bg_color ?? config('pivlu.defaults.button_bg_color') }}">
                        <label>{{ __('Background color') }}</label>
                        <div class="mt-1 small"> {{ strtoupper($data->bg_color ?? null) ?? config('pivlu.defaults.button_bg_color') }}</div>
                        <script>
                            $('#bg_color').spectrum({
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


                <div class="col-12 col-lg-3 col-md-4">
                    <div class="form-group mb-4">
                        <input id="border_color" name="border_color" value="{{ $data->border_color ?? config('pivlu.defaults.button_bg_color') }}">
                        <label>{{ __('Border color') }}</label>
                        <div class="mt-1 small"> {{ strtoupper($data->border_color ?? null) ?? config('pivlu.defaults.button_bg_color') }}</div>
                        <script>
                            $('#border_color').spectrum({
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


                <div class="col-12 col-lg-3 col-md-4">
                    <div class="form-group mb-4">
                        <input id="font_color" name="font_color" value="{{ $data->font_color ?? config('pivlu.defaults.button_font_color') }}">
                        <label>{{ __('Font color') }}</label>
                        <div class="mt-1 small"> {{ strtoupper($data->font_color ?? null) ?? config('pivlu.defaults.button_font_color') }}</div>
                        <script>
                            $('#font_color').spectrum({
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
                <div class="col-12 col-lg-3 col-md-4">
                    <div class="form-group mb-4">
                        <input id="bg_color_hover" name="bg_color_hover" value="{{ $data->bg_color_hover ?? config('pivlu.defaults.button_bg_color_hover') }}">
                        <label>{{ __('Background color on mouse hover') }}</label>
                        <div class="mt-1 small"> {{ strtoupper($data->bg_color_hover ?? null) ?? config('pivlu.defaults.button_bg_color_hover') }}</div>
                        <script>
                            $('#bg_color_hover').spectrum({
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


                <div class="col-12 col-lg-3 col-md-4">
                    <div class="form-group mb-4">
                        <input id="border_color_hover" name="border_color_hover" value="{{ $data->border_color_hover ?? config('pivlu.defaults.button_border_color_hover') }}">
                        <label>{{ __('Border color on mouse hover') }}</label>
                        <div class="mt-1 small"> {{ strtoupper($data->border_color_hover ?? null) ?? config('pivlu.defaults.button_border_color_hover') }}</div>
                        <script>
                            $('#border_color_hover').spectrum({
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


                <div class="col-12 col-lg-3 col-md-4">
                    <div class="form-group mb-4">
                        <input id="font_color_hover" name="font_color_hover" value="{{ $data->font_color_hover ?? config('pivlu.defaults.button_font_color_hover') }}">
                        <label>{{ __('Font color on mouse hover') }}</label>
                        <div class="mt-1 small"> {{ strtoupper($data->font_color_hover ?? null) ?? config('pivlu.defaults.button_font_color_hover') }}</div>
                        <script>
                            $('#font_color_hover').spectrum({
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
                <div class="col-sm-4 col-md-4 col-lg-3 col-12">
                    <div class="form-group mb-4">
                        <label>{{ __('Border rounded') }}</label>
                        <select class="form-select" name="rounded">
                            <option @if (($data->rounded ?? null) == '0') selected @endif value="0">{{ __('No radius') }}</option>
                            <option @if (($data->rounded ?? null) == '0.2rem') selected @endif value="0.2rem">{{ __('Extra small') }}</option>
                            <option @if (($data->rounded ?? null) == '0.35rem') selected @endif value="0.35rem">{{ __('Small') }}</option>
                            <option @if (($data->rounded ?? null) == '0.45rem') selected @endif value="0.45rem">{{ __('Medium') }}</option>
                            <option @if (($data->rounded ?? null) == '0.6rem') selected @endif value="0.6rem">{{ __('Large') }}</option>
                            <option @if (($data->rounded ?? null) == '1rem') selected @endif value="1rem">{{ __('Extra large') }}</option>
                        </select>
                    </div>
                </div>

                <div class="col-sm-4 col-md-4 col-lg-3 col-12">
                    <div class="form-group mb-4">
                        <label>{{ __('Font weight') }}</label>
                        <select class="form-select" name="font_weight">
                            <option @if (($data->font_weight ?? null) == 'normal') selected @endif value="normal">{{ __('Normal') }}</option>
                            <option @if (($data->font_weight ?? null) == 'bold') selected @endif value="bold">{{ __('Bold') }}</option>
                        </select>
                    </div>
                </div>
            </div>


            <div class="col-sm-4 col-md-3 col-12">
                <div class="form-group mb-0">
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" id="shadow" name="shadow" @if ($data->shadow ?? null) checked @endif>
                        <label class="form-check-label" for="shadow">{{ __('Add shadow around the button') }}</label>
                    </div>
                </div>
            </div>

            <script>
                $('#shadow').change(function() {
                    select = $(this).prop('checked');
                    if (select)
                        document.getElementById('hidden_div_shadow').style.display = 'block';
                    else
                        document.getElementById('hidden_div_shadow').style.display = 'none';
                })
            </script>

            <div class="col-sm-4 col-md-3 col-lg-2 col-12">
                <div id="hidden_div_shadow" style="display: @if ($data->shadow ?? null) block @else none @endif" class="mt-1">
                    <div class="form-group mb-4">
                        <label>{{ __('Shadow style') }}</label>
                        <select class="form-select" name="shadow_style">
                            <option @if (($data->shadow ?? null) == 'shadow-sm') selected @endif value="shadow-sm">{{ __('Small') }}</option>
                            <option @if (($data->shadow ?? null) == 'shadow') selected @endif value="shadow">{{ __('Normal') }}</option>
                            <option @if (($data->shadow ?? null) == 'shadow-lg') selected @endif value="shadow-lg">{{ __('Large') }}</option>
                        </select>
                    </div>
                </div>
            </div>


            <hr>

            <button type="submit" class="btn btn-primary">{{ __('Update button style') }}</button>

        </form>

    </div>
    <!-- end card-body -->

</div>
