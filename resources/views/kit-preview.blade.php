<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    @vite(['resources/js/landing.ts'])
</head>
<body class="font-sans antialiased">
    <!-- Header -->
    <header class="fixed w-full bg-white md:bg-white/80 backdrop-blur-sm z-50 border-b border-gray-100">
        <nav class="container mx-auto px-4 py-4 flex items-center justify-between">
            <a href="{{ url('/') }}" class="flex items-center gap-2">
                <img src="{!! \Illuminate\Support\Facades\Vite::asset('resources/images/logo_icon.webp') !!}" alt="Laravel Start" class="w-12 h-12">
                <span class="text-2xl md:text-xl font-bold text-gray-900">Laravel Start</span>
            </a>
        </nav>
    </header>

    <!-- Hero Section -->
    <section class="pt-24 md:pt-32 pb-16 md:pb-24 bg-gradient-to-b from-white to-gray-50 min-h-screen flex flex-col justify-center">
        <div class="container mx-auto px-4">
            <div class="max-w-4xl mx-auto text-center">
                <h1 class="text-6xl font-bold text-gray-900 mb-12 max-w-4xl mx-auto">
                    Kickstart Your next Laravel App in a
                    <span class="text-primary-500">Blink of an Eye</span>
                    {{' '}}with
                </h1>

                <div class="p-3 z-10 w-full justify-center shrink-0 overflow-inherit color-inherit subpixel-antialiased rounded-t-large flex items-start gap-3">
                    <a href="/kits/laravel-vue-starter-kit">
                        <div class="flex aspect-square items-center justify-center rounded-lg bg-tyrian-purple-100 w-16 text-4xl"><span class="font-semibold uppercase text-tyrian-purple-500">{{ str($kit->title)->upper()->charAt(0) }}</span></div>
                    </a>
                    <div class="flex flex-col items-start">
                        <a class="text-2xl line-clamp-1 break-all" href="/kits/laravel-vue-starter-kit">{{ $kit->title }}</a>
                        <a class="line-clamp-1 text-lg text-default-500" href="https://github.com/laravel/vue-starter-kit" target="_blank" rel="noopener noreferrer">
                            <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 24 24" class="mr-1 inline" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg">
                                <path d="M17.5 4C15.57 4 14 5.57 14 7.5c0 1.554 1.025 2.859 2.43 3.315-.146.932-.547 1.7-1.23 2.323-1.946 1.773-5.527 1.935-7.2 1.907V8.837c1.44-.434 2.5-1.757 2.5-3.337C10.5 3.57 8.93 2 7 2S3.5 3.57 3.5 5.5c0 1.58 1.06 2.903 2.5 3.337v6.326c-1.44.434-2.5 1.757-2.5 3.337C3.5 20.43 5.07 22 7 22s3.5-1.57 3.5-3.5c0-.551-.14-1.065-.367-1.529 2.06-.186 4.657-.757 6.409-2.35 1.097-.997 1.731-2.264 1.904-3.768C19.915 10.438 21 9.1 21 7.5 21 5.57 19.43 4 17.5 4zm-12 1.5C5.5 4.673 6.173 4 7 4s1.5.673 1.5 1.5S7.827 7 7 7s-1.5-.673-1.5-1.5zM7 20c-.827 0-1.5-.673-1.5-1.5a1.5 1.5 0 0 1 1.482-1.498l.13.01A1.495 1.495 0 0 1 7 20zM17.5 9c-.827 0-1.5-.673-1.5-1.5S16.673 6 17.5 6s1.5.673 1.5 1.5S18.327 9 17.5 9z"></path>
                            </svg>
                            {{ $kit->repo_organisation }}/{{ $kit->repo_name }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>
</html>
