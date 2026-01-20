@php
    $form_settings = json_decode($item->settings, true) ?? [];
    $form_min_width = isset($form_settings['search_input_min_width']) ? $form_settings['search_input_min_width'] . 'px !important' : null;
@endphp

@if ($form_min_width ?? null)
    <style>
        @media (min-width: 768px) {
            .form-control-item-{{ $item->id }} {
                min-width: {{ $form_min_width }}
            }
        }
    </style>
@endif

<form class="d-flex" role="search" method="GET" action="{{ route('search', ['lang' => get_route_lang()]) }}">
    <div class="input-group @if (($form_settings->search_input_size ?? null) == 'large') input-group-lg @endif @if (($form_settings->search_input_size ?? null) == 'small') input-group-sm @endif">
        <input class="form-control form-control-item-{{ $item->id }}" type="text" placeholder="{{ $item->activeLanguageContentData['search_placeholder_text'] ?? __('Search') }}" aria-label="Search"
            aria-describedby="search-addon-{{ $item->id }}" id="search-input-{{ $item->id }}" name="s" />
        @if ($form_settings->use_icon ?? null)
            <button class="btn btn-light" type="submit" id="search-addon-{{ $item->id }}">
                <i class="{{ $form_settings->icon_class ?? 'bi bi-search' }}"></i>
            </button>
        @else
            <button class="btn btn-light" type="submit" id="search-addon-{{ $item->id }}">{{ $item->activeLanguageContentData['search_button_text'] ?? __('Search') }}</button>
        @endif
    </div>
</form>
