<?php
debug_backtrace() || die('Direct access not permitted');
?>
<div class="modal fade custom-modal" tabindex="-1" role="dialog" aria-labelledby="ModalCreatePosTypeLabel" aria-hidden="true" id="create-post-type">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">

            <form method="post" enctype="multipart/form-data">
                @csrf

                <div class="modal-header">
                    <h5 class="modal-title" id="ModalCreatePosTypeLabel">{{ __('Create new post type') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">

                    @foreach (admin_languages() as $lang)
                        @if (count(admin_languages()) > 1)
                            <div class="fw-bold fs-5">{!! flag($lang->code, 'circle') !!} {{ $lang->name }}</div>
                        @endif

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>{{ __('Name') }}</label>
                                    <input class="form-control" name="name_{{ $lang->id }}" type="text" @if ($lang->is_default == 1) required @endif />
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>{{ __('Custom URL slug') }} ({{ __('optional') }})</label>
                                    <input class="form-control" name="slug_{{ $lang->id }}" type="text" />
                                </div>
                            </div>
                        </div>

                        <div class="mb-1">
                            <a class="btn btn-secondary btn-sm" data-bs-toggle="collapse" href="#collapseSettings_{{ $lang->id }}" role="button" aria-expanded="false"
                                aria-controls="collapseControls_{{ $lang->id }}">
                                {{ __('Post type labels') }} <i class="bi bi-chevron-down"></i>
                            </a>
                        </div>

                        <div class="collapse" id="collapseSettings_{{ $lang->id }}">

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>{{ __('Label singular') }}</label>
                                        <input class="form-control" name="label_singular_{{ $lang->id }}" type="text" />
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>{{ __('Label plural') }}</label>
                                        <input class="form-control" name="label_plural_{{ $lang->id }}" type="text" />
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>{{ __('Label create') }}</label>
                                        <input class="form-control" name="label_create_{{ $lang->id }}" type="text" />
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>{{ __('Label update') }}</label>
                                        <input class="form-control" name="label_update_{{ $lang->id }}" type="text" />
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>{{ __('Label delete') }}</label>
                                        <input class="form-control" name="label_delete_{{ $lang->id }}" type="text" />
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>{{ __('Label all') }}</label>
                                        <input class="form-control" name="label_all_{{ $lang->id }}" type="text" />
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>{{ __('Label search') }}</label>
                                        <input class="form-control" name="label_search_{{ $lang->id }}" type="text" />
                                    </div>
                                </div>
                            </div>
                        </div>

                        @if (count(languages()) > 1 && !$loop->last)
                            <hr>
                        @endif
                    @endforeach

                    <hr>

                    <div class="col-md-6">
                        <div class="form-group mb-0">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" id="customSwitchShowAdmin" name="show_in_admin_menu" checked>
                                <label class="form-check-label" for="customSwitchShowAdmin">{{ __('Show in admin menu') }}</label>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group mb-0">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" id="customSwitchShowSite" name="internal_only">
                                <label class="form-check-label" for="customSwitchShowSite">{{ __('Internal only') }}</label>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group mb-0">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" id="customSwitch" name="active" checked>
                                <label class="form-check-label" for="customSwitch">{{ __('Active') }}</label>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label>{{ __('Icon code (admin)') }} ({{ __('optional') }})</label>
                            <input class="form-control" name="admin_menu_icon" type="text" />
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
