<nav class="nav nav-tabs mb-2" id="myTab" role="tablist">
    <a class="nav-item nav-link @if (($menu_section ?? null) == 'posts') active @endif" href="{{ route('admin.posts.index', ['post_type_id' => $post_type->id]) }}">{!! $post_type->admin_menu_icon ?? '<i class="bi bi-file-text"></i>' !!}
        {{ $post_type->default_language_content->name ?? __('Posts') }}</a>


    @foreach ($post_type_taxonomy_terms as $post_type_taxonomy_term)
        <a class="nav-item nav-link @if (($menu_section ?? null) == $post_type_taxonomy_term->id) active @endif" href="{{ route('admin.post-taxonomies.index', ['id' => $post_type_taxonomy_term->id, 'type' => $post_type_taxonomy_term->post_type]) }}">
            @if ($post_type_taxonomy_term->hierarchical == 0)
            <i class="bi bi-tag"></i> @else<i class="bi bi-diagram-3"></i>
            @endif
            {{ __(json_decode($post_type_taxonomy_term->default_language_content->labels ?? null)->plural ?? __('All items')) }}
        </a>
    @endforeach
   
</nav>
