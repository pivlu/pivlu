@php
    $block_data = block($block['id']);
    $block_header = unserialize($block_data->header ?? null);
@endphp

@switch($block['type'])
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

    @case('editor')
        <div class="container-xxl">
            @include('web.blocks.editor')
        </div>
    @break

    @case('gallery')
        <div class="container-xxl">
            @include('web.blocks.gallery')
        </div>
    @break

    @case('hero')
        @include('web.blocks.hero')
    @break

    @case('image')
        <div class="container-xxl">
            @include('web.blocks.image')
        </div>
    @break

    @case('include')
        @if ($block_settings['file'] ?? null)
            @php
                $include_file = str_replace('.blade.php', '', $block_settings['file']);
            @endphp
            @include("custom-files.{$include_file}")
        @endif
    @break

    @case('map')
        @include('web.blocks.map')
    @break

    @case('slider')
        @include('web.blocks.slider')
    @break

    @case('video')
        @include('web.blocks.video')
    @break

@endswitch
