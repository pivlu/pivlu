<nav class="nav nav-tabs" id="myTab" role="tablist">
    <a class="nav-item nav-link @if (($active_tab ?? null) == 'summary') active @endif" href="{{ route('admin') }}"><i class="bi bi-grid-fill"></i> {{ __('Summary') }}</a>    
    {{--<a class="nav-item nav-link @if (($active_tab ?? null) == 'activity') active @endif" href="{{ route('admin.activity') }}"><i class="bi bi-activity"></i> {{ __('Activity log') }}</a>--}}
    <a class="nav-item nav-link @if (($active_tab ?? null) == 'wizard') active @endif" href="{{ route('admin.wizard') }}"><i class="bi bi-magic"></i> {{ __('Quick help') }}</a>
</nav>
