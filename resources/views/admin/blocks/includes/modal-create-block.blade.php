<?php
debug_backtrace() || die('Direct access not permitted');
?>
<div class="modal fade custom-modal" tabindex="-1" role="dialog" aria-labelledby="createLabel" aria-hidden="true" id="create-block">
    <div class="modal-dialog">
        <div class="modal-content">

            <form method="post">
                @csrf

                <div class="modal-header">
                    <h5 class="modal-title" id="createLabel">{{ __('Create new block') }} ({{ $type }})</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">

                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label>{{ __('Label') }}</label>
                                <input class="form-control" name="label" type="text" required />
                                <div class="form-text">{{ __('Input a label to identify this block. Label is not visible in website') }}</div>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="form-group mb-0 mt-3">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="SwitchActive" name="active" checked>
                                    <label class="form-check-label" for="SwitchActive">{{ __('Active') }}</label>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>

                <div class="modal-footer">
                    <input type="hidden" name="type" value="{{ $type }}">
                    <button type="submit" class="btn btn-primary">{{ __('Create new block') }}</button>
                </div>

            </form>

        </div>
    </div>
</div>
