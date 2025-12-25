<nav class="nav nav-tabs mb-3" id="myTab" role="tablist">
    <a class="nav-item nav-link @if (($post_menu_tab ?? null) == 'details') active @endif" href="{{ route('admin.posts.show', ['id' => $post->id]) }}"><i class="bi bi-pencil-square"></i>
        {{ __(json_decode($post_type->default_language_content->labels ?? null)->singular ?? $post_type->name) }} {{ __('details') }}
    </a>
    <a class="nav-item nav-link @if (($post_menu_tab ?? null) == 'content') active @endif" href="{{ route('admin.posts.content', ['id' => $post->id]) }}"><i class="bi bi-card-text"></i>
        {{ __(json_decode($post_type->default_language_content->labels ?? null)->singular ?? $post_type->name) }} {{ __('content') }}
    </a>
</nav>
