@php
    $css_item_margin = 0;
    if ($loop->depth == 2) {
        $css_item_margin = 0;
    } elseif ($loop->depth == 3) {
        $css_item_margin = 20;
    } elseif ($loop->depth == 4) {
        $css_item_margin = 40;
    } elseif ($loop->depth == 5) {
        $css_item_margin = 60;
    } else {
        $css_item_margin = 80;
    }
@endphp

<div class="form-group mb-0">    
    <div class="form-check" style="margin-left: {{ $css_item_margin }}px;">
        <input class="form-check-input checkbox-{{ $taxonomy_term->id }}" data-target="#main-taxonomy-{{ $taxonomy_item->id }}" type="checkbox" id="customSwitch-{{ $taxonomy_item->id }}" name="taxonomies[]"
            value="{{ $taxonomy_item->id }}">
        <label class="form-check-label" for="customSwitch-{{ $taxonomy_item->id }}">{{ $taxonomy_item->default_language_content->name }}</label>
    </div>

</div>


@if (count($taxonomy_item->children) > 0)
    @foreach ($taxonomy_item->children as $taxonomy_item)
        @include('admin.posts.includes.loops.create-post-taxonomies-loop-checkboxes', $taxonomy_item)
    @endforeach
@endif
