<link rel="stylesheet" href="{{ asset('assets/vendor/prism/prism.css') }}">
<link rel="stylesheet" href="{{ asset('assets/vendor/prism/prism-live.css') }}">

<div class="alert alert-info">
    {{ __('Note: HTML / CSS / JavaScript and template functions code allowed. Bootstrap 5 code is allowed.') }}
</div>

@foreach ($block->all_languages_contents as $lang_content)
    <div class="fw-bold mb-2">{!! lang_label($lang_content, __('Block content')) !!}</div>

    <textarea name="content_{{ $lang_content->lang_id }}" class="prism-live line-numbers language-html fill">{{ $lang_content->data->content ?? null }}</textarea>

    <div class="mb-4"></div>
@endforeach


<script src="{{ asset('assets/vendor/prism/prism.js') }}"></script>
<script src="{{ asset('assets/vendor/prism/prism-live.js') }}"></script>
