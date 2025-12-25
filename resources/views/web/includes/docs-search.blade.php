@if (!($config->tpl_docs_disable_search_autocomplete ?? null))
    <!-- search autocomplete -->
    <script>
        function search_docs_suggest(inputString) {
            if (inputString.length == 0) {
                $('#search-suggestions').fadeOut(); // Hide the suggestions box
            } else {
                $.get("{{ route('docs.search_autocomplete') }}", {
                    s: "" + inputString + "",                    
                }, function(data) { // Do an AJAX call
                    $('#search-suggestions').fadeIn(); // Show the suggestions box
                    $('#search-suggestions').html(data); // Fill the suggestions box
                });
            }
        }
    </script>
@endif

<div class="docs-top-bar style_docs_section_search"
    style="@if ($config->tpl_docs_search_bar_use_cover ?? null) background-image: @if ($config->tpl_docs_search_bar_cover_dark ?? null) linear-gradient(rgb(0 0 0 / 50%), rgb(0 0 0 / 50%)), @endif url('{{ str_replace('\\', '/', image($config->tpl_docs_search_bar_cover_img ?? null)) }}'); background-size: cover; @endif">

    @if (($is_docs_homepage ?? null) == 1)
        @if ($config->tpl_docs_search_bar_show_title ?? null)
            <div class="text-center mb-2 title">
                {{ $config_lang->docs_search_bar_title ?? null }}
            </div>
        @endif
    @endif

    <div class="col-xs-12 col-lg-8 offset-lg-2 col-md-8 offset-md-2 col-sm-8 offset-sm-2 col-xl-6 offset-xl-3 col-xxl-4 offset-xxl-4">
        <form methpd="get" action="{{ route('docs.search') }}">
            <div class="input-group">
                <input type="search" class="form-control docs-search form-control-lg" placeholder="{{ __('Search the knowledge base') }}" aria-label="{{ __('Search the knowledge base') }}"
                    aria-describedby="docs-search-addon" @if (!($config->tpl_docs_disable_search_autocomplete ?? null)) onkeyup="search_docs_suggest(this.value);" @endif autocomplete="off" name="s">
                <span class="input-group-text" id="docs-search-addon"><i class="bi bi-search"></i></span>
            </div>
            <div id="search-suggestions"></div>
        </form>
    </div>

    @if (($is_docs_homepage ?? null) == 1)
        @if ($config->tpl_docs_search_bar_show_subtitle ?? null)
            <div class="text-center mt-2 subtitle">
                {{ $config_lang->docs_search_bar_subtitle ?? null }}
            </div>
        @endif
    @endif
</div>
