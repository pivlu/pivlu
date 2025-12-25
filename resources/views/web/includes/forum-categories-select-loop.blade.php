<option @if ($categ->allow_topics == 0) disabled @endif @if($categ_id == $categ->id) selected @endif value="{{ $categ->id }}">
    @for ($i = 1; $i < $loop->depth; $i++)---@endfor {{ $categ->title }}
</option>

@if (count($categ->children) > 0)

    @foreach ($categ->children as $categ)
        @include("web.includes.forum-categories-select-loop", $categ)
    @endforeach

@endif
