<option value="{{ $post_taxonomy_item->id }}">@for ($i = 1; $i < $loop->depth; $i++)---@endfor {{ $post_type_taxonomy->default_language_content->name }}</option>


@if (count($post_taxonomy_item->children) > 0)

	@foreach($post_taxonomy_item->children as $post_taxonomy_item)	
	@include('admin.posts.includes.loops.taxonomies-add-select-loop', $post_taxonomy_item)
	@endforeach

@endif
