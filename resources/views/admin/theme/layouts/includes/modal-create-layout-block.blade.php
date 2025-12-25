<?php
debug_backtrace() || die('Direct access not permitted');
?>
<div class="modal fade custom-modal" tabindex="-1" role="dialog" aria-hidden="true" aria-labelledby="addBlockLabel-{{ $section ?? null }}" id="addBlock-{{ $section ?? null }}">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">

            <form method="post" action="{{ route('admin.theme.layouts.content', ['id' => $item->id, 'section' => $section]) }}">
                @csrf

                <div class="modal-header">
                    <h5 class="modal-title" aria-labelledby="addBlockLabel-{{ $section ?? null }}">{{ __('Add block') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">                    
                    <p><b>{{ __('Click to add a block') }}</b>. {{ __('You can manage block content and settings at the next step') }}</p>

                    <div class="row">
                        @foreach ($block_types as $key => $type)
                            <div class="col-xl-2 col-lg-3 col-md-3 col-sm-6 col-12 mb-4">
                                <input type="radio" name="type" class="radio input-hidden" id="block_{{ $key }}_{{ $col ?? null }}_{{ $section ?? null }}" value="{{ $key }}" required />
                                <label for="block_{{ $key }}_{{ $col ?? null }}_{{ $section ?? null }}">
                                    <div class='text-center'>
                                        <div class="fs-1">{!! $type['icon'] !!}</div>
                                        <div class="mb-2">
                                            {{ $type['label'] }}
                                        </div>
                                    </div>
                                </label>
                            </div>
                        @endforeach
                    </div>

                </div>

                <div class="modal-footer">
                    <input type="hidden" name="id" value="{{ $item->id ?? null }}">
                    <input type="hidden" name="section" value="{{ $section ?? null }}">
                    <button type="submit" class="btn btn-primary">{{ __('Add block') }}</button>
                </div>

            </form>

        </div>

    </div>

</div>
