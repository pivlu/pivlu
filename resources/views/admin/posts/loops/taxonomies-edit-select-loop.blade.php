<option @if ($item->parent_id > 0) @if ($item->parent_id == $taxonomy_item->id) selected @endif @endif value="{{ $taxonomy_item->id }}" @if ($item->id == $taxonomy_item->id) disabled @endif>
    @for ($i = 1; $i < $loop->depth; $i++)
        ---
    @endfor {{ $taxonomy_item->default_language_content->name }}
</option>


@if (count($taxonomy_item->children) > 0)

    @foreach ($taxonomy_item->children as $taxonomy_item)
        @include('admin.posts.loops.taxonomies-edit-select-loop', $taxonomy_item)
    @endforeach

@endif
