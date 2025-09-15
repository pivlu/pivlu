@switch($block->type)
    @case('alert')
        @include('web.includes.blocks.alert')
    @break

    @case('blockquote')
        @include('web.includes.blocks.blockquote')
    @break

    @case('custom')
        @include('web.includes.blocks.custom')
    @break

    @case('card')
        @include('web.includes.blocks.card')
    @break

    @case('editor')
        <div class="container-xxl">
            @include('web.includes.blocks.editor')
        </div>
    @break

    @case('form')
        <div class="container-xxl">
            <div class="block">
                @include('web.includes.block-header')
                @include('web.includes.blocks.form')
            </div>
        </div>
    @break

    @case('gallery')
        <div class="container-xxl">
            <div class="block text-center">
                @include('web.includes.block-header')
                @include('web.includes.blocks.gallery')
            </div>
        </div>
    @break

    @case('hero')
        @include('web.includes.blocks.hero')
    @break

    @case('image')
        <div class="container-xxl">
            @include('web.includes.blocks.image')
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
        @include('web.includes.blocks.map')
    @break

    @case('slider')
        @include('web.includes.blocks.slider')
    @break

    @case('video')
        @include('web.includes.blocks.video')
    @break

    @case('post_section')
        <div class="container-xxl">
            @include('web.includes.blocks.post_section')
        </div>
    @break

    @case('post_toc')
        <div class="container-xxl">
            @include('web.includes.blocks.post_toc')
        </div>
    @break

@endswitch
