<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
<meta charset="utf-8">
    <title>{{ config('app.name', 'Laravel') }}</title>
    @include('dashboard.layouts.head')
    <!-- Styles -->
    @notifyCss
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
    <style>
        @media print {
            .oculto-impresion,
            .oculto-impresion * {
                display: none !important;
            }
        }
    </style>
    @yield('style')
</head>

<body id="app">
    <div class="d-flex" id="content-wrapper">
            @include('dashboard.layouts.sidebar')

            <div class="w-100">
            @include('dashboard.layouts.navbar')
            <div id="content" class="bg-grey w-100">
                <main class="py-4">
                    @yield('main')
                </main>
            </div>
        </div>
    </div>
    <x:notify-messages />
<!-- Scripts -->
<script src="{{ mix('js/app.js') }}"></script>
@yield('js')
@notifyJs
</body>

</html>