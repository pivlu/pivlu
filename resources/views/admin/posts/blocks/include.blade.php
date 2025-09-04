<div class="form-group mb-3">
    <div class="form-check form-switch">
        <input class="form-check-input" type="checkbox" id="use_custom_bg" name="use_custom_bg" @if ($block_settings['bg_color'] ?? null) checked @endif>
        <label class="form-check-label" for="use_custom_bg">{{ __('Use custom background color for this section') }}</label>
    </div>
    <div class="form-text">{{ __('This is the color of the section row (full width). If disabled, default website background color will be used.') }}</div>
</div>

<script>
    $('#use_custom_bg').change(function() {
        select = $(this).prop('checked');
        if (select)
            document.getElementById('hidden_div_color').style.display = 'block';
        else
            document.getElementById('hidden_div_color').style.display = 'none';
    })
</script>

<div id="hidden_div_color" style="display: @if (isset($block_settings['bg_color'])) block @else none @endif" class="mt-2">
    <div class="form-group">
        <input class="form-control form-control-color" id="bg_color" name="bg_color" value="@if (isset($block_settings['bg_color'])) {{ $block_settings['bg_color'] }} @else #fbf7f0 @endif">
        <label>{{ __('Background color') }}</label>
        <script>
            $('#bg_color').spectrum({
                type: "color",
                showInput: true,
                showInitial: true,
                showAlpha: false,
                showButtons: false,
                allowEmpty: false,
            });
        </script>
    </div>
</div>
</div>

<h5 class="mb-3">{{ __('Block content') }}:</h5>

<div class="alert alert-light">
    <i class="bi bi-exclamation-circle"></i> {{ __('Input custom template filename to be included (example: "my-custom-file.blade.php"). File must be located in active template folder') }}
</div>

@foreach ($languages as $lang)
    @if (count($languages) > 1)
        <h5 class="mb-3">{!! flag($lang->code) !!} {{ $lang->name }}</h5>
    @endif

    @php
        $content_array = unserialize($lang->block_content);
    @endphp

    <input name="tpl_file_{{ $lang->id }}" class="form-control" value="{{ $content_array['tpl_file'] ?? null }}">

    <div class="mb-4"></div>

    @if (count($languages) > 1 && !$loop->last)
        <hr>
    @endif
@endforeach
