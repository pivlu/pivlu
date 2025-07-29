<div class="modal fade custom-modal" tabindex="-1" role="dialog" aria-labelledby="updateLabel-{{ $field->id }}" aria-hidden="true" id="update-field-{{ $field->id }}">
    <div class="modal-dialog">
        <div class="modal-content">

            <form action="{{ route('admin.accounts-fields.show', ['id' => $field->id]) }}" method="post">
                @csrf
                @method('PUT')

                <div class="modal-header">
                    <h5 class="modal-title" id="updateLabel-{{ $field->id }}">{{ __('Update field') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">

                    <div class="row">
                        <div class="col-lg-12">

                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label>{{ __('Field name') }}</label>
                                    <input class="form-control" name="name" type="text" required value="{{ $field->name }}" />
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>{{ __('Field type') }}</label>
                                    <select name="type" class="form-select" required>
                                        <option @if ($field->type == 'text') selected @endif value="text">{{ __('Text input (one line)') }}</option>
                                        <option @if ($field->type == 'textarea') selected @endif value="textarea">{{ __('Textarea (multiple lines)') }}</option>
                                        <option @if ($field->type == 'date') selected @endif value="date">{{ __('Date') }}</option>
                                        <option @if ($field->type == 'number') selected @endif value="numeric">{{ __('Number') }}</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="form-group">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" id="fieldRequired-{{ $field->id }}" name="required" @if ($field->required == 1) checked @endif>
                                        <label class="form-check-label" for="fieldRequired-{{ $field->id }}">{{ __('Required field') }}</label>
                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>

                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">{{ __('Update field') }}</button>
                </div>

            </form>

        </div>
    </div>
</div>
