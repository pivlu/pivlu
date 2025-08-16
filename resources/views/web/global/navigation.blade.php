@if(($config->tpl_navbar_layout ?? null) == '2rows')
@include("web.layouts.nav-2rows")
@else
@include("web.layouts.nav-default")
@endif