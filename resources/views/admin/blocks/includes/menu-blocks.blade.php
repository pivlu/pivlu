<nav class="nav nav-tabs mb-2" id="myTab" role="tablist">
    {{--
    <a class="nav-item nav-link"
        href="{{ route('admin.block-components') }}"><i class="bi bi-bounding-box"></i> {{ __('Summary') }}</a>
    --}}

    <a class="nav-item nav-link @if (($type ?? null) == 'form') active @endif"
        href="{{ route('admin.block-components.type', ['type' => 'form']) }}"><i class="bi bi-textarea-resize"></i>
        {{ __('Forms') }}</a>

    <a class="nav-item nav-link @if (($type ?? null) == 'gallery') active @endif"
        href="{{ route('admin.block-components.type', ['type' => 'gallery']) }}"><i class="bi bi-images"></i>
        {{ __('Galleries') }}</a>

    <a class="nav-item nav-link @if (($type ?? null) == 'slider') active @endif"
        href="{{ route('admin.block-components.type', ['type' => 'slider']) }}"><i class="bi bi-collection"></i>
        {{ __('Sliders') }}</a>

    <a class="nav-item nav-link @if (($type ?? null) == 'hero') active @endif"
        href="{{ route('admin.block-components.type', ['type' => 'hero']) }}"><i class="bi bi-card-heading"></i>
        {{ __('Heros') }}</a>
</nav>