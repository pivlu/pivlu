<?php
debug_backtrace() || die('Direct access not permitted');
?>
<div class="modal fade custom-modal" tabindex="-1" role="dialog" aria-labelledby="ModalLabel_{{ $item->id }}" aria-hidden="true" id="update-taxonomy-{{ $item->id }}">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">

            <form action="{{ route('admin.taxonomies.show', ['id' => $item->id]) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="modal-header">
                    <h5 class="modal-title" id="ModalLabel_{{ $item->id }}">{{ __('Update') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>


                <div class="modal-body">

                    @foreach (admin_languages() as $lang)
                        @if (count(admin_languages()) > 1)
                            <div class="fw-bold fs-5">{!! flag($lang->code, 'circle') !!} {{ $lang->name }}</div>
                        @endif
                        <div class="row">
                            <div class="col-md-7">
                                <div class="form-group">
                                    <label>{{ __('Name') }}</label>
                                    <input class="form-control" name="name_{{ $lang->id }}" type="text" value="{{ $item->default_language_content->name }}" @if ($lang->is_default == 1) required @endif />
                                </div>
                            </div>

                            <div class="col-md-5">
                                <div class="form-group">
                                    <label>{{ __('Custom permalink') }} ({{ __('optional') }})</label>
                                    <input class="form-control" name="slug_{{ $lang->id }}" type="text" value="{{ $item->default_language_content->slug }}" />
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
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label>{{ __('Description') }} ({{ __('optional') }})</label>
                                            <textarea class="form-control" name="description_{{ $lang->id }}" rows="1"></textarea>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>{{ __('Meta title') }} ({{ __('optional') }})</label>
                                            <input class="form-control" name="meta_title_{{ $lang->id }}" type="text" />
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>{{ __('Meta description') }} ({{ __('optional') }})</label>
                                            <input class="form-control" name="meta_description_{{ $lang->id }}" type="text" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <hr>
                    @endforeach

                    @if (count(languages()) > 1)
                        <hr>
                    @endif

                    <div class="row">
                        @if ($taxonomy_term->hierarchical == 1)
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{ __('Select parent item') }}</label>
                                    <select class="form-select" name="parent_id">
                                        <option value="">{{ __('Root (no parent)') }}</option>

                                        @foreach ($items as $taxonomy_item)
                                            @include('admin.posts.includes.loops.taxonomies-add-select-loop', $taxonomy_item)
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        @endif

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>{{ __('Icon code') }} ({{ __('optional') }})</label>
                                <input class="form-control" name="icon" type="text" />
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="formFile" class="form-label">{{ __('Taxonomy image') }} ({{ __('optional') }})</label>
                                <input class="form-control" type="file" id="formFile" name="image">
                                <div class="form-text text-muted small">{{ __('Maximum 5 MB') }}</div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>{{ __('Position') }}</label>
                                <input class="form-control" name="position" type="number" min="0" step="1" />
                                <div class="text-muted small">{{ __('Position in the parent item. Leave empty to use the last position.') }}</div>
                            </div>
                        </div>

                    </div>

                    <div class="col-12">
                        <div class="form-group mb-0">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" id="customSwitch" name="active" checked>
                                <label class="form-check-label" for="customSwitch">{{ __('Active') }}</label>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="modal-footer">
                    <input type="hidden" name="taxonomy" value="{{ $taxonomy }}">
                    <input type="hidden" name="post_type" value="{{ $post_type }}">
                    <input type="hidden" name="type" value="{{ $type ?? 'post' }}">
                    <button type="submit" class="btn btn-primary">{{ __('Update category') }}</button>
                </div>

            </form>

        </div>
    </div>
</div>
