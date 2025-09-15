@if ($block_settings['address'] ?? null)
    
    <div class="block p-0 text-center">

        @if ($block_header['add_header'] ?? null)
            <div class="block-header mt-3">
                @if ($block_header['title'] ?? null)
                    <div class="block-header-title title">
                        {{ $block_header['title'] ?? null }}
                    </div>
                @endif

                @if ($block_header['content'] ?? null)
                    <div class="block-header-content mt-3">
                        {!! $block_header['content'] ?? null !!}
                    </div>
                @endif
            </div>
        @endif

        <!-- Map Section -->
        <div class="maparea">
            <iframe style="width: 100%" height="{{ $block_settings['height'] }}"
                src="https://maps.google.com/maps?height=400&amp;hl=en&amp;q={{ $block_settings['address'] }}&amp;ie=UTF8&amp;t=&amp;z={{ $block_settings['zoom'] }}&amp;iwloc=B&amp;output=embed"></iframe>
        </div>
        <!-- End Map Section -->
    </div>
@endif
