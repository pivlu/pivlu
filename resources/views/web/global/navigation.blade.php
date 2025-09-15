@if(($config->tpl_navbar_layout ?? null) == '2rows')
@include("web.includes.menu.nav-2rows")
@else
@include("web.includes.menu.nav-default")
@endif