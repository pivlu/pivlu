<div class="alert alert-light">
    <i class="bi bi-exclamation-circle"></i> {{ __('Input custom template filename to be included (example: "my-custom-file.blade.php"). File must be located in: ') }}
    <strong>{{ resource_path('views/custom-files/' . $active_theme->vendor_name) }}/</strong>
</div>

@foreach ($block->all_languages_contents as $lang_content)
   <div class="fw-bold mb-2">{!! lang_label($lang_content, __('Filename')) !!}</div>

    <input name="tpl_file_{{ $lang_content->lang_id }}" class="form-control" value="{{ $lang_content->data->tpl_file ?? null }}">

    <div class="mb-4"></div>

    @if (count(admin_languages()) > 1 && !$loop->last)
        <hr>
    @endif
@endforeach
