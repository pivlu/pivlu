<?php
debug_backtrace() || die('Direct access not permitted');
?>
<div class="modal fade custom-modal" tabindex="-1" role="dialog" aria-hidden="true" aria-labelledby="addBlockLabel{{ $col ?? null }}" id="addBlock{{ $col ?? null }}">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            
            <form method="post" action="{{ route('admin.theme-footers.content', ['id' => $footer->id, 'destination' => $destination, 'col' => $col]) }}">
                @csrf

                <div class="modal-header">
                    <h5 class="modal-title" aria-labelledby="addBlockLabel{{ $col ?? null }}">{{ __('Add block') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <p><b>{{ __('Click to add a block') }}</b>. {{ __('You can manage block content and settings at the next step') }}</p>

                    <div class="row">
                        @foreach ($block_types as $block_type)
                            <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 col-12 mb-4">
                                <input type="radio" name="type_id" class="radio input-hidden" id="block_{{ $col }}_{{ $block_type->id }}" value="{{ $block_type->id }}" required />
                                <label for="block_{{ $col }}_{{ $block_type->id }}">
                                    <div class='text-center'>
                                        <div class="fs-1">{!! $block_type->icon !!}</div>
                                        <div class="mb-2">
                                            {{ $block_type->label }}
                                        </div>
                                    </div>
                                </label>
                            </div>
                        @endforeach
                    </div>

                </div>

                <div class="modal-footer">
                    <input type="hidden" name="destination" value="{{ $destination ?? 'primary' }}">
                    <input type="hidden" name="col" value="{{ $col ?? null }}">
                    <input type="hidden" name="id" value="{{ $footer->id }}">
                    <button type="submit" class="btn btn-primary">{{ __('Add block') }}</button>
                </div>

            </form>

        </div>

    </div>

</div>
