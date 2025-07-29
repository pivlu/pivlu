<nav class="nav nav-tabs" id="myTab" role="tablist">
    <a class="nav-item nav-link @if ($menu_section == 'details') active @endif" href="{{ route('admin.accounts.show', ['id' => $account->id]) }}"><i class="bi bi-person" aria-hidden="true"></i> {{ __('Details') }}</a>

    @if ($account->role != 'admin')
        <a class="nav-item nav-link @if ($menu_section == 'notes') active @endif" href="{{ route('admin.account.internal_notes', ['id' => $account->id]) }}"><i class="bi bi-exclamation-circle" aria-hidden="true"></i>
            {{ __('Internal notes') }}</a>
    @endif    
</nav>
