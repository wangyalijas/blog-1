<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="all,follow">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ mix('css/console/app.css') }}" rel="stylesheet">
    @stack('stylesheets')

    <!-- Tweaks for older IEs-->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
<div class="page" id="app">

    @yield('app')

</div>

<!-- Scripts -->
<script src="{{ mix('js/console/manifest.js') }}"></script>
<script src="{{ mix('js/console/vendor.js') }}"></script>
<script src="{{ mix('js/console/app.js') }}"></script>
@stack('scripts')
</body>
</html>
