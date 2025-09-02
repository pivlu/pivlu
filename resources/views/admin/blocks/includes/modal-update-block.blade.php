<?php
debug_backtrace() || die('Direct access not permitted');
?>
<div class="modal fade custom-modal" tabindex="-1" role="dialog" aria-labelledby="updateLabel{{ $item->id }}"
    aria-hidden="true" id="update-block-{{ $item->id }}">
    <div class="modal-dialog">
        <div class="modal-content">

            <form method="post"
                action="{{ route('admin.block-components.block.update', ['type' => $item->type, 'id' => $item->id]) }}">
                @csrf
                @method('PUT')

                <div class="modal-header">
                    <h5 class="modal-title" id="updateLabel{{ $item->id }}">{{ __('Update block') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">

                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label>{{ __('Label') }}</label>
                                <input class="form-control" name="label" type="text" value="{{ $item->label }}"
                                    required />
                                <div class="form-text">
                                    {{ __('Input a label to identify this block. Label is not visible in website') }}
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="form-group mb-0 mt-3">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="customSwitch_{{ $item->id }}"
                                        name="active" @if ($item->active) checked @endif>
                                    <label class="form-check-label"
                                        for="customSwitch_{{ $item->id }}">{{ __('Active') }}</label>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">{{ __('Update block') }}</button>
                </div>

            </form>

        </div>
    </div>
</div>