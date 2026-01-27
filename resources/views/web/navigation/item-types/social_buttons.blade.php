@php
    $social_buttons = json_decode($item->settings) ?? [];
@endphp

@if (count($social_buttons) > 0)
    @foreach ($social_buttons as $social_button)
        <li class="nav-item">
            <a target="_blank" href="{{ $social_button->url ?? '#' }}" class="nav-link no-decoration">
                @if ($social_button->icon)
                    {!! $social_button->icon !!}
                @else
                    <i class="bi bi-link"></i>
                @endif
                {{ $social_button->name ?? null }}
            </a>
        </li>
    @endforeach

@endif
