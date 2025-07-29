<?php
debug_backtrace() || die('Direct access not permitted');
?>
<div class="modal fade custom-modal" tabindex="-1" role="dialog" aria-labelledby="ModalCptLabelUpdate-{{ $post_type->id }}" aria-hidden="true" id="update-cpt-{{ $post_type->id }}">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">

            <form method="post" action="{{ route('admin.post-types.show', ['id' => $post_type->id]) }}">
                @csrf
                @method('PUT')

                <div class="modal-header">
                    <h5 class="modal-title" id="ModalLabel">{{ __('Update') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">

                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>{{ __('Name') }}</label>
                                <input class="form-control" name="name" type="text" required value="{{ $post_type->name }}" />
                            </div>
                        </div>

                        @if ($post_type->type != 'page')
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>{{ __('URL slug') }}</label>
                                    <input class="form-control" name="slug" type="text" required value="{{ $post_type->slug }}" />
                                </div>
                            </div>
                        @endif

                        <div class="col-md-4">
                            <div class="form-group">
                                <label>{{ __('Icon code (admin)') }} ({{ __('optional') }})</label>
                                <input class="form-control" name="admin_menu_icon" type="text" value="{{ $post_type->admin_menu_icon }}" />
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>{{ __('Label singular') }}</label>
                                <input class="form-control" name="label_singular" type="text" value="{{ json_decode($post_type->labels)->singular ?? null }}" />
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label>{{ __('Label plural') }}</label>
                                <input class="form-control" name="label_plural" type="text" value="{{ json_decode($post_type->labels)->plural ?? null }}" />
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label>{{ __('Label create') }}</label>
                                <input class="form-control" name="label_create" type="text" value="{{ json_decode($post_type->labels)->create ?? null }}" />
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label>{{ __('Label update') }}</label>
                                <input class="form-control" name="label_update" type="text" value="{{ json_decode($post_type->labels)->update ?? null }}" />
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label>{{ __('Label delete') }}</label>
                                <input class="form-control" name="label_delete" type="text" value="{{ json_decode($post_type->labels)->delete ?? null }}" />
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label>{{ __('Label all') }}</label>
                                <input class="form-control" name="label_all" type="text" value="{{ json_decode($post_type->labels)->all ?? null }}" />
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label>{{ __('Label search') }}</label>
                                <input class="form-control" name="label_search" type="text" value="{{ json_decode($post_type->labels)->search ?? null }}" />
                            </div>
                        </div>

                        <div class="col-lg-12">
                            <div class="form-group">
                                <label>{{ __('Description') }} ({{ __('optional') }})</label>
                                <textarea class="form-control" name="description" rows="2">{{ $post_type->description }}</textarea>
                            </div>
                        </div>
                    </div>

                    @if (!($post_type->type == 'page' || $post_type->type == 'post'))                        
                        <div class="col-md-6">
                            <div class="form-group mb-0">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="customSwitchShowAdmin-{{ $post_type->id }}" name="show_in_admin_menu" @if ($post_type->show_in_admin_menu == 1) checked @endif>
                                    <label class="form-check-label" for="customSwitchShowAdmin-{{ $post_type->id }}">{{ __('Show in admin menu') }}</label>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group mb-0">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="customSwitchInternal-{{ $post_type->id }}" name="internal_only" @if ($post_type->internal_only == 1) checked @endif>
                                    <label class="form-check-label" for="customSwitchInternal-{{ $post_type->id }}">{{ __('Internal only') }}</label>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group mb-0">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="customSwitch-{{ $post_type->id }}" name="active" @if ($post_type->active == 1) checked @endif>
                                    <label class="form-check-label" for="customSwitch-{{ $post_type->id }}">{{ __('Active') }}</label>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>

                <div class="modal-footer">
                    <input type="hidden" name="id" value="{{ $post_type->id }}">

                    @if ($post_type->type == 'page' || $post_type->type == 'post')
                        <input type="hidden" name="active" checked>
                    @endif

                    <button type="submit" class="btn btn-primary">{{ __('Update') }}</button>
                </div>

            </form>

        </div>
    </div>
</div>
