<div class="modal fade custom-modal" tabindex="-1" role="dialog" aria-labelledby="updateGroupLabel-{{ $group->id }}" aria-hidden="true" id="update-permissions-group-{{ $group->id }}">
    <div class="modal-dialog">
        <div class="modal-content">

            <form action="{{ route('admin.permissions-groups.show', ['id' => $group->id]) }}" method="post">
                @csrf
                @method('PUT')

                <div class="modal-header">
                    <h5 class="modal-title" id="updateGroupLabel-{{ $group->id }}">{{ __('Update permissions group') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">

                    <div class="form-group">
                        <label>{{ __('Group name') }}</label>
                        <input class="form-control" name="label" type="text" required value="{{ $group->label }}">
                    </div>

                    <div class="form-group">
                        <label>{{ __('Description') }} ({{ __('optional') }})</label>
                        <textarea class="form-control" name="description" rows="3">{{ $group->description }}</textarea>
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">{{ __('Update permissions group') }}</button>
                </div>

            </form>

        </div>
    </div>
</div>
