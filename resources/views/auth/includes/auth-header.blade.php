{{-- Pivlu CE | Copyright (c) Iosif Gabriel Chimilevschi | AGPL-3.0 License | https://pivlu.com --}}
<div class="col-md-6 offset-md-3">
    <div class="d-flex align-items-center justify-content-between mb-3 mt-3">
        <a href="/">
            <span style="font-size: 1.5rem; font-weight: 700; color: #1e293b; text-decoration: none;">{{ config('app.name', 'Pivlu') }}</span>
        </a>
        @if (isset($supportedLanguages) && count($supportedLanguages) > 1)
            <div class="dropdown">
                <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="bi bi-globe2 me-1"></i>
                    {{ $supportedLanguages[$lang ?? 'en']['native'] ?? 'English' }}
                </button>
                <ul class="dropdown-menu dropdown-menu-end">
                    @foreach ($supportedLanguages as $code => $language)
                        <li>
                            <a class="dropdown-item {{ ($lang ?? 'en') === $code ? 'active' : '' }}"
                               href="{{ request()->fullUrlWithQuery(['lang' => $code]) }}">
                                {{ $language['native'] }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>
</div>
