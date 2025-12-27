@switch($block->block_type->type)
    @case('accordion')
        @include('pivlu::web.blocks.accordion')
    @break

    @case('ads')
        @include('pivlu::web.blocks.ads')
    @break

    @case('alert')
        @include('pivlu::web.blocks.alert')
    @break

    @case('blockquote')
        @include('pivlu::web.blocks.blockquote')
    @break

    @case('custom')
        @include('pivlu::web.blocks.custom')
    @break

    @case('card')
        @include('pivlu::web.blocks.card')
    @break

    @case('text')
        @include('pivlu::web.blocks.text', ['is_layout' => $is_layout ?? 0])
    @break

    @case('editor')
        @include('pivlu::web.blocks.editor', ['is_layout' => $is_layout ?? 0])
    @break

    @case('form')
        <div class="container-xxl">
            @include('pivlu::web.blocks.form')
        </div>
    @break

    @case('gallery')
        <div class="@if (($module ?? null) == 'docs') @else container-xxl @endif">
            @include('pivlu::web.blocks.gallery')
        </div>
    @break

    @case('hero')
        @include('pivlu::web.blocks.hero')
    @break

    @case('image')
        <div class="@if (($module ?? null) == 'docs') @else container-xxl @endif">
            @include('pivlu::web.blocks.image')
        </div>
    @break

    @case('include')
        @if ($block_extra['file'] ?? null)
            @php
                $include_file = str_replace('.blade.php', '', $block_extra['file']);
            @endphp
            @include("pivlu::custom-files.{$include_file}")
        @endif
    @break

    @case('links')
        <div class="container-xxl">
            @include('pivlu::web.blocks.links')
        </div>
    @break

    @case('map')
        @include('pivlu::web.blocks.map')
    @break

    @case('posts')
        @include('pivlu::web.blocks.posts')
    @break

    @case('search')
        <div class="container-xxl">
            @include('pivlu::web.blocks.search')
        </div>
    @break

    @case('slider')
        @include('pivlu::web.blocks.slider')
    @break

    @case('spacer')
        @include('pivlu::web.blocks.spacer')
    @break

    @case('testimonial')
        <div class="container-xxl">
            @include('pivlu::web.blocks.testimonial')
        </div>
    @break

    @case('video')
        @include('pivlu::web.blocks.video')
    @break

@endswitch
