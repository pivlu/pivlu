<nav class="nav nav-tabs" id="myTab" role="tablist">
    <a class="nav-item nav-link @if ($menu_section == 'details') active @endif" href="{{ route('admin.accounts.show', ['id' => $account->id]) }}"><i class="bi bi-person" aria-hidden="true"></i> {{ __('Details') }}</a>    
</nav>
