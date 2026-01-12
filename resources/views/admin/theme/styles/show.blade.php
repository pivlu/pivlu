@include('pivlu::admin.includes.import-fonts')
@include('pivlu::admin.includes.color-picker')

<div class="page-title">
    <div class="row">
        <div class="col-12">
            <nav aria-label="breadcrumb" class="breadcrumb-header">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin') }}">{{ __('Dashboard') }}</a></li>
                    <li class="breadcrumb-item" aria-current="page"><a href="{{ route('admin.themes.index') }}">{{ __('Website template') }}</a></li>
                    <li class="breadcrumb-item" aria-current="page"><a href="{{ route('admin.block-styles.index') }}">{{ __('Block styles') }}</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ $style->label }}</li>
                </ol>
            </nav>
        </div>
    </div>
</div>



<div class="card">

    <div class="card-body">

        <div class="mb-2 fs-5">{{ __('Update theme style') }}: <b>{{ $style->label }}</b></div>

        @if ($message = Session::get('success'))
            <div class="alert alert-success">
                @if ($message == 'updated')
                    <div class="fw-bold">{{ __('Updated') }}</div>
                    <i class="bi bi-exclamation-circle"></i>
                    {{ __("Note: If you don't see any changes on website, you can try to reload the website using CTRL+F5 or clear browser cache.") }}
                @endif
                @if ($message == 'created')
                    <h4 class="alert-heading">{{ __('Created') }}</h4>
                @endif
            </div>
        @endif

        @if ($message = Session::get('error'))
            <div class="alert alert-danger">
                @if ($message == 'no_label')
                    {{ __('Error. Input label') }}
                @endif
                @if ($message == 'duplicate')
                    {{ __('Error. This style exists') }}
                @endif
            </div>
        @endif

        <a target="_blank" class="btn btn-gear" href="{{ route('admin.preview-style', ['id' => $style->id]) }}">{{ __('Preview style') }}</a>

        <div class="form-text text-muted small mt-1 mb-2"><i class="bi bi-info-circle"></i> {{ __('Update style to preview using new changes') }}</div>

        <form method="post">
            @csrf
            @method('PUT')

            <div class="row">

                <div class="col-12 col-lg-6">

                    <div class="card bg-light px-3 pt-2 pb-3 mb-4">

                        <div class="fw-bold fs-5 mb-2">{{ __('Font style') }}</div>

                        <div class="col-12">
                            <div class="form-group mb-2">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="use_custom_font_family" name="use_custom_font_family" @if ($item->font_family ?? null) checked @endif>
                                    <label class="form-check-label" for="use_custom_font_family">
                                        {{ __('Use custom font family for this block section') }}
                                    </label>
                                </div>
                                <div class="form-text mt-0 mb-0">
                                    {{ __('This is the font family of the section who use this style. If disabled, template font family will be used.') }}
                                </div>
                            </div>
                        </div>

                        <script>
                            $('#use_custom_font_family').change(function() {
                                select = $(this).prop('checked');
                                if (select)
                                    document.getElementById('hidden_div_font_family').style.display = 'block';
                                else
                                    document.getElementById('hidden_div_font_family').style.display = 'none';
                            })
                        </script>

                        <div class="row">
                            <div id="hidden_div_font_family" style="display: @if ($item->font_family ?? null) block @else none @endif" class="mt-1">
                                <div class="col-sm-6 col-md-6 col-12">
                                    <div class="form-group">
                                        <label>{{ __('Font family') }}</label>
                                        <select class="form-select" name="font_family">
                                            @foreach ($fonts as $font)
                                                <option @if (($item->font_family ?? null) == $font->value) selected @endif value="{{ $font->value }}" style="font-size: 1.6em; font-family: {{ $font->value }};">[{{ $font->name }}]
                                                    Almost before we knew it, we had left the ground.</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-4 col-md-3 col-12">
                                <div class="form-group mb-4">
                                    <label>{{ __('Text align') }}</label>
                                    <select class="form-select" name="text_align">
                                        <option @if (($item->text_align ?? null) == 'left') selected @endif value="left">{{ __('Left') }}</option>
                                        <option @if (($item->text_align ?? null) == 'right') selected @endif value="right">{{ __('Right') }}</option>
                                        <option @if (($item->text_align ?? null) == 'center') selected @endif value="center">{{ __('Center') }}</option>
                                    </select>
                                </div>
                            </div>
                        </div>


                        <div class="fw-bold fs-5 mb-2">{{ __('Sizes') }}</div>

                        <div class="row">
                            <div class="col-sm-4 col-md-3 col-12">
                                <div class="form-group mb-4">
                                    <label>{{ __('Text font size') }}</label>
                                    <select class="form-select" name="text_size">
                                        @foreach ($font_sizes as $font_size)
                                            <option @if (($item->text_size ?? null) == $font_size->value) selected @endif @if (!($item->text_size ?? null) && $font_size->value == '1rem') selected @endif value="{{ $font_size->value }}">{{ $font_size->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-sm-4 col-md-3 col-12">
                                <div class="form-group mb-4">
                                    <label>{{ __('Title font size') }}</label>
                                    <select class="form-select" name="title_size">
                                        @foreach ($font_sizes as $font_size)
                                            <option @if (($item->title_size ?? null) == $font_size->value) selected @endif @if (!($item->title_size ?? null) && $font_size->value == '1.4rem') selected @endif value="{{ $font_size->value }}">{{ $font_size->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-sm-4 col-md-3 col-12">
                                <div class="form-group mb-4">
                                    <label>{{ __('Subtitle font size') }}</label>
                                    <select class="form-select" name="subtitle_size">
                                        @foreach ($font_sizes as $font_size)
                                            <option @if (($item->subtitle_size ?? null) == $font_size->value) selected @endif @if (!($item->subtitle_size ?? null) && $font_size->value == '1.2rem') selected @endif value="{{ $font_size->value }}">{{ $font_size->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-sm-4 col-md-3 col-12">
                                <div class="form-group mb-4">
                                    <label>{{ __('Caption font size') }}</label>
                                    <select class="form-select" name="caption_size">
                                        @foreach ($font_sizes as $font_size)
                                            <option @if (($item->caption_size ?? null) == $font_size->value) selected @endif @if (!($item->caption_size ?? null) && $font_size->value == '0.95rem') selected @endif value="{{ $font_size->value }}">{{ $font_size->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>


                        <div class="fw-bold fs-5 mb-2">{{ __('Font weights') }}</div>

                        <div class="row">
                            <div class="col-sm-4 col-md-3 col-12">
                                <div class="form-group mb-4">
                                    <label>{{ __('Font weight (text)') }}</label>
                                    <select class="form-select col-md-6 col-lg-4 col-xl-3" name="text_font_weight">
                                        <option @if (($item->text_font_weight ?? null) == 'normal') selected @endif value="normal">{{ __('Normal') }}</option>
                                        <option @if (($item->text_font_weight ?? null) == 'bold') selected @endif value="bold">{{ __('Bold') }}</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-sm-4 col-md-3 col-12">
                                <div class="form-group mb-4">
                                    <label>{{ __('Font weight (links)') }}</label>
                                    <select class="form-select col-md-6 col-lg-4 col-xl-3" name="link_font_weight">
                                        <option @if (($item->link_font_weight ?? null) == 'normal') selected @endif value="normal">{{ __('Normal') }}</option>
                                        <option @if (($item->link_font_weight ?? null) == 'bold') selected @endif value="bold">{{ __('Bold') }}</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-sm-4 col-md-3 col-12">
                                <div class="form-group mb-4">
                                    <label>{{ __('Font weight (title)') }}</label>
                                    <select class="form-select col-md-6 col-lg-4 col-xl-3" name="title_font_weight">
                                        <option @if (($item->title_font_weight ?? null) == 'normal') selected @endif value="normal">{{ __('Normal') }}</option>
                                        <option @if (($item->title_font_weight ?? null) == 'bold') selected @endif value="bold">{{ __('Bold') }}</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-sm-4 col-md-3 col-12">
                                <div class="form-group mb-4">
                                    <label>{{ __('Font weight (subtitle)') }}</label>
                                    <select class="form-select col-md-6 col-lg-4 col-xl-3" name="subtitle_font_weight">
                                        <option @if (($item->subtitle_font_weight ?? null) == 'normal') selected @endif value="normal">{{ __('Normal') }}</option>
                                        <option @if (($item->subtitle_font_weight ?? null) == 'bold') selected @endif value="bold">{{ __('Bold') }}</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-sm-4 col-md-3 col-12">
                                <div class="form-group mb-4">
                                    <label>{{ __('Caption font style') }}</label>
                                    <select class="form-select col-md-6 col-lg-4 col-xl-3" name="caption_style">
                                        <option @if (($item->caption_style ?? null) == 'normal') selected @endif value="normal">{{ __('Normal') }}</option>
                                        <option @if (($item->caption_style ?? null) == 'italic') selected @endif value="italic">{{ __('Italic') }}</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary">{{ __('Update style') }}</button>
                            </div>
                        </div>

                    </div>

                </div>


                <div class="col-12 col-lg-6">

                    <div class="card bg-light px-3 pt-2 pb-3 mb-4">

                        <div class="fw-bold fs-5 mb-2">{{ __('Links') }}</div>

                        <div class="row">
                            <div class="col-sm-4 col-md-3 col-12">
                                <div class="form-group mb-3">
                                    <label>{{ __('Link decoration') }}</label>
                                    <select class="form-select" name="link_decoration">
                                        <option @if (($item->link_decoration ?? null) == 'none') selected @endif value="none">{{ __('None') }}</option>
                                        <option @if (($item->link_decoration ?? null) == 'underline') selected @endif value="underline">{{ __('Underline') }}</option>
                                        <option @if (($item->link_decoration ?? null) == 'dotted') selected @endif value="dotted">{{ __('Dotted') }}</option>
                                        <option @if (($item->link_decoration ?? null) == 'dashed') selected @endif value="dashed">{{ __('Dashed') }}</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-sm-4 col-md-3 col-12">
                                <div class="form-group mb-3">
                                    <label>{{ __('Link decoration on hover') }}</label>
                                    <select class="form-select" name="link_hover_decoration">
                                        <option @if (($item->link_hover_decoration ?? null) == 'none') selected @endif value="none">{{ __('None') }}</option>
                                        <option @if (($item->link_hover_decoration ?? null) == 'underline') selected @endif value="underline">{{ __('Underline') }}</option>
                                        <option @if (($item->link_hover_decoration ?? null) == 'dotted') selected @endif value="dotted">{{ __('Dotted') }}</option>
                                        <option @if (($item->link_hover_decoration ?? null) == 'dashed') selected @endif value="dashed">{{ __('Dashed') }}</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-sm-4 col-md-3 col-12">
                                <div class="form-group mb-3">
                                    <label>{{ __('Underline line thickness') }}</label>
                                    <select class="form-select" name="link_underline_thickness">
                                        <option @if (($item->link_underline_thickness ?? null) == 'auto') selected @endif value="auto">{{ __('Normal') }}</option>
                                        <option @if (($item->link_underline_thickness ?? null) == '3px') selected @endif value="3px">{{ __('Bold') }}</option>
                                        <option @if (($item->link_underline_thickness ?? null) == '6px') selected @endif value="6px">{{ __('Bolder') }}</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-sm-4 col-md-3 col-12">
                                <div class="form-group mb-3">
                                    <label>{{ __('Underline offset') }}</label>
                                    <select class="form-select" name="link_underline_offset">
                                        <option @if (($item->link_underline_offset ?? null) == 'auto') selected @endif value="auto">{{ __('Normal (no offset)') }}</option>
                                        <option @if (($item->link_underline_offset ?? null) == '0.17em') selected @endif value="0.17em">{{ __('Small offset') }}</option>
                                        <option @if (($item->link_underline_offset ?? null) == '0.35em') selected @endif value="0.35em">{{ __('Medium offset') }}</option>
                                        <option @if (($item->link_underline_offset ?? null) == '0.6em') selected @endif value="0.6em">{{ __('Big offset') }}</option>
                                    </select>
                                    <div class="text-muted small">{{ __('Distance between text and underline') }}</div>
                                </div>
                            </div>
                        </div>

                        <div class="fw-bold fs-5 mb-2">{{ __('Colors') }}</div>

                        <div class="col-12">
                            <div class="form-group mb-2">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="use_custom_bg" name="use_custom_bg" @if (($item->use_custom_bg ?? null) == 1) checked @endif>
                                    <label class="form-check-label" for="use_custom_bg">
                                        {{ __('Use custom background color for this block section') }}
                                    </label>
                                </div>
                                <div class="form-text mt-0 mb-0">
                                    {{ __('This is the color of the section who use this style. If disabled, template background color will be used.') }}
                                </div>
                            </div>
                        </div>

                        <script>
                            $('#use_custom_bg').change(function() {
                                select = $(this).prop('checked');
                                if (select)
                                    document.getElementById('hidden_div_color').style.display = 'block';
                                else
                                    document.getElementById('hidden_div_color').style.display = 'none';
                            })
                        </script>

                        <div class="col-12">
                            <div id="hidden_div_color" style="display: @if (($item->use_custom_bg ?? null) == 1) block @else none @endif" class="mt-1">
                                <div class="form-group mb-4">
                                    <input id="bg_color" name="bg_color" value="{{ $item->bg_color ?? '#ffffff' }}">
                                    <label>{{ __('Background color') }}</label>
                                    <div class="mt-1 small"> {{ strtoupper($item->bg_color ?? '#ffffff') }}</div>
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
                        </div>

                        <div class="row mt-3">
                            <div class="col-sm-4 col-md-3 col-12">
                                <div class="form-group mb-4">
                                    <input id="text_color" name="text_color" value="{{ $item->text_color ?? config('pivlu.pivlu.defaults.font_color') }}">
                                    <label>{{ __('Text color') }}</label>
                                    <div class="mt-1 small"> {{ strtoupper($item->text_color ?? config('pivlu.pivlu.defaults.font_color')) }}</div>
                                    <script>
                                        $('#text_color').spectrum({
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
                                    <input id="caption_color" name="caption_color" value="{{ $item->caption_color ?? 'grey' }}">
                                    <label>{{ __('Caption text color') }}</label>
                                    <div class="mt-1 small"> {{ strtoupper($item->caption_color ?? config('pivlu.pivlu.defaults.link_color_underline_hover')) }}</div>
                                    <script>
                                        $('#caption_color').spectrum({
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

                        <div class="row mt-3">
                            <div class="col-sm-4 col-md-3 col-12">
                                <div class="form-group mb-4">
                                    <input id="link_color" name="link_color" value="{{ $item->link_color ?? config('pivlu.pivlu.defaults.link_color') }}">
                                    <label>{{ __('Link color') }}</label>
                                    <div class="mt-1 small"> {{ strtoupper($item->link_color ?? config('pivlu.pivlu.defaults.link_color')) }}</div>
                                    <script>
                                        $('#link_color').spectrum({
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
                                    <input id="link_hover_color" name="link_hover_color" value="{{ $item->link_hover_color ?? config('pivlu.pivlu.defaults.link_color_hover') }}">
                                    <label>{{ __('Link color on mouse hover') }}</label>
                                    <div class="mt-1 small"> {{ strtoupper($item->link_hover_color ?? config('pivlu.pivlu.defaults.link_color_hover')) }}</div>
                                    <script>
                                        $('#link_hover_color').spectrum({
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
                                    <input id="link_underline_color" name="link_underline_color" value="{{ $item->link_underline_color ?? config('pivlu.pivlu.defaults.link_color_underline') }}">
                                    <label>{{ __('Underline color') }}</label>
                                    <div class="mt-1 small"> {{ strtoupper($item->link_underline_color ?? config('pivlu.pivlu.defaults.link_color_underline')) }}</div>
                                    <script>
                                        $('#link_underline_color').spectrum({
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
                                    <input id="link_underline_color_hover" name="link_underline_color_hover" value="{{ $item->link_underline_color_hover ?? config('pivlu.pivlu.defaults.link_color_underline_hover') }}">
                                    <label>{{ __('Underline color on hover') }}</label>
                                    <div class="mt-1 small"> {{ strtoupper($item->link_underline_color_hover ?? config('pivlu.pivlu.defaults.link_color_underline_hover')) }}</div>
                                    <script>
                                        $('#link_underline_color_hover').spectrum({
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
                                <button type="submit" class="btn btn-primary">{{ __('Update style') }}</button>
                            </div>
                        </div>
                    </div>
                </div>

            </div>


        </form>

    </div>
    <!-- end card-body -->

</div>
