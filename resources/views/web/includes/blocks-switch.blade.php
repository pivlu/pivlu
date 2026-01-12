@switch($block->block_type->type)
    @case('accordion')
        @include('pivlu::web.blocks.accordion')
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

    @case('editor')
        @include('pivlu::web.blocks.editor')
    @break

    @case('form')
        @include('pivlu::web.blocks.form')
    @break

    @case('gallery')
        @include('pivlu::web.blocks.gallery')
    @break

    @case('hero')
        @include('pivlu::web.blocks.hero')
    @break

    @case('image')
        @include('pivlu::web.blocks.image')
    @break

    @case('include')
        @if ($block_data->tpl_file ?? null)
            @php
                $include_file = str_replace('.blade.php', '', $block_data->tpl_file);
                if(! file_exists(resource_path('views/custom-files/' . $config->theme_vendor_name . '/' . $block_data->tpl_file))) {
                    break;
                }
            @endphp
            @include("custom-files.{$config->theme_vendor_name}.{$include_file}")
        @endif
    @break

    @case('links')
        @include('pivlu::web.blocks.links')
    @break

    @case('map')
        @include('pivlu::web.blocks.map')
    @break

    @case('posts')
        @include('pivlu::web.blocks.posts')
    @break

    @case('search')
        @include('pivlu::web.blocks.search')
    @break

    @case('slider')
        @include('pivlu::web.blocks.slider')
    @break

    @case('spacer')
        @include('pivlu::web.blocks.spacer')
    @break

    @case('testimonial')
        @include('pivlu::web.blocks.testimonial')
    @break

    @case('video')
        @include('pivlu::web.blocks.video')
    @break    
@endswitch
