<link rel="stylesheet" href="{{ asset('assets/vendor/prism/prism.css') }}">
<link rel="stylesheet" href="{{ asset('assets/vendor/prism/prism-live.css') }}">

<h5 class="mb-3">{{ __('Block content') }}:</h5>

<div class="alert alert-info">
    {{ __('Warning: HTML / CSS / JavaScript and tamplate functions code allowed. Bootstrap 5 code is allowed.') }}
</div>

@foreach ($content_langs as $lang)
    @if (count($languages) > 1)
        <h5 class="mb-3">{!! flag($lang->code) !!} {{ $lang->name }}</h5>
    @endif

    <textarea name="content_{{ $lang->id }}" class="prism-live line-numbers language-html fill">{{ $lang->block_content }}</textarea>

    <div class="mb-4"></div>
    
    @if (count($languages) > 1 && !$loop->last)
        <hr>
    @endif
@endforeach


<script src="{{ asset('assets/vendor/prism/bliss.shy.min.js') }}"></script>
<script src="{{ asset('assets/vendor/prism/prism.js') }}"></script>
<script src="{{ asset('assets/vendor/prism/prism-line-numbers.js') }}"></script>
<script src="{{ asset('assets/vendor/prism/prism-live.js') }}"></script>
<script src="{{ asset('assets/vendor/prism/prism-live-markup.js') }}"></script>
<script src="{{ asset('assets/vendor/prism/prism-live-css.js') }}"></script>
<script src="{{ asset('assets/vendor/prism/prism-live-javascript.js') }}"></script>
