@php
    $block_data = block($block->id);
    $block_content = unserialize($block_data->content ?? null);
    $block_content = (object) $block_content;
@endphp

@if ($block_data->content ?? null)
    <div class="@if(($module ?? null) == 'docs') @else container-xxl @endif">
        <div class="block">

            @if ($session_msg = Session::get('error'))
                <div class="alert alert-danger my-3">
                    @if ($session_msg == 'login_required')
                        {{ __('Error. You must be logged to download this file.') }}
                    @endif
                    @if ($session_msg == 'verify_email_required')
                        {{ __('Error. You must verify your email before download this file.') }}
                    @endif
                    @if ($session_msg == 'no_file')
                        {{ __('Error. This file is not valid.') }}
                    @endif
                </div>
            @endif

            @if ($session_msg = Session::get('success'))
                <div class="alert alert-success my-3">
                    @if ($session_msg == 'downloaded')
                        {{ __('File downloaded.') }}
                    @endif
                </div>
            @endif

            <div class="block-content">{!! $block_content->content !!}</div>

            <div class="caption">
                @if ($block_data->block_extra->version ?? null)
                    <b>{{ 'Version' }}</b> {{ $block_data->block_extra->version }}
                @endif

                @if ($block_data->block_extra->release_date ?? null)
                    <div class="mb-2"></div><b>{{ 'Release date' }}</b> {{ date_locale($block_data->block_extra->release_date) }}
                @endif
            </div>

            @if (($block_data->block_extra->file ?? null) && ($block_data->block_extra->hash ?? null))
                <span class="btn_{{ $block_data->block_extra->download_btn_id ?? null }}"><a href="{{ route('block.download', ['id' => $block->id, 'hash' => $block_data->block_extra->hash]) }}"
                    class="btn {{ $block_data->block_extra->download_btn_id ? 'btn_' . $block_data->block_extra->download_btn_id : 'btn-primary' }}"><i class="bi bi-download"></i> {{ __('Download file') }}</a></span>
            @endif

        </div>
    </div>
@endif
