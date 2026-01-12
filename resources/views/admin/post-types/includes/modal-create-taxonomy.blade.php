<?php
debug_backtrace() || die('Direct access not permitted');
?>
<div class="modal fade custom-modal" tabindex="-1" role="dialog" aria-labelledby="ModalCreateTaxonomyLabel" aria-hidden="true" id="create-taxonomy">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <form method="post" enctype="multipart/form-data">
                @csrf

                <div class="modal-header">
                    <h5 class="modal-title" id="ModalCreateTaxonomyLabel">{{ __('Create taxonomy') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">

                    @foreach (admin_languages() as $lang)
                        @if (count(admin_languages()) > 1)
                            <div class="fw-bold fs-5">{!! flag($lang->code, 'circle') !!} {{ $lang->name }}</div>
                        @endif
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{ __('Name') }}</label>
                                    <input class="form-control" name="name_{{ $lang->id }}" type="text" required />
                                    <div class="form-text">{{ __('Plural. E.g. "Categories"') }}</div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{ __('Custom URL slug') }} ({{ __('optional') }})</label>
                                    <input class="form-control" name="slug_{{ $lang->id }}" type="text" />
                                </div>
                            </div>

                            <div class="mb-1">
                                <a class="btn btn-secondary btn-sm" data-bs-toggle="collapse" href="#collapseSettings_{{ $lang->id }}" role="button" aria-expanded="false"
                                    aria-controls="collapseControls_{{ $lang->id }}">
                                    {{ __('More settings') }} <i class="bi bi-chevron-down"></i>
                                </a>
                            </div>

                            <div class="collapse" id="collapseSettings_{{ $lang->id }}">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>{{ __('Label singular') }}</label>
                                            <input class="form-control" name="label_singular_{{ $lang->id }}" type="text" />
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>{{ __('Label plural') }}</label>
                                            <input class="form-control" name="label_plural_{{ $lang->id }}" type="text" />
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>{{ __('Label create') }}</label>
                                            <input class="form-control" name="label_create_{{ $lang->id }}" type="text" />
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>{{ __('Label update') }}</label>
                                            <input class="form-control" name="label_update_{{ $lang->id }}" type="text" />
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>{{ __('Label delete') }}</label>
                                            <input class="form-control" name="label_delete_{{ $lang->id }}" type="text" />
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>{{ __('Label all') }}</label>
                                            <input class="form-control" name="label_all_{{ $lang->id }}" type="text" />
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>{{ __('Label search') }}</label>
                                            <input class="form-control" name="label_search_{{ $lang->id }}" type="text" />
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>{{ __('Label popular') }}</label>
                                            <input class="form-control" name="label_popular_{{ $lang->id }}" type="text" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        @if (count(languages()) > 1)
                            <hr>
                        @endif
                    @endforeach


                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>{{ __('Position') }}</label>
                                <input class="form-control" name="position" type="number" min="0" step="1" />
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group mb-2">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" id="customSwitchHierarchical" name="hierarchical" checked>
                                <label class="form-check-label" for="customSwitchHierarchical">{{ __('Hierarchical') }}</label>
                            </div>
                        </div>

                        <div class="form-group mb-2">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" id="customSwitchFilter" name="admin_filter" checked>
                                <label class="form-check-label" for="customSwitchFilter">{{ __('Admin filter') }}</label>
                            </div>
                        </div>

                        <div class="form-group mb-0">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" id="customSwitch" name="active" checked>
                                <label class="form-check-label" for="customSwitch">{{ __('Active') }}</label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <input type="hidden" name="post_type_id" value="{{ $post_type->id }}">
                    <button type="submit" class="btn btn-primary">{{ __('Create') }}</button>
                </div>

            </form>

        </div>
    </div>
</div>
