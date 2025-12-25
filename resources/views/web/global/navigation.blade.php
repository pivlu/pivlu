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

@if ($config->tpl_notification_navbar_show ?? null)
    <div class="navbar3 py-3 @if ($config->tpl_notification_navbar_sticky ?? null) sticky-top @endif @if ($config->tpl_notification_navbar_style_id) style_{{ $config->tpl_notification_navbar_style_id }} @endif">
        <div class="@if ((($is_forum_page ?? null) && ($config->tpl_forum_container_fluid ?? null)) || (($is_page ?? null) && ($page->container_fluid ?? null))) container-fluid @else container-xxl @endif">
            <div class="{{ $config->tpl_notification_navbar_content_align ?? null }}">{!! $config->tpl_notification_navbar_content ?? null !!}</div>
        </div>
    </div>
@endif

@if (!($tpl_theme_config->theme_nav ?? null))
    @include('pivlu::template-parts.navigations.default.nav')
@else
    @include("pivlu::template-parts.navigations.$tpl_theme_config->theme_nav.nav")
@endif
