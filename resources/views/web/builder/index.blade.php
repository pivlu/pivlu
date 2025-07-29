<!DOCTYPE html>
<html lang="{{ $locale }}" dir="{{ $site_text_dir }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{{ $config_lang->site_meta_title ?? __('Clevada') }}</title>
    <meta name="description" content="{{ $config_lang->site_meta_description ?? __('Clevada') }}">

    @include("web.builder.global.head")

    <!-- Syntax highlight-->
    <link rel="stylesheet" href="https://cdn.clevada.com/vendors/prism/prism.css">
    <script src="https://cdn.clevada.com/vendors/prism/prism.js"></script>
</head>

<body class="style_global">

    <!-- Start Main Content -->
    <div class="content">

        @include("web.builder.global.navigation")

        <div class="container-xxl">                
        </div>
       
    </div>
    <!-- End Main Content -->

    @include("web.builder.global.footer")

</body>

</html>
