<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', __('Welcome')) - {{ config('app.name', 'Goblin Workshop') }}</title>
    <script src="{{ asset('js/site.js') }}" defer></script>
    <link href="{{ asset('css/site.css') }}" rel="stylesheet">
</head>
<body class="bg-black text-light">
<div id="app">
    @yield('nav', View::make('nav.site'))
    <main>
        @yield('content')
    </main>
</div>
@include('components.footer')
</body>
</html>