<?php
debug_backtrace() || die('Direct access not permitted');
?>
<div class="modal fade custom-modal" tabindex="-1" role="dialog" aria-labelledby="createLabel" aria-hidden="true" id="create-item">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <form method="post" action="{{ route('admin.block.store-item', ['type' => 'accordion', 'block_id' => $block->id]) }}">
                @csrf

                <div class="modal-header">
                    <h5 class="modal-title" id="createLabel">{{ __('Add new accordion item') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">

                    @foreach (admin_languages() as $item_lang)                                        
                        <div class="form-group">
                            <label>{!! lang_label($item_lang, __('Title')) !!}</label>
                            <input type="text" class="form-control" name="title_{{ $item_lang->id }}" />
                        </div>

                        <div class="form-group">
                            <label>{!! lang_label($item_lang, __('Content')) !!}</label>
                            <textarea class="form-control trumbowyg" name="content_{{ $item_lang->id }}"></textarea>
                        </div>
                                                
                        @if (count(admin_languages()) > 1 && !$loop->last)
                            <hr>
                        @endif
                    @endforeach

                </div>

                <div class="modal-footer">
                    <input type="hidden" name="referer" value="{{ $referer }}">
                    <button type="submit" class="btn btn-primary">{{ __('Add new accordion item') }}</button>
                </div>

            </form>

        </div>
    </div>
</div>
