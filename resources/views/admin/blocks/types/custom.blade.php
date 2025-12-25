<link rel="stylesheet" href="{{ asset('assets/vendor/prism/prism.css') }}">
<link rel="stylesheet" href="{{ asset('assets/vendor/prism/prism-live.css') }}">

<h5 class="mb-3">{{ __('Block content') }}:</h5>

<div class="alert alert-info">
    {{ __('Note: HTML / CSS / JavaScript and template functions code allowed. Bootstrap 5 code is allowed.') }}
</div>

@foreach ($block->all_languages_contents as $lang_content)
    @if (count(admin_languages()) > 1)
        <div class="fw-bold fs-5">{!! flag($lang_content->lang_code, 'circle') !!} {{ $lang_content->lang_name }}</div>
    @endif

    
    <textarea name="content_{{ $lang_content->lang_id }}" class="prism-live line-numbers language-html fill">{{ $lang_content->content }}</textarea>

    <div class="mb-4"></div>

    @if (count(admin_languages()) > 1 && !$loop->last)
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
