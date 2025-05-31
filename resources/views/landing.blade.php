<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ \App\Support\PageMeta::getTitle() }} - {{ config('app.name', 'Laravel') }}</title>

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
            <!-- Mobile menu button -->
            <button class="md:hidden" onclick="document.getElementById('mobile-menu').classList.toggle('hidden')">
                <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
            </button>
            <!-- Desktop menu -->
            <div class="hidden md:flex items-center gap-6">
                <a href="#how" class="text-gray-600 hover:text-gray-900">How it works</a>
                <a href="#features" class="text-gray-600 hover:text-gray-900">Features</a>
                <a href="#pricing" class="text-gray-600 hover:text-gray-900">Pricing</a>

                <div class="h-4 w-0.5 bg-gray-300"></div>

                <a href="" class="fill-gray-600 hover:fill-gray-900" title="Github">
                    <svg class="size-5" role="img" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><title>GitHub</title><path d="M12 .297c-6.63 0-12 5.373-12 12 0 5.303 3.438 9.8 8.205 11.385.6.113.82-.258.82-.577 0-.285-.01-1.04-.015-2.04-3.338.724-4.042-1.61-4.042-1.61C4.422 18.07 3.633 17.7 3.633 17.7c-1.087-.744.084-.729.084-.729 1.205.084 1.838 1.236 1.838 1.236 1.07 1.835 2.809 1.305 3.495.998.108-.776.417-1.305.76-1.605-2.665-.3-5.466-1.332-5.466-5.93 0-1.31.465-2.38 1.235-3.22-.135-.303-.54-1.523.105-3.176 0 0 1.005-.322 3.3 1.23.96-.267 1.98-.399 3-.405 1.02.006 2.04.138 3 .405 2.28-1.552 3.285-1.23 3.285-1.23.645 1.653.24 2.873.12 3.176.765.84 1.23 1.91 1.23 3.22 0 4.61-2.805 5.625-5.475 5.92.42.36.81 1.096.81 2.22 0 1.606-.015 2.896-.015 3.286 0 .315.21.69.825.57C20.565 22.092 24 17.592 24 12.297c0-6.627-5.373-12-12-12"/></svg>
                </a>

                <a href="" class="fill-gray-600 hover:fill-gray-900" title="Github">
                    <svg class="size-6" role="img" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><title>Discord</title><path d="M20.317 4.3698a19.7913 19.7913 0 00-4.8851-1.5152.0741.0741 0 00-.0785.0371c-.211.3753-.4447.8648-.6083 1.2495-1.8447-.2762-3.68-.2762-5.4868 0-.1636-.3933-.4058-.8742-.6177-1.2495a.077.077 0 00-.0785-.037 19.7363 19.7363 0 00-4.8852 1.515.0699.0699 0 00-.0321.0277C.5334 9.0458-.319 13.5799.0992 18.0578a.0824.0824 0 00.0312.0561c2.0528 1.5076 4.0413 2.4228 5.9929 3.0294a.0777.0777 0 00.0842-.0276c.4616-.6304.8731-1.2952 1.226-1.9942a.076.076 0 00-.0416-.1057c-.6528-.2476-1.2743-.5495-1.8722-.8923a.077.077 0 01-.0076-.1277c.1258-.0943.2517-.1923.3718-.2914a.0743.0743 0 01.0776-.0105c3.9278 1.7933 8.18 1.7933 12.0614 0a.0739.0739 0 01.0785.0095c.1202.099.246.1981.3728.2924a.077.077 0 01-.0066.1276 12.2986 12.2986 0 01-1.873.8914.0766.0766 0 00-.0407.1067c.3604.698.7719 1.3628 1.225 1.9932a.076.076 0 00.0842.0286c1.961-.6067 3.9495-1.5219 6.0023-3.0294a.077.077 0 00.0313-.0552c.5004-5.177-.8382-9.6739-3.5485-13.6604a.061.061 0 00-.0312-.0286zM8.02 15.3312c-1.1825 0-2.1569-1.0857-2.1569-2.419 0-1.3332.9555-2.4189 2.157-2.4189 1.2108 0 2.1757 1.0952 2.1568 2.419 0 1.3332-.9555 2.4189-2.1569 2.4189zm7.9748 0c-1.1825 0-2.1569-1.0857-2.1569-2.419 0-1.3332.9554-2.4189 2.1569-2.4189 1.2108 0 2.1757 1.0952 2.1568 2.419 0 1.3332-.946 2.4189-2.1568 2.4189Z"/></svg>
                </a>

                <div class="h-4 w-0.5 bg-gray-300"></div>

                <a href="/login" class="bg-primary-500 text-white px-4 py-2 rounded-lg hover:bg-primary-600 transition">
                    Get Started
                </a>
            </div>
        </nav>
        <!-- Mobile menu -->
        <div id="mobile-menu" class="text-lg hidden md:hidden px-4 py-2 bg-white border-t border-gray-100">
            <a href="#how" class="block py-2 text-gray-600 hover:text-gray-900">How it works</a>
            <a href="#features" class="block py-2 text-gray-600 hover:text-gray-900">Features</a>
            <a href="#pricing" class="block py-2 text-gray-600 hover:text-gray-900">Pricing</a>
            <a href="/login" class="block py-2 text-primary-500 hover:text-primary-600">Get Started</a>
        </div>
    </header>

    <!-- Hero Section -->
    <section class="pt-24 md:pt-32 pb-16 md:pb-24 bg-gradient-to-b from-white to-gray-50">
        <div class="container mx-auto px-4">
            <div class="max-w-4xl mx-auto text-center">
                <h1 class="text-6xl font-bold text-gray-900 mb-6 max-w-4xl mx-auto">
                    Kickstart Your next Laravel App in a
                    <span class="text-primary-500">Blink of an Eye</span>
                </h1>
                <p class="text-lg md:text-xl text-gray-600 mb-8">
                    The fastest way to kick off a Laravel project.
                    Choose from official and community starter kits and deploy in seconds, not hours.
                </p>
                <p class="text-lg md:text-xl text-gray-600 font-bold mb-8">
                    All for free. <span class="text-primary">Forever.</span>
                </p>
                <div class="flex max-sm:flex-col items-center justify-center gap-4">
                    <a href="#pricing" class="bg-primary-500 text-white px-8 py-4 rounded-lg text-2xl md:text-lg font-medium hover:bg-primary-600 transition">
                        Start Building Now
                    </a>
                    <a href="#how" class="text-gray-600 px-8 py-4 rounded-lg text-2xl md:text-lg font-medium hover:text-gray-900">
                        Learn More →
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- How it Works Section -->
    <section id="how" class="py-16 md:py-24 bg-white">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl font-bold text-center mb-12 md:mb-16">Start Building in 3 Simple Steps</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 md:gap-12 max-w-6xl mx-auto items-center">
                <!-- Step 1 -->
                <div class="flex flex-col">
                    <div class="relative">
                        <div class="absolute -left-4 -top-4 w-10 h-10 bg-primary-500 text-white rounded-full flex items-center justify-center font-bold text-lg">
                            1
                        </div>
                        <img
                            src="{!! \Illuminate\Support\Facades\Vite::asset('resources/images/choose-kit.png') !!}"
                            alt="Choose a starter kit"
                            class="w-full rounded-lg shadow-lg mb-6"
                        >
                    </div>
                    <h3 class="max-sm:text-2xl text-xl font-semibold mb-3">Choose Your Kit</h3>
                    <p class="max-sm:text-lg text-gray-600">Browse through our collection of starter kits and click "Use This Kit" on the one that matches your needs.</p>
                </div>

                <!-- Step 2 -->
                <div class="flex flex-col">
                    <div class="relative">
                        <div class="absolute -left-4 -top-4 w-10 h-10 bg-primary-500 text-white rounded-full flex items-center justify-center font-bold text-lg">
                            2
                        </div>
                        <img
                            src="{!! \Illuminate\Support\Facades\Vite::asset('resources/images/enter-repo-details.png') !!}"
                            alt="Configure repository"
                            class="w-full rounded-lg shadow-lg mb-6"
                        >
                    </div>
                    <h3 class="max-sm:text-2xl text-xl font-semibold mb-3">Configure Repository</h3>
                    <p class="max-sm:text-lg text-gray-600">Enter your repository name and customize the initial commit message if you'd like.</p>
                </div>

                <!-- Step 3 -->
                <div class="flex flex-col">
                    <div class="relative">
                        <div class="absolute -left-4 -top-4 w-10 h-10 bg-primary-500 text-white rounded-full flex items-center justify-center font-bold text-lg">
                            3
                        </div>
                        <img
                            src="{!! \Illuminate\Support\Facades\Vite::asset('resources/images/my-app-example.png') !!}"
                            alt="Ready to code"
                            class="w-full rounded-lg shadow-lg mb-6"
                        >
                    </div>
                    <h3 class="max-sm:text-2xl text-xl font-semibold mb-3">Start Coding!</h3>
                    <p class="max-sm:text-lg text-gray-600">Your app is ready! Visit your new repository on GitHub or clone it locally to start development.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section id="features" class="py-16 md:py-24 bg-gray-50">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl font-bold text-center mb-12 md:mb-16">Everything You Need to Launch Faster</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="p-6 rounded-xl bg-gray-50">
                    <img
                        src="{!! \Illuminate\Support\Facades\Vite::asset('resources/images/icon-lightning.png') !!}"
                        alt="Lightning"
                        class="w-full mb-6"
                    >

                    <h3 class="max-sm:text-2xl text-xl font-semibold mb-2">10-Second Setup</h3>
                    <p class="max-sm:text-lg text-gray-600">Go from idea to a fully scaffolded, ready-to-develop project in just 10 seconds.</p>
                </div>
                <div class="p-6 rounded-xl bg-gray-50">
                    <img
                        src="{!! \Illuminate\Support\Facades\Vite::asset('resources/images/icon-crowd.png') !!}"
                        alt="Lightning"
                        class="w-full mb-6"
                    >

                    <h3 class="max-sm:text-2xl text-xl font-semibold mb-2">Community Powered</h3>
                    <p class="max-sm:text-lg text-gray-600">Access a wide range of starter kits including Hero UI, Svelte, and more from the Laravel community.</p>
                </div>
                <div class="p-6 rounded-xl bg-gray-50">
                    <img
                        src="{!! \Illuminate\Support\Facades\Vite::asset('resources/images/icon-workflow.png') !!}"
                        alt="Lightning"
                        class="w-full mb-6"
                    >
                    <h3 class="max-sm:text-2xl text-xl font-semibold mb-2">Custom Starter Kits</h3>
                    <p class="max-sm:text-lg text-gray-600">Create and share your own starter kits to supercharge your development workflow.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Pricing Section -->
    <section id="pricing" class="py-16 md:py-24 bg-gray-50">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl font-bold text-center mb-12 md:mb-16">Free & Open Source</h2>
            <div class="grid grid-cols-1 gap-8 max-w-2xl mx-auto">
                <div class="flex flex-col bg-white p-8 rounded-xl shadow-sm border-2 border-primary-500">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-xl font-semibold">Laravel Artisan</h3>
                    </div>
                    <p class="text-gray-600 mb-4">For all Laravel developers</p>
                    <div class="text-4xl font-bold mb-6">
                        <span data-price-amount>$0</span>
                        <p class="text-sm font-normal text-gray-500 h-5" data-annual-note>
                            free forever
                        </p>
                    </div>
                    <ul class="flex-1 space-y-3 mb-8">
                        <li class="flex items-center">
                            <svg class="w-5 h-5 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            Connect Github Organisations
                        </li>
                        <li class="flex items-center">
                            <svg class="w-5 h-5 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            Unlimited projects
                        </li>
                        <li class="flex items-center">
                            <svg class="w-5 h-5 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            Official & Community starter kits
                        </li>
                        <li class="flex items-center">
                            <svg class="w-5 h-5 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            Custom starter kits
                        </li>
                    </ul>
                    <a
                        href="/login"
                        class="w-full block text-center bg-primary-500 text-white px-6 py-3 rounded-lg hover:bg-primary-600 transition"
                    >
                        Get Started
                    </a>
                </div>
            </div>
        </div>
    </section>

    @include('partials.footer')
</body>
</html>
