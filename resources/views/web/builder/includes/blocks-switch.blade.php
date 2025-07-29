@switch($block['type'])
    @case('accordion')
        @include('web.builder.blocks.accordion')
    @break

    @case('ads')
        @include('web.builder.blocks.ads')
    @break

    @case('alert')
        @include('web.builder.blocks.alert')
    @break

    @case('blockquote')
        @include('web.builder.blocks.blockquote')
    @break

    @case('custom')
        @include('web.builder.blocks.custom')
    @break

    @case('card')
        @include('web.builder.blocks.card')
    @break

    @case('download')
        @include('web.builder.blocks.download')
    @break

    @case('text')
        <div class="@if (($module ?? null) == 'docs') @else @if ($page->container_fluid ?? null) container-fluid @else container-xxl @endif @endif">
            @include('web.builder.blocks.text', ['is_layout' => $is_layout ?? 0])
        </div>
    @break

    @case('editor')
        <div class="@if (($module ?? null) == 'docs') @else @if ($page->container_fluid ?? null) container-fluid @else container-xxl @endif @endif">
            @include('web.builder.blocks.editor', ['is_layout' => $is_layout ?? 0])
        </div>
    @break

    @case('form')
        <div class="container-xxl">
            @include('web.builder.blocks.form')
        </div>
    @break

    @case('gallery')
        <div class="@if (($module ?? null) == 'docs') @else container-xxl @endif">
            @include('web.builder.blocks.gallery')
        </div>
    @break

    @case('hero')
        @include('web.builder.blocks.hero')
    @break

    @case('image')
        <div class="@if (($module ?? null) == 'docs') @else container-xxl @endif">
            @include('web.builder.blocks.image')
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
            @include('web.builder.blocks.links')
        </div>
    @break

    @case('map')
        @include('web.builder.blocks.map')
    @break

    @case('posts')
        @include('web.builder.blocks.posts')
    @break

    @case('search')
        <div class="container-xxl">
            @include('web.builder.blocks.search')
        </div>
    @break

    @case('slider')
        @include('web.builder.blocks.slider')
    @break

    @case('spacer')
        @include('web.builder.blocks.spacer')
    @break

    @case('testimonial')
        <div class="container-xxl">
            @include('web.builder.blocks.testimonial')
        </div>
    @break

    @case('video')
        @include('web.builder.blocks.video')
    @break
@endswitch
