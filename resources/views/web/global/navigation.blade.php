@if ($config->website_maintenance_enabled ?? null)
    <div class="text-white bg-danger p-2 text-center">
        <i class="bi bi-info-circle"></i> {{ __('Website is in maintenance mode. Regular users and visitors can not see this page.') }}
    </div>
@endif

@if ($is_inactive_content_preview ?? null)
    <div class="text-white bg-danger p-2 text-center">
        <i class="bi bi-info-circle"></i> {{ __('This page is inactive. You can preview this page as administrator.') }}
    </div>
@endif

@php
    $nav_rows = \Pivlu\Models\ThemeNavRow::with('active_items')->where('nav_id', $config->active_theme->nav_id)->where('active', 1)->orderBy('position')->get();
    $nav_rows = $nav_rows ?? [];

    if ($post_type ?? null) {
        $nav_post_type_id = $post_type->id ?? null;
        $key_nav_post_type_id = 'nav_id_for_post_type_id_' . $nav_post_type_id;

        if ($config->$key_nav_post_type_id ?? null) {
            $custom_nav_id = $config->$key_nav_post_type_id;

            $custom_nav_rows = \Pivlu\Models\ThemeNavRow::with('active_items')->where('nav_id', $custom_nav_id)->where('active', 1)->orderBy('position')->get();
            $custom_nav_rows = $custom_nav_rows ?? [];

            if (count($custom_nav_rows) > 0) {
                $nav_rows = $custom_nav_rows;
            }
        }
    }
@endphp

@foreach ($nav_rows as $nav_row)
    @include('pivlu::web.navigation.nav', [
        'style_id' => $nav_row->configs['style_id'] ?? null,
        'style_id_dropdown' => $nav_row->configs['style_id_dropdown'] ?? null,
        'nav_row_id' => $nav_row->id,
        'items' => $nav_row->active_items,
    ])
@endforeach
