<?php
debug_backtrace() || die('Direct access not permitted');
?>
<div class="modal fade custom-modal" tabindex="-1" role="dialog" aria-labelledby="createLabel" aria-hidden="true" id="create-item">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <form method="post" enctype="multipart/form-data" action="{{ route('admin.block.store-item', ['type' => 'testimonial', 'block_id' => $block->id]) }}">
                @csrf

                <div class="modal-header">
                    <h5 class="modal-title" id="createLabel">{{ __('Add new testimonial') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">


                    @foreach (admin_languages() as $item_lang)
                        <div class="form-group">
                            <label>{!! lang_label($item_lang, __('Name')) !!}</label>
                            <input type="text" class="form-control" name="name_{{ $item_lang->id }}" required />
                        </div>

                        <div class="form-group">
                            <label for="formFile_{{ $item_lang->id }}" class="form-label">{!! lang_label($item_lang, __('Avatar image')) !!} ({{ __('optional') }})</label>
                            <input class="form-control" type="file" id="formFile_{{ $item_lang->id }}" name="image_{{ $item_lang->id }}">
                        </div>

                        <div class="form-group">
                            <label>{!! lang_label($item_lang, __('Caption text')) !!} ({{ __('optional') }})</label>
                            <input rows="4" class="form-control" name="subtitle_{{ $item_lang->id }}">
                        </div>

                        <div class="form-group">
                            <label>{!! lang_label($item_lang, __('Content')) !!}</label>
                            <textarea rows="4" class="form-control" name="content_{{ $item_lang->id }}"></textarea>
                        </div>

                        <div class="form-group col-md-4 col-sm-6">
                            <label>{{ __('Rating') }}</label>
                            <select class="form-select" name="rating_{{ $item_lang->id }}">
                                <option value="5">5</option>
                                <option value="4.5">4.5</option>
                                <option value="4">4</option>
                                <option value="3.5">3.5</option>
                                <option value="3">3</option>
                                <option value="2.5">2.5</option>
                                <option value="2">2</option>
                                <option value="1.5">1.5</option>
                                <option value="1">1</option>
                            </select>
                        </div>

                        @if (count(admin_languages()) > 1 && !$loop->last)
                            <hr>
                        @endif
                    @endforeach

                </div>

                <div class="modal-footer">
                    <input type="hidden" name="referer" value="{{ $referer }}">
                    <button type="submit" class="btn btn-primary">{{ __('Add new testimonial') }}</button>
                </div>

            </form>

        </div>
    </div>
</div>
