<ul class="dropdown-menu">
    <li>
        <a class="dropdown-item" href="{{ route('admin.theme-nav-rows.add-item', ['nav_id' => $nav_id, 'row_id' => $row_id, 'column' => $column, 'item_type' => 'menu_links']) }}">{{ __('Menu links') }}</a>
    </li>
    <li>
        <a class="dropdown-item" href="{{ route('admin.theme-nav-rows.add-item', ['nav_id' => $nav_id, 'row_id' => $row_id, 'column' => $column, 'item_type' => 'logo']) }}">{{ __('Logo') }}</a>
    </li>
    <li>
        <a class="dropdown-item" href="{{ route('admin.theme-nav-rows.add-item', ['nav_id' => $nav_id, 'row_id' => $row_id, 'column' => $column, 'item_type' => 'html']) }}">{{ __('Text / HTML') }}</a>
    </li>
    <li>
        <a class="dropdown-item" href="{{ route('admin.theme-nav-rows.add-item', ['nav_id' => $nav_id, 'row_id' => $row_id, 'column' => $column, 'item_type' => 'search']) }}">{{ __('Search') }}</a>
    </li>
    <li>
        <a class="dropdown-item" href="{{ route('admin.theme-nav-rows.add-item', ['nav_id' => $nav_id, 'row_id' => $row_id, 'column' => $column, 'item_type' => 'social_buttons']) }}">{{ __('Social buttons') }}</a>
    </li>
    <li>
        <a class="dropdown-item" href="{{ route('admin.theme-nav-rows.add-item', ['nav_id' => $nav_id, 'row_id' => $row_id, 'column' => $column, 'item_type' => 'custom_code']) }}">{{ __('Custom code') }}</a>
    </li>
    <li>
        <a class="dropdown-item" href="{{ route('admin.theme-nav-rows.add-item', ['nav_id' => $nav_id, 'row_id' => $row_id, 'column' => $column, 'item_type' => 'login_register']) }}">{{ __('Login / Register') }}</a>
    </li>
    <li>
        <a class="dropdown-item" href="{{ route('admin.theme-nav-rows.add-item', ['nav_id' => $nav_id, 'row_id' => $row_id, 'column' => $column, 'item_type' => 'language_switcher']) }}">{{ __('Language switcher') }}</a>
    </li>
</ul>
