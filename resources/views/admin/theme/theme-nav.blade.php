<style>
    .builder-block:hover {
        cursor: unset;
    }
</style>

@if ($theme->nav_id == null)
    <div class="fw-bold text-danger mb-3">
        <i class="bi bi-info-circle"></i> {{ __('Website main navigation is not set.') }}
    </div>
@endif

<div class="mb-3 fw-bold">
    <a target="_blank" href="{{ route('admin.theme-navs.index') }}"><i class="bi bi-window-fullscreen"></i> {{ __('Manage navigations') }}</a>
    <a target="_blank" class="ms-2" href="{{ route('admin.theme-styles.index') }}"><i class="bi bi-palette"></i> {{ __('Manage custom styles') }}</a>
    <a class="ms-2" onclick="location.reload();" href="#"><i class="bi bi-arrow-clockwise"></i> {{ __('Refresh page') }}</a>
</div>

<form method="post">
    @csrf
    @method('PUT')

    <div class="row">
        <div class="col-12 col-lg-4 col-md-6">
            <div class="form-group">
                <label>{{ __('Select main navigation') }}</label>
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

                <div class="form-text mt-1">
                    {{ __('Select the main navigation of your website.') }}
                </div>
            </div>

        </div>
    </div>

    <hr>

    <div class="fw-bold">
        {{ __('Custom navigation for post types') }}
    </div>
    <div class="text-muted mb-3">
        {{ __('You can set different navigation for each post type of your website. If you do not set a custom navigation for a post type, the main navigation selected above will be used.') }}
    </div>

    @if (count($nav_rows ?? []) == 0)
        <div class="alert alert-info">
            {{ __('You need to create at least one navigation row to be able to set style.') }}
        </div>
    @endif

    @foreach ($post_types as $post_type)
        <div class="form-check form-switch mb-2">
            <input class="form-check-input" type="checkbox" id="nav_on_post_type_{{ $post_type->id }}" name="nav_on_post_type_{{ $post_type->id }}" @if ($theme->configs['nav_id_for_post_type_id_' . $post_type->id] ?? null) checked @endif>
            <label class="form-check-label" for="nav_on_post_type_{{ $post_type->id }}">{{ __('Custom navigation for ' . $post_type->default_language_content->name) }}</label>
        </div>

        <script>
            $('#nav_on_post_type_{{ $post_type->id }}').change(function() {

                select = $(this).prop('checked');
                if (select)
                    document.getElementById('hidden_div_nav_id_{{ $post_type->id }}').style.display = 'block';
                else
                    document.getElementById('hidden_div_nav_id_{{ $post_type->id }}').style.display = 'none';
            })
        </script>


        <div id="hidden_div_nav_id_{{ $post_type->id }}" class="mb-3" style="display: @if ($theme->configs['nav_id_for_post_type_id_' . $post_type->id] ?? null) block @else none @endif">
            <div class="row">
                <div class="col-12 col-lg-4 col-md-6">
                    <div class="form-group">
                        <label>{{ __('Select navigation for ' . $post_type->default_language_content->name) }}</label>
                        <select class="form-select" id="nav_id_{{ $post_type->id }}" name="nav_id_{{ $post_type->id }}">
                            <option value="">-- {{ __('select') }} --</option>
                            @foreach ($navs as $nav)
                                <option @if (($theme->configs['nav_id_for_post_type_id_' . $post_type->id] ?? null) == $nav->id) selected @endif value="{{ $nav->id }}">{{ $nav->label }} @if ($nav->is_default == 1)
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
        </div>
    @endforeach

    <hr>

    <input type="hidden" name="theme_id" value="{{ $theme->id }}">
    <button type="submit" name="submit_action" value="update" class="btn btn-primary">{{ __('Update settings') }}</button>
</form>
