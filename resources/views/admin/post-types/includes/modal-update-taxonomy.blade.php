<?php
debug_backtrace() || die('Direct access not permitted');
?>
<div class="modal fade custom-modal" tabindex="-1" role="dialog" aria-labelledby="ModalUpdateTaxonomyLabel-{{ $post_type_taxonomy->id }}" aria-hidden="true" id="update-taxonomy-{{ $post_type_taxonomy->id }}">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">

            <form method="post" action="{{ route('admin.post-type-taxonomies.show', ['id' => $post_type_taxonomy->id, 'post_type' => $type]) }}">
                @csrf
                @method('PUT')

                <div class="modal-header">
                    <h5 class="modal-title" id="ModalUpdateTaxonomyLabel-{{ $post_type_taxonomy->id }}">{{ __('Update taxonomy') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">

                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>{{ __('Name') }}</label>
                                <input class="form-control" name="name" type="text" required value="{{ $taxonomy->name }}" required />
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label>{{ __('URL Slug') }}</label>
                                <input class="form-control" name="slug" type="text" value="{{ $taxonomy->slug }}" />
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label>{{ __('Position') }}</label>
                                <input class="form-control" name="position" type="number" min="0" step="1" value="{{ $taxonomy->position }}" />
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>{{ __('Label singular') }}</label>
                                <input class="form-control" name="label_singular" type="text" value="{{ json_decode($taxonomy->labels ?? null)->singular ?? null }}" />
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label>{{ __('Label plural') }}</label>
                                <input class="form-control" name="label_plural" type="text" value="{{ json_decode($taxonomy->labels ?? null)->plural ?? null }}" />
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label>{{ __('Label create') }}</label>
                                <input class="form-control" name="label_create" type="text" value="{{ json_decode($taxonomy->labels ?? null)->create ?? null }}" />
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label>{{ __('Label update') }}</label>
                                <input class="form-control" name="label_update" type="text" value="{{ json_decode($taxonomy->labels ?? null)->update ?? null }}" />
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label>{{ __('Label delete') }}</label>
                                <input class="form-control" name="label_delete" type="text" value="{{ json_decode($taxonomy->labels ?? null)->delete ?? null }}" />
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label>{{ __('Label all') }}</label>
                                <input class="form-control" name="label_all" type="text" value="{{ json_decode($taxonomy->labels ?? null)->all ?? null }}" />
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label>{{ __('Label search') }}</label>
                                <input class="form-control" name="label_search" type="text" value="{{ json_decode($taxonomy->labels ?? null)->search ?? null }}" />
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group mb-0">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" id="customSwitchHierarchical-{{ $taxonomy->id }}" name="hierarchical" @if ($taxonomy->hierarchical == 1) checked @endif>
                                <label class="form-check-label" for="customSwitchHierarchical-{{ $taxonomy->id }}">{{ __('Hierarchical') }}</label>
                            </div>
                        </div>
                    </div>                    

                    <div class="col-md-6">
                        <div class="form-group mb-0">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" id="customSwitchFilter-{{ $taxonomy->id }}" name="admin_filter" @if ($taxonomy->admin_filter == 1) checked @endif>
                                <label class="form-check-label" for="customSwitchFilter-{{ $taxonomy->id }}">{{ __('Admin filter') }}</label>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group mb-0">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" id="customSwitch-{{ $taxonomy->id }}" name="active" @if ($taxonomy->active == 1) checked @endif>
                                <label class="form-check-label" for="customSwitch-{{ $taxonomy->id }}">{{ __('Active') }}</label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <input type="hidden" name="id" value="{{ $taxonomy->id }}">

                    @if ($post_type->type == 'page' || $post_type->type == 'post')
                        <input type="hidden" name="active" checked>
                    @endif

                    <button type="submit" class="btn btn-primary">{{ __('Update') }}</button>
                </div>

            </form>

        </div>
    </div>
</div>
