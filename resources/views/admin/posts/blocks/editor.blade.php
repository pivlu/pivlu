<h5 class="mb-3">{{ __('Block content') }}:</h5>

@foreach ($content_langs as $lang)
    @if (count($languages) > 1)
        <h5 class="mb-3">{!! flag($lang->code) !!} {{ $lang->name }}</h5>
    @endif

    <div class="form-group">
        <textarea class="trumbowyg" name="content_{{ $lang->id }}">{{ $lang->block_content ?? null }}</textarea>
    </div>

    <div class="mb-4"></div>

    @if (count($languages) > 1 && !$loop->last)
        <hr>
    @endif
@endforeach
