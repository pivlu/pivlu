<?php
debug_backtrace() || die('Direct access not permitted');
?>
<div class="modal fade custom-modal" tabindex="-1" role="dialog" aria-labelledby="addPostDocsSectionLabel" aria-hidden="true" id="addPostDocsSection">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">

            <form method="post" action="{{ route('admin.posts.docs-content-section.create', ['id' => $post->id]) }}">
                @csrf

                <div class="modal-header">
                    <h5 class="modal-title" id="addPostDocsSectionLabel">{{ __('Add content section') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">

                    @foreach (admin_languages() as $lang)
                        @if (count(admin_languages()) > 1)
                            <div class="fw-bold fs-5">{!! flag($lang->code, 'circle') !!} {{ $lang->name }}</div>
                        @endif
                        <div class="row">

                            <div class="form-group">
                                <label>{{ __('Title') }}</label>
                                <input class="form-control" name="title_{{ $lang->id }}" type="text" @if ($lang->is_default == 1) required @endif />
                            </div>

                            <div class="form-group">
                                <label>{{ __('Description') }} ({{ __('optional') }})</label>
                                <textarea class="form-control" rows="2" name="description_{{ $lang->id }}"></textarea>
                            </div>

                            <div class="form-group">
                                <label>{{ __('Custom permalink') }} ({{ __('optional') }})</label>
                                <input class="form-control" name="slug_{{ $lang->id }}" type="text" />
                            </div>

                        </div>
                    @endforeach

                    @if (count(admin_languages()) > 1)
                        <hr>
                    @endif

                    <hr>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>{{ __('Select parent content') }}</label>
                                <select class="form-select" name="parent_id">
                                    <option value="">{{ __('Root (no parent)') }}</option>

                                    @foreach ($post_docs_sections as $post_docs_section)
                                        <option value="{{ $post_docs_section->default_language_content->id }}">{{ $post_docs_section->default_language_content->title }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                    </div>

                    <div class="form-group mb-0">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="customSwitch" name="active" checked>
                            <label class="form-check-label" for="customSwitch">{{ __('Active') }}</label>
                        </div>
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">{{ __('Save and add content') }}</button>
                </div>

            </form>

        </div>

    </div>

</div>
