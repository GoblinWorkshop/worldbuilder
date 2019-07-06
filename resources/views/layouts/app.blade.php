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
<body class="bg-black text-light">
@yield('nav', View::make('nav.app'))
<div class="main-background"
     @if(View::hasSection('background')) style="background-image: url(@yield('background'));"@endif>
    <div class="main-content">
        <div class="container-fluid">
            @yield('breadcrumbs')
            @if(View::hasSection('options'))
            <div class="float-right">
                @yield('options')
            </div>
            @endif
            @yield('header')
        </div>
        <div id="app" class="pt-4">
            <div class="container-fluid">
                <div class="row">
                    <div class="col">
                        @yield('content')
                    </div>
                    @hasSection('sidebar')
                        <div class="col-xl-3 col-lg-4 col-md-5 col-sm-6">
                            @yield('sidebar')
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@include('components.footer')
@stack('scripts')
</body>
</html>
