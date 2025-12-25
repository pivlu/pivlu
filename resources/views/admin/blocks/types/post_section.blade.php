<h5 class="mb-3">{{ __('Section settings') }}:</h5>


@foreach ($content_langs as $lang)
    @if (count($languages) > 1)
        <h5 class="mb-3">{!! flag($lang->code) !!} {{ $lang->name }}</h5>
    @endif

    @php
        $block_content = json_decode($lang->block_content);
    @endphp

    <div class="form-group">
        <label>{{ __('Section title') }}</label>
        <input class="form-control" type="text" name="title_{{ $lang->id }}" value="{{ $block_content->title ?? null }}">
    </div>

    <div class="form-group">
        <label>{{ __('URL slug') }}</label>
        <input class="form-control" type="text" name="slug_{{ $lang->id }}" value="{{ $block_content->slug ?? null }}">
    </div>

    <div class="mb-4"></div>

    @if (count($content_langs) > 1 && !$loop->last)
        <hr>
    @endif
@endforeach
