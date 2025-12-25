<?php
debug_backtrace() || die('Direct access not permitted');
?>
<div class="modal fade custom-modal" tabindex="-1" role="dialog" aria-labelledby="createLabel" aria-hidden="true" id="create-layout">
    <div class="modal-dialog">
        <div class="modal-content">

            <form method="post">
                @csrf

                <div class="modal-header">
                    <h5 class="modal-title" id="createLabel">{{ __('Create') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">

                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label>{{ __('Label') }}</label>
                                <input class="form-control" name="label" type="text" required />
                                <div class="text-muted small">{{ __('Give a name for this layout') }}</div>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="form-group mb-3">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="layout_top" name="has_top_section">
                                    <label class="form-check-label" for="layout_top">{{ __('Add top content') }}</label>
                                </div>
                                <div class="text-muted small">{{ __('Add content in the top of the page (full width)') }}</div>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="form-group mb-3">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="layout_bottom" name="has_bottom_section">
                                    <label class="form-check-label" for="layout_bottom">{{ __('Add bottom content') }}</label>
                                </div>
                                <div class="text-muted small">{{ __('Add content in the under the page content (full width)') }}</div>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="form-group mb-3">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="layout_sidebar" name="sidebar">
                                    <label class="form-check-label" for="layout_sidebar">{{ __('Add sidebar') }}</label>
                                </div>
                                <div class="text-muted small">{{ __('Add a sidebar (left or right)') }}</div>
                            </div>
                        </div>

                        <script>
                            $('#layout_sidebar').change(function() {
                                select = $(this).prop('checked');
                                if (select)
                                    document.getElementById('hidden_div_sidebar').style.display = 'block';
                                else
                                    document.getElementById('hidden_div_sidebar').style.display = 'none';
                            })
                        </script>

                        <div id="hidden_div_sidebar" style="display: none">
                            <div class="col-12 col-md-6">
                                <div class="form-group">
                                    <label>{{ __('Sidebar position') }}</label>
                                    <select name="sidebar_position" class="form-select">
                                        <option value="right">{{ __('Right sidebar') }}</option>
                                        <option value="left">{{ __('Left sidebar') }}</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="use_bg_color" name="use_bg_color">
                                    <label class="form-check-label" for="use_bg_color">{{ __('Set background color for this sidebar') }}</label>
                                </div>
                            </div>

                            <script>
                                $('#use_bg_color').change(function() {
                                    select = $(this).prop('checked');
                                    if (select)
                                        document.getElementById('hidden_div_bg_color').style.display = 'block';
                                    else
                                        document.getElementById('hidden_div_bg_color').style.display = 'none';
                                })
                            </script>

                            <div id="hidden_div_bg_color" style="display: none" class="mt-1">
                                <div class="form-group">
                                    <input class="form-control form-control-color" id="bg_color" name="bg_color" value="#f4f7f8">
                                    <label>{{ __('Background color') }}</label>
                                    <script>
                                        $('#bg_color').spectrum({
                                            type: "color",
                                            showInput: true,
                                            showInitial: true,
                                            showAlpha: false,
                                            showButtons: false,
                                            allowEmpty: false,
                                            appendTo: '#hidden_div_bg_color'
                                        });
                                    </script>
                                </div>
                            </div>

                        </div>

                    </div>

                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">{{ __('Create') }}</button>
                </div>

            </form>

        </div>
    </div>
</div>
