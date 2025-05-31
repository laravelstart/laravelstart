<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title inertia>{{ \App\Support\PageMeta::getTitle() }} - {{ config('app.name', 'Laravel') }}</title>

        <meta name="description" content="{{ \App\Support\PageMeta::getDescription() }}">

        @foreach(\App\Support\PageMeta::getProps() as $prop => $value)
            <meta property="{{ $prop }}" content="{{ $value }}" />
        @endforeach

        @foreach(\App\Support\PageMeta::getMeta() as $meta => $value)
            <meta name="{{ $meta }}" content="{{ $value }}" />
        @endforeach

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        @include('partials/favicon')

        <!-- Scripts -->
        @routes
        @viteReactRefresh
        @vite(['resources/js/app.tsx'])
        @inertiaHead
    </head>
    <body class="font-sans antialiased">
        @inertia
    </body>
</html>
