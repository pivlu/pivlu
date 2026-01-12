@if ($block_settings->address ?? null)
    <div class="block p-0 text-center">

        @include('pivlu::web.includes.block-header')

        <!-- Map Section -->
        <div class="maparea">
            <iframe style="width: 100%" height="{{ $block_settings->height ?? 400 }}"
                src="https://maps.google.com/maps?height=400&amp;hl=en&amp;q={{ $block_settings->address }}&amp;ie=UTF8&amp;t=&amp;z={{ $block_settings->zoom ?? 10 }}&amp;iwloc=B&amp;output=embed"></iframe>
        </div>
        <!-- End Map Section -->
    </div>
@endif
