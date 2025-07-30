<nav class="nav nav-tabs" id="myTab" role="tablist">
    <a class="nav-item nav-link @if (($menu_section ?? null) == 'posts') active @endif" href="{{ route('admin.posts.index', ['type' => $type]) }}">{!! $post_type->admin_menu_icon ?? '<i class="bi bi-file-text"></i>' !!}
        {{ $post_type->name ?? __('Posts') }}</a>


    @foreach ($taxonomy_terms as $nav_taxonomy_term)
        <a class="nav-item nav-link @if (($menu_section ?? null) == $nav_taxonomy_term->taxonomy) active @endif" href="{{ route('admin.taxonomies.index', ['taxonomy' => $nav_taxonomy_term->taxonomy, 'type' => $nav_taxonomy_term->post_type]) }}">
            @if ($nav_taxonomy_term->hierarchical == 0)
            <i class="bi bi-tag"></i> @else<i class="bi bi-diagram-3"></i>
            @endif
            {{ __(json_decode($nav_taxonomy_term->labels)->plural ?? 'All ' . $nav_taxonomy_term->name) }}
        </a>
    @endforeach

    @if ($post_type->has_tags ?? null)
        <a class="nav-item nav-link @if (($menu_section ?? null) == 'tags') active @endif" href="{{ route('admin.tags.index', ['type' => $type]) }}"><i class="bi bi-tag"></i> {{ __('Tags') }}</a>
    @endif

    {{--
    @if (Auth::user()->role == 'admin')
        <a class="nav-item nav-link @if (($menu_section ?? null) == 'config') active @endif" href="{{ route('admin.posts.config') }}"><i class="bi bi-gear"></i> {{ __('Settings') }}</a>
    @endif
    --}}
</nav>
