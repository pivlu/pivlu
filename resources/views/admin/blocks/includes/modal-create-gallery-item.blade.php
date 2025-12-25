<?php
debug_backtrace() || die('Direct access not permitted');
?>
<div class="modal fade custom-modal" tabindex="-1" role="dialog" aria-labelledby="createLabel" aria-hidden="true" id="create-item">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <form method="post" enctype="multipart/form-data" action="{{ route('admin.block.store-item', ['type' => 'gallery', 'block_id' => $block->id]) }}">
                @csrf

                <div class="modal-header">
                    <h5 class="modal-title" id="createLabel">{{ __('Add new image') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">

                    <div class="form-group">
                        <label for="formFile" class="form-label">{{ __('Upload image') }}</label>
                        <input class="form-control" type="file" id="formFile" name="image" required>
                    </div>

                    @foreach (admin_languages() as $item_lang)
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{ __('Title') }}
                                        @if (count(admin_languages()) > 1)
                                            - {!! flag($item_lang->code) !!} {{ $item_lang->name }}
                                        @endif
                                    </label>
                                    <input type="text" class="form-control" name="title_{{ $item_lang->id }}" />
                                    <div class="text-muted small">
                                        {{ __('Title is used as "alt" tag.') }}
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{ __('URL') }} ({{ __('optional') }})
                                        @if (count(admin_languages()) > 1)
                                            - {!! flag($item_lang->code) !!} {{ $item_lang->name }}
                                        @endif
                                    </label>
                                    <input type="text" class="form-control" name="url_{{ $item_lang->id }}">
                                    <div class="text-muted small">
                                        {{ __('If set, the link opens when you click on the image') }}
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>{{ __('Caption') }} ({{ __('optional') }})
                                @if (count(admin_languages()) > 1)
                                    - {!! flag($item_lang->code) !!} {{ $item_lang->name }}
                                @endif
                            </label>
                            <input class="form-control" type="text" name="caption_{{ $item_lang->id }}">
                            <div class="text-muted small">
                                {{ __('The text under the image') }}
                            </div>
                        </div>

                        @if (count(admin_languages()) > 1 && !$loop->last)
                            <hr>
                        @endif
                    @endforeach

                </div>

                <div class="modal-footer">
                    <input type="hidden" name="referer" value="{{ $referer }}">
                    <button type="submit" class="btn btn-primary">{{ __('Add new image') }}</button>
                </div>

            </form>

        </div>
    </div>
</div>
