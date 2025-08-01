<option @if ($post_taxonomy->parent_id > 0) @if ($post_taxonomy->parent_id == $taxonomy_term->id) selected @endif @endif value="{{ $taxonomy_term->id }}" @if ($post_taxonomy->id == $taxonomy_term->id) disabled @endif>
    @for ($i = 1; $i < $loop->depth; $i++)
        ---
    @endfor {{ $taxonomy_term->default_language_content->name }}
</option>


@if (count($post_taxonomy->children) > 0)

    @foreach ($post_taxonomy->children as $taxonomy_term)
        @include('admin.posts.loops.taxonomies-edit-select-loop', $taxonomy_term)
    @endforeach

@endif
