<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', __('Welcome')) - {{ config('app.name', 'Goblin Workshop') }}</title>
    <script src="{{ asset('js/app.js') }}" defer></script>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
@yield('nav', View::make('nav.app'))
<div class="container-fluid">
@yield('breadcrumbs')
@yield('header')
</div>
<div id="app" class="pt-4">
    <div class="container-fluid">
        <div class="row">
            <div class="col">
                @yield('content')
            </div>
            @hasSection('sidebar')
                <div class="col-2">
                    @yield('sidebar')
                </div>
            @endif
        </div>
    </div>
</div>
@stack('scripts')
</body>
</html>
