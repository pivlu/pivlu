<h5 class="mb-3">{{ __('Block content') }}:</h5>

<div class="alert alert-light">
    <i class="bi bi-exclamation-circle"></i> {{ __('Input custom template filename to be included (example: "my-custom-file.blade.php"). File must be located in active template folder') }}
</div>

@foreach ($block->all_languages_contents as $lang_content)
    @if (count(admin_languages()) > 1)
        <div class="fw-bold fs-5">{!! flag($lang_content->lang_code, 'circle') !!} {{ $lang_content->lang_name }}</div>
    @endif

    @php
        $block_content = json_decode($lang_content->content);
    @endphp

    <input name="tpl_file_{{ $lang_content->lang_id }}" class="form-control" value="{{ $block_content->tpl_file ?? null }}">

    <div class="mb-4"></div>

    @if (count(admin_languages()) > 1 && !$loop->last)
        <hr>
    @endif
@endforeach
