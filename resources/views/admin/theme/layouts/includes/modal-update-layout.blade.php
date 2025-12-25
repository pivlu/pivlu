<?php
debug_backtrace() || die('Direct access not permitted');
?>
<div class="modal fade custom-modal" tabindex="-1" role="dialog" aria-labelledby="updateLabel-{{ $layout->id }}" aria-hidden="true" id="update-{{ $layout->id }}">
    <div class="modal-dialog">
        <div class="modal-content">

            <form method="post" action="{{ route('admin.theme.layouts.show', ['id' => $layout->id]) }}">
                @method('PUT')
                @csrf

                <div class="modal-header">
                    <h5 class="modal-title" id="updateLabel-{{ $layout->id }}">{{ __('Update') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">

                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label>{{ __('Label') }}</label>
                                <input class="form-control" name="label" type="text" required value="{{ $layout->label }}" />
                                <div class="text-muted small">{{ __('Give a name for this layout') }}</div>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="form-group mb-3">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="layout_top_{{ $layout->id }}" name="has_top_section" @if ($layout->has_top_section) checked @endif>
                                    <label class="form-check-label" for="layout_top_{{ $layout->id }}">{{ __('Add top content') }}</label>
                                </div>
                                <div class="text-muted small">{{ __('Add content in the top of the page (full width)') }}</div>
                            </div>
                        </div>

                        <hr>

                        <div class="col-12">
                            <div class="form-group mb-3">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="layout_bottom_{{ $layout->id }}" name="has_bottom_section" @if ($layout->has_bottom_section) checked @endif>
                                    <label class="form-check-label" for="layout_bottom_{{ $layout->id }}">{{ __('Add bottom content') }}</label>
                                </div>
                                <div class="text-muted small">{{ __('Add content in the under the page content (full width)') }}</div>
                            </div>
                        </div>


                        <div class="col-12">
                            <div class="form-group mb-3">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="layout_sidebar_{{ $layout->id }}" name="sidebar" @if ($layout->sidebar) checked @endif>
                                    <label class="form-check-label" for="layout_sidebar_{{ $layout->id }}">{{ __('Add sidebar') }}</label>
                                </div>
                                <div class="text-muted small">{{ __('Add a sidebar (left or right)') }}</div>
                            </div>
                        </div>

                        <script>
                            $('#layout_sidebar_{{ $layout->id }}').change(function() {
                                select = $(this).prop('checked');
                                if (select)
                                    document.getElementById('hidden_div_sidebar_{{ $layout->id }}').style.display = 'block';
                                else
                                    document.getElementById('hidden_div_sidebar_{{ $layout->id }}').style.display = 'none';
                            })
                        </script>

                        <div id="hidden_div_sidebar_{{ $layout->id }}" style="display: @if ($layout->sidebar) block @else none @endif">
                            <div class="col-12 col-md-6">
                                <div class="form-group">
                                    <label>{{ __('Sidebar position') }}</label>
                                    <select name="sidebar_position" class="form-select">
                                        <option @if ($layout->sidebar == 'right') selected @endif value="right">{{ __('Right sidebar') }}</option>
                                        <option @if ($layout->sidebar == 'left') selected @endif value="left">{{ __('Left sidebar') }}</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="use_bg_color_sidebar_{{ $layout->id }}" name="use_bg_color_sidebar" @if ($layout->bg_color_sidebar) checked @endif>
                                    <label class="form-check-label" for="use_bg_color_sidebar_{{ $layout->id }}">{{ __('Add background color to this sidebar') }}</label>
                                </div>
                            </div>

                            <script>
                                $('#use_bg_color_sidebar_{{ $layout->id }}').change(function() {
                                    select = $(this).prop('checked');
                                    if (select)
                                        document.getElementById('hidden_div_bg_color_sidebar_{{ $layout->id }}').style.display = 'block';
                                    else
                                        document.getElementById('hidden_div_bg_color_sidebar_{{ $layout->id }}').style.display = 'none';
                                })
                            </script>

                            <div id="hidden_div_bg_color_sidebar_{{ $layout->id }}" style="display: @if ($layout->bg_color_sidebar) block @else none @endif" class="mt-1">
                                <div class="form-group">
                                    <input class="form-control form-control-color" id="bg_color_sidebar_{{ $layout->id }}" name="bg_color_sidebar" value="{{ $layout->bg_color_sidebar }}">
                                    <label>{{ __('Background color') }}</label>
                                    <br>
                                    {{ $layout->bg_color_sidebar ?? 'white' }}
                                    <script>
                                        $('#bg_color_sidebar_{{ $layout->id }}').spectrum({
                                            type: "color",
                                            showInput: true,
                                            showInitial: true,
                                            showAlpha: false,
                                            showButtons: false,
                                            allowEmpty: false,
                                            appendTo: '#hidden_div_bg_color_sidebar_{{ $layout->id }}'
                                        });
                                    </script>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">{{ __('Update') }}</button>
                </div>

            </form>

        </div>
    </div>
</div>
