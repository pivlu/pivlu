<?php
debug_backtrace() || die('Direct access not permitted');
?>
<div class="modal fade custom-modal" tabindex="-1" role="dialog" aria-labelledby="createLabel" aria-hidden="true" id="create-item">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <form method="post" enctype="multipart/form-data" action="{{ route('admin.block.store-item', ['type' => 'card', 'block_id' => $block->id]) }}">
                @csrf

                <div class="modal-header">
                    <h5 class="modal-title" id="createLabel">{{ __('Add new card') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">

                    @foreach (admin_languages() as $item_lang)
                        <div class="form-group">
                            <label for="formFile_{{ $item_lang->id }}" class="form-label">{!! lang_label($item_lang, __('Card image')) !!}</label>
                            <input class="form-control" type="file" id="formFile_{{ $item_lang->id }}" name="image_{{ $item_lang->id }}">
                            <div class="form-text">{{ __('optional') }}</div>
                            
                            @if (count(admin_languages()) > 1)
                                @if ($loop->first)
                                    <div class="form-check form-switch mt-2">
                                        <input class="form-check-input" type="checkbox" role="switch" id="switchCheckImages" name="use_image_for_all_languages" />
                                        <label class="form-check-label" for="switchCheckImages">{{ __('Use this image for all languages') }}</label>
                                    </div>

                                    <script>
                                        const checkbox = document.getElementById('switchCheckImages');
                                        checkbox.addEventListener('change', function() {
                                            if (this.checked) {
                                                @foreach (admin_languages() as $other_lang)
                                                    @if ($other_lang->id != $item_lang->id)
                                                        document.getElementById('formFile_{{ $other_lang->id }}').disabled = true;
                                                    @endif
                                                @endforeach
                                            } else {
                                                @foreach (admin_languages() as $other_lang)
                                                    @if ($other_lang->id != $item_lang->id)
                                                        document.getElementById('formFile_{{ $other_lang->id }}').disabled = false;
                                                    @endif
                                                @endforeach
                                            }
                                        });
                                    </script>
                                @endif
                            @endif
                        </div>

                        <div class="form-group">
                            <label>{!! lang_label($item_lang, __('Title')) !!}</label>
                            <input type="text" class="form-control" name="title_{{ $item_lang->id }}" />
                        </div>

                        <div class="form-group">
                            <label>{!! lang_label($item_lang, __('Content')) !!}</label>
                            <textarea rows="4" class="form-control trum" name="content_{{ $item_lang->id }}"></textarea>
                            <div class="form-text">{{ __('You can use HTML code here') }}</div>
                        </div>

                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label class="mb-2">{!! lang_label($item_lang, __('URL')) !!}</label>
                                    <input type="text" class="form-control" name="url_{{ $item_lang->id }}">
                                    <div class="form-text">{{ __('optional') }}</div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="mb-2">{!! lang_label($item_lang, __('Icon code')) !!}</label>
                                    <input class="form-control" type="text" name="icon_{{ $item_lang->id }}">
                                    <div class="form-text">{{ __('optional') }}</div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="mb-2">{!! lang_label($item_lang, __('Button label - if buttons are enabled')) !!}</label>
                                    <input class="form-control" type="text" name="button_label_{{ $item_lang->id }}">
                                    <div class="form-text">{{ __('optional') }}</div>
                                </div>
                            </div>
                        </div>

                        @if (count(admin_languages()) > 1 && !$loop->last)
                            <hr>
                        @endif
                    @endforeach

                </div>

                <div class="modal-footer">
                    <input type="hidden" name="referer" value="{{ $referer }}">
                    <button type="submit" class="btn btn-primary">{{ __('Add new card') }}</button>
                </div>

            </form>

        </div>
    </div>
</div>
