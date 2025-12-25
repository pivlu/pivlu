<?php
debug_backtrace() || die('Direct access not permitted');
?>
<div class="modal fade custom-modal" tabindex="-1" role="dialog" aria-labelledby="createLabel" aria-hidden="true" id="create-footer">
    <div class="modal-dialog">
        <div class="modal-content">

            <form method="post">
                @csrf

                <div class="modal-header">
                    <h5 class="modal-title" id="createLabel">{{ __('Create footer') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">

                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label>{{ __('Label') }}</label>
                                <input class="form-control" name="label" type="text" required />
                            </div>

                            <div class="form-group">
                                <label>{{ __('Primary footer layout') }}</label>
                                <select class="form-select" name="footer_columns">
                                    <option value="1">{{ __('One column') }}</option>
                                    <option value="2">{{ __('Two columns') }}</option>
                                    <option value="3">{{ __('Three columns') }}</option>
                                    <option value="4">{{ __('Four columns') }}</option>
                                </select>
                                <div class="text-muted small">{{ __('Select number of columns for primary footer') }}</div>
                            </div>

                            <div class="form-group mb-3">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="footer2_show" name="footer2_show">
                                    <label class="form-check-label" for="footer2_show">{{ __('Show secondary footer') }}</label>
                                </div>
                                <div class="text-muted small">{{ __('This footer is below the main footer') }}</div>
                            </div>

                            <script>
                                $('#footer2_show').change(function() {
                                    select = $(this).prop('checked');
                                    if (select)
                                        document.getElementById('hidden_div_footer2').style.display = 'block';
                                    else
                                        document.getElementById('hidden_div_footer2').style.display = 'none';
                                })
                            </script>

                            <div id="hidden_div_footer2" style="display: none">
                                <div class="form-group">
                                    <label>{{ __('Secondary footer layout') }}</label>
                                    <select class="form-select" name="footer2_columns">
                                        <option value="1">{{ __('One column') }}</option>
                                        <option value="2">{{ __('Two columns') }}</option>
                                        <option value="3">{{ __('Three columns') }}</option>
                                        <option value="4">{{ __('Four columns') }}</option>
                                    </select>
                                    <div class="text-muted small">{{ __('Select number of columns for secondary footer') }}</div>
                                </div>
                            </div>


                            <div class="form-group mb-3">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="is_default_footer" name="is_default_footer">
                                    <label class="form-check-label" for="is_default_footer">{{ __('Default footer') }}</label>
                                </div>
                            </div>

                        </div>

                    </div>

                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">{{ __('Create footer') }}</button>
                </div>

            </form>

        </div>
    </div>
</div>
