@include('admin.includes.trumbowyg-assets')
@include('admin.includes.color-picker')

<div class="page-title">
    <div class="row">
        <div class="col-12">
            <nav aria-label="breadcrumb" class="breadcrumb-header">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin') }}">{{ __('Dashboard') }}</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ __('Manage block content') }}</li>
                </ol>
            </nav>
        </div>
    </div>
</div>

@if ($message = Session::get('success'))
    <div class="alert alert-success">
        @if ($message == 'updated')
            {{ __('Updated') }}
        @endif
        @if ($message == 'created')
            {{ __('Block added. You can add content below.') }}
        @endif
    </div>
@endif

@if ($message = Session::get('error'))
    <div class="alert alert-danger">
        @if ($message == 'duplicate')
            {{ __('Error. This block exists') }}
        @endif
    </div>
@endif

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif


@if ($block->block_type->type == 'gallery' || $block->block_type->type == 'card' || $block->block_type->type == 'slider')
    <div class="row">

        <div class="col-md-5">
@endif

<div class="card">

    <div class="card-header">
        <h4 class="card-title">@include('admin.includes.block_type_label', ['type' => $block->block_type->type]) - {{ __('Manage block content') }}</h4>
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

        <form id="updateBlock" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            @php
                $block_settings = json_decode($block->settings);
            @endphp


            <div class="form-group col-md-6">
                <label class="form-label" for="blockLabel">{{ __('Label') }} ({{ __('optional') }})</label>
                <input class="form-control" type="text" id="blockLabel" name="label" value="{{ $block->label }}">
                <div class="form-text">{{ __('You can enter a label for this block to easily identify it from multiple blocks of the same type on a page') }}</div>
            </div>

            <div class="form-group">
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" id="hidden" name="hidden" @if ($block->hidden ?? null) checked @endif>
                    <label class="form-check-label" for="hidden">{{ __('Hide block') }}</label>
                </div>
                <div class="form-text">{{ __('Hidden blocks are not displayed on website') }}</div>
            </div>

            @if (!($is_simple_block ?? null))
                @if (!($block->block_type->type == 'slider'))
                    <div class="form-group">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="use_custom_bg" name="use_custom_bg" @if ($block_settings->bg_color ?? null) checked @endif>
                            <label class="form-check-label" for="use_custom_bg">{{ __('Use custom background color for this section') }}</label>
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

                    <div id="hidden_div_color" style="display: @if (isset($block_settings->bg_color)) block @else none @endif" class="mt-1">
                        <div class="form-group">
                            <input class="form-control form-control-color" id="bg_color" name="bg_color" value="@if (isset($block_settings->bg_color)) {{ $block_settings->bg_color }} @else #fbf7f0 @endif">
                            <label>{{ __('Background color') }}</label>
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


                    <div class="form-group mb-0">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="use_custom_style" name="use_custom_style" @if ($block_settings->style_id ?? null) checked @endif>
                            <label class="form-check-label" for="use_custom_style">{{ __('Use custom style for this section') }}</label>
                        </div>
                    </div>

                    <script>
                        $('#use_custom_style').change(function() {
                            select = $(this).prop('checked');
                            if (select)
                                document.getElementById('hidden_div_style').style.display = 'block';
                            else
                                document.getElementById('hidden_div_style').style.display = 'none';
                        })
                    </script>

                    <div id="hidden_div_style" style="display: @if (isset($block_settings->style_id)) block @else none @endif" class="mt-2">
                        <div class="form-group col-lg-4 col-xl-3 col-md-6 mb-0">                            
                            <select class="form-select" id="style_id" name="style_id" value="@if (isset($block_settings->style_id)) {{ $block_settings->style_id }} @else #fbf7f0 @endif">
                                <option value="">-- {{ __('select style') }} --</option>
                                @foreach ($styles as $style)
                                    <option @if (($block_settings->style_id ?? null) == $style->id) selected @endif value="{{ $style->id }}">{{ $style->label }}</option>
                                @endforeach
                            </select>
                            @if (count($styles) == 0)
                                <div class="small text-info mt-1">{{ __("You don't have custom styles created") }}</div>
                            @endif
                            <label class="mt-1">[<a class="fw-bold" target="_blank" href="{{ route('admin.theme-styles.index') }}">{{ __('manage custom styles') }}</a>]</label>
                        </div>
                    </div>
                @endif
            @endif

            <hr>

            @include("admin.blocks.types.{$block->block_type->type}")

            <div class="form-group">
                <input type="hidden" name="referer" value="{{ $referer }}">
                <button type="submit" class="btn btn-primary">{{ __('Update') }}</button>
                <button type="submit" name="submit_return_to_block" value="block" class="btn btn-light ms-3">{{ __('Update and return here') }}</button>
            </div>

        </form>

    </div>
    <!-- end card-body -->
</div>


@if ($block->block_type->type == 'gallery')
    </div>
    <div class="col-md-7">
        @include('admin.blocks.includes.items-gallery')
    </div>
    </div>
@endif


@if ($block->block_type->type == 'card')
    </div>
    <div class="col-md-7">
        @include('admin.blocks.includes.items-card')
    </div>
    </div>
@endif

@if ($block->block_type->type == 'slider')
    </div>
    <div class="col-md-7">
        @include('admin.blocks.includes.items-slider')
    </div>
    </div>
@endif
