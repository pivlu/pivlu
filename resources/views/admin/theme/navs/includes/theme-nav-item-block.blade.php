<div class="float-end ms-2">
    @if (!($item->type == 'logo' || $item->type == 'login_register' || $item->type == 'language_switcher'))
        <a href="{{ route('admin.theme-nav-row.show-item', ['nav_id' => $nav->id, 'row_id' => $row->id, 'item_id' => $item->id]) }}" class="btn btn-primary btn-sm">{{ __('Settings') }}</a>
    @endif

    <a href="#" data-bs-toggle="modal" data-bs-target=".confirm-{{ $item->id }}" class="btn btn-outline-danger btn-sm ms-2"><i class="bi bi-trash"></i></a>
    <div class="modal fade confirm-{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="ConfirmDeleteLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ConfirmDeleteLabel">{{ __('Confirm delete') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    {{ __('Are you sure you want to remove this item?') }}
                </div>
                <div class="modal-footer">
                    <form method="POST" action="{{ route('admin.theme-nav-row.delete-item', ['nav_id' => $nav->id, 'row_id' => $row->id, 'item_id' => $item->id]) }}">
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('Close') }}</button>
                        <button type="submit" class="btn btn-danger">{{ __('Yes. Delete') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
