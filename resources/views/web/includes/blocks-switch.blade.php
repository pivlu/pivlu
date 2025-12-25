@switch($block->block_type->type)
    @case('accordion')
        @include('web.blocks.accordion')
    @break

    @case('ads')
        @include('web.blocks.ads')
    @break

    @case('alert')
        @include('web.blocks.alert')
    @break

    @case('blockquote')
        @include('web.blocks.blockquote')
    @break

    @case('custom')
        @include('web.blocks.custom')
    @break

    @case('card')
        @include('web.blocks.card')
    @break

    @case('text')
        @include('web.blocks.text', ['is_layout' => $is_layout ?? 0])
    @break

    @case('editor')
        @include('web.blocks.editor', ['is_layout' => $is_layout ?? 0])
    @break

    @case('form')
        <div class="container-xxl">
            @include('web.blocks.form')
        </div>
    @break

    @case('gallery')
        <div class="@if (($module ?? null) == 'docs') @else container-xxl @endif">
            @include('web.blocks.gallery')
        </div>
    @break

    @case('hero')
        @include('web.blocks.hero')
    @break

    @case('image')
        <div class="@if (($module ?? null) == 'docs') @else container-xxl @endif">
            @include('web.blocks.image')
        </div>
    @break

    @case('include')
        @if ($block_extra['file'] ?? null)
            @php
                $include_file = str_replace('.blade.php', '', $block_extra['file']);
            @endphp
            @include("custom-files.{$include_file}")
        @endif
    @break

    @case('links')
        <div class="container-xxl">
            @include('web.blocks.links')
        </div>
    @break

    @case('map')
        @include('web.blocks.map')
    @break

    @case('posts')
        @include('web.blocks.posts')
    @break

    @case('search')
        <div class="container-xxl">
            @include('web.blocks.search')
        </div>
    @break

    @case('slider')
        @include('web.blocks.slider')
    @break

    @case('spacer')
        @include('web.blocks.spacer')
    @break

    @case('testimonial')
        <div class="container-xxl">
            @include('web.blocks.testimonial')
        </div>
    @break

    @case('video')
        @include('web.blocks.video')
    @break

@endswitch
