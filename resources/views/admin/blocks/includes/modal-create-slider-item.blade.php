<?php
debug_backtrace() || die('Direct access not permitted');
?>
<div class="modal fade custom-modal" tabindex="-1" role="dialog" aria-labelledby="createLabel" aria-hidden="true" id="create-item">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <form method="post" enctype="multipart/form-data" action="{{ route('admin.block.store-item', ['type' => 'slider', 'block_id' => $block->id]) }}">
                @csrf

                <div class="modal-header">
                    <h5 class="modal-title" id="createLabel">{{ __('Add new slide') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">

                    @foreach (admin_languages() as $item_lang)
                        <div class="form-group">
                            <label for="formFile_{{ $item_lang->id }}" class="form-label">{{ __('Slide image') }}</label>
                            <input class="form-control" type="file" id="formFile_{{ $item_lang->id }}" name="image_{{ $item_lang->id }}">
                        </div>

                        <div class="form-group">
                            <label>{{ __('Title') }}
                                @if (count(admin_languages()) > 1)
                                    - {!! flag($item_lang->code) !!} {{ $item_lang->name }}
                                @endif
                            </label>
                            <input type="text" class="form-control" name="title_{{ $item_lang->id }}" />
                        </div>

                        <div class="form-group">
                            <label>{{ __('Content') }}
                                @if (count(admin_languages()) > 1)
                                    - {!! flag($item_lang->code) !!} {{ $item_lang->name }}
                                @endif
                            </label>
                            <textarea rows="4" class="form-control" name="content_{{ $item_lang->id }}"></textarea>
                        </div>

                        <div class="form-group">
                            <label>{{ __('URL') }} ({{ __('optional') }})
                                @if (count(admin_languages()) > 1)
                                    - {!! flag($item_lang->code) !!} {{ $item_lang->name }}
                                @endif
                            </label>
                            <input type="text" class="form-control" name="url_{{ $item_lang->id }}">
                        </div>

                        @if (count(admin_languages()) > 1 && !$loop->last)
                            <hr>
                        @endif
                    @endforeach

                </div>

                <div class="modal-footer">
                    <input type="hidden" name="referer" value="{{ $referer }}">
                    <button type="submit" class="btn btn-primary">{{ __('Add new slide') }}</button>
                </div>

            </form>

        </div>
    </div>
</div>
