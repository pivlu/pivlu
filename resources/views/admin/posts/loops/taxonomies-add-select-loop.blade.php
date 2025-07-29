<option value="{{ $taxonomy_item->id }}">@for ($i = 1; $i < $loop->depth; $i++)---@endfor {{ $taxonomy_item->default_language_content->name }}</option>


@if (count($taxonomy_item->children) > 0)

	@foreach($taxonomy_item->children as $taxonomy_item)	
	@include('admin.posts.loops.taxonomies-add-select-loop', $taxonomy_item)
	@endforeach

@endif
