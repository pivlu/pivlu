<option @if ($post_taxonomy->parent_id == $select_taxonomy->id) selected @endif value="{{ $select_taxonomy->id }}" @if ($post_taxonomy->id == $select_taxonomy->id) disabled @endif>
    @for ($i = 1; $i < $loop->depth; $i++)
        ---
    @endfor {{ $select_taxonomy->default_language_content->name ?? null }}
</option>


@if (count($select_taxonomy->children) > 0)

    @foreach ($select_taxonomy->children as $select_taxonomy)
        @include('admin.posts.includes.loops.taxonomies-edit-select-loop', $select_taxonomy)
    @endforeach

@endif
