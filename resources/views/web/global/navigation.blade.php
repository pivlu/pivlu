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

@foreach ($config->nav_rows as $nav_row)    
    @include('pivlu::web.navigation.nav', ['style_id' => $config->{"nav_style_id_row_{$nav_row->id}"} ?? null, 'style_id_dropdown' => $config->{"nav_style_id_row_dropdown_{$nav_row->id}"} ?? null, 'nav_row_id' => $nav_row->id, 'items' => $nav_row->active_items])    
@endforeach
