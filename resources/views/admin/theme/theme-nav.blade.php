<style>
    .builder-block:hover {
        cursor: unset;
    }
</style>

<div class="mb-3 fw-bold">
    <a target="_blank" href="{{ route('admin.theme-navs.show', ['id' => $theme->nav_id ?? null]) }}"><i class="bi bi-window-fullscreen"></i> {{ __('Manage navigation rows') }}</a>
    <a target="_blank" class="ms-2" href="{{ route('admin.theme-styles.index') }}"><i class="bi bi-palette"></i> {{ __('Manage custom styles') }}</a>
    <a class="ms-2" onclick="location.reload();" href="#"><i class="bi bi-arrow-clockwise"></i> {{ __('Refresh page') }}</a>
</div>

<form method="post">
    @csrf
    @method('PUT')

    <div class="row">
        <div class="col-12 col-lg-4 col-md-6">
            <div class="form-group">
                <label>{{ __('Select navigation') }}</label>
                <select class="form-select" id="nav_id" name="nav_id">
                    <option value="">-- {{ __('select') }} --</option>
                    @foreach ($navs as $nav)
                        <option @if (($theme->nav_id ?? null) == $nav->id) selected @endif value="{{ $nav->id }}">{{ $nav->label }} @if ($nav->is_default == 1)
                                ({{ __('default navigation') }})
                            @endif
                        </option>
                    @endforeach
                </select>
                @if (count($navs) == 0)
                    <div class="small text-info mt-1">{{ __("You don't have navigations created") }}</div>
                @endif
            </div>

        </div>
    </div>

    <hr>

    @if (count($nav_rows ?? []) == 0)
        <div class="alert alert-info">
            {{ __('You need to create at least one navigation row to be able to set style.') }}
        </div>
    @endif

    @foreach ($nav_rows ?? [] as $nav_row)
        <div class="builder-block mb-3" @if ($nav_row->active == 0) style="opacity: 0.6; background-color: #fdf0f0;" @endif>

            @if ($nav_row->active == 0)
                <div class="mb-2 float-end">
                    <span class="badge bg-danger">{{ __('This navigation row is inactive') }}</span>
                </div>
            @endif
            <div class="fw-bold fs-5 mb-2">{{ __('Navigation row') }} #{{ $nav_row->position }}</div>

            <div class="row">
                <div class="form-group col-xl-3 col-lg-4 col-md-6 mb-2">
                    <label>{{ __('Select style for this navigation row') }}</label>
                    <select class="form-select" id="nav_style_id_row_{{ $nav_row->id }}" name="nav_style_id_row_{{ $nav_row->id }}">
                        <option value="">-- {{ __('select') }} --</option>
                        @foreach ($styles as $style)
                            <option @if (($theme_config->{'nav_style_id_row_' . $nav_row->id} ?? null) == $style->id) selected @endif value="{{ $style->id }}">{{ $style->label }}</option>
                        @endforeach
                    </select>
                    <div class="text-muted small">{{ __('Style for background, links, color...') }}</div>

                    @if (!($theme_config->{'nav_style_id_row_' . $nav_row->id} ?? null))
                        <div class="mt-1 text-muted"><span class="text-danger">{{ __('no style selected') }}</span></div>
                    @endif
                </div>

                <div class="form-group col-xl-3 col-lg-4 col-md-6 mb-2">
                    <label>{{ __('Navigation row size') }}</label>
                    <select class="form-select" id="nav_size_row_{{ $nav_row->id }}" name="nav_size_row_{{ $nav_row->id }}">
                        <option @if (($theme_config->{'nav_size_row_' . $nav_row->id} ?? null) == 'normal') selected @endif value="normal">{{ __('Normal') }}</option>
                        <option @if (($theme_config->{'nav_size_row_' . $nav_row->id} ?? null) == 'large') selected @endif value="large">{{ __('Large') }}</option>
                        <option @if (($theme_config->{'nav_size_row_' . $nav_row->id} ?? null) == 'extra_large') selected @endif value="extra_large">{{ __('Extra large') }}</option>
                        <option @if (($theme_config->{'nav_size_row_' . $nav_row->id} ?? null) == 'small') selected @endif value="small">{{ __('Small') }}</option>
                    </select>
                    <div class="text-muted small">{{ __('The height of the navigation row') }}</div>
                </div>

                <div class="form-group col-xl-3 col-lg-4 col-md-6 mb-2">
                    <label>{{ __('Navigation position') }}</label>
                    <select class="form-select" id="nav_position_row_{{ $nav_row->id }}" name="nav_position_row_{{ $nav_row->id }}">
                        <option @if (($theme_config->{'nav_position_row_' . $nav_row->id} ?? null) == 'scroll') selected @endif value="scroll">{{ __('Scroll') }}</option>
                        <option @if (($theme_config->{'nav_position_row_' . $nav_row->id} ?? null) == 'sticky') selected @endif value="sticky">{{ __('Sticky') }}</option>
                    </select>
                    <div class="text-muted small">{{ __('The position of the navigation row. Only one navigation row can be sticky.') }}</div>
                </div>

                <div class="form-group col-xl-3 col-lg-4 col-md-6 mb-2">
                    <label>{{ __('Navigation row shadow') }}</label>
                    <select class="form-select" id="nav_shadow_row_{{ $nav_row->id }}" name="nav_shadow_row_{{ $nav_row->id }}">
                        <option @if (($theme_config->{'nav_shadow_row_' . $nav_row->id} ?? null) == 'none') selected @endif value="none">{{ __('None') }}</option>
                        <option @if (($theme_config->{'nav_shadow_row_' . $nav_row->id} ?? null) == 'small') selected @endif value="small">{{ __('Small') }}</option>
                        <option @if (($theme_config->{'nav_shadow_row_' . $nav_row->id} ?? null) == 'regular') selected @endif value="regular">{{ __('Regular') }}</option>
                        <option @if (($theme_config->{'nav_shadow_row_' . $nav_row->id} ?? null) == 'large') selected @endif value="large">{{ __('Large') }}</option>
                    </select>
                    <div class="text-muted small">{{ __('The shadow of the navigation row. Only one navigation row can have a shadow.') }}</div>
                </div>
            </div>

            <hr>

            <div class="row">
                <div class="form-group col-xl-3 col-lg-4 col-md-6 mb-2">
                    <label>{{ __('Select style for dropdown menus') }}</label>
                    <select class="form-select" id="nav_style_id_row_dropdown_{{ $nav_row->id }}" name="nav_style_id_row_dropdown_{{ $nav_row->id }}">
                        <option value="">-- {{ __('select') }} --</option>
                        @foreach ($styles as $style)
                            <option @if (($theme_config->{'nav_style_id_row_dropdown_' . $nav_row->id} ?? null) == $style->id) selected @endif value="{{ $style->id }}">{{ $style->label }}</option>
                        @endforeach
                    </select>
                    <div class="text-muted small">{{ __('Style for background, links, color...') }}</div>

                    @if (!($theme_config->{'nav_style_id_row_dropdown_' . $nav_row->id} ?? null))
                        <div class="mt-1 text-muted"><span class="text-danger">{{ __('no style selected') }}</span></div>
                    @endif
                </div>
            </div>

            <hr>

            <div class="small text-muted">
                {{ __('You can manage the items and their content in the navigation row here:') }}
                <a target="_blank" href="{{ route('admin.theme-nav-rows.show', ['nav_id' => $theme->nav_id ?? null, 'row_id' => $nav_row->id]) }}">{{ __('Manage navigation row items') }}</a>
            </div>

        </div>
    @endforeach

    <hr>

    <input type="hidden" name="theme_id" value="{{ $theme->id }}">
    <button type="submit" name="submit_action" value="update" class="btn btn-primary">{{ __('Update settings') }}</button>
</form>
