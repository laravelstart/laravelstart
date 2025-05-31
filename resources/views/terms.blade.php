<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Terms & Conditions - {{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    @include('partials/favicon')
    @vite(['resources/js/landing.ts'])
</head>
<body class="font-sans antialiased">
    <!-- Header -->
    <header class="fixed w-full bg-white/80 backdrop-blur-sm z-50 border-b border-gray-100">
        <nav class="container mx-auto px-4 py-4 flex items-center justify-between">
            <a href="{{ url('/') }}" class="flex items-center gap-2">
                <img src="{!! \Illuminate\Support\Facades\Vite::asset('resources/images/logo_icon.webp') !!}" alt="Laravel Start" class="w-12 h-12">
                <span class="text-xl font-bold text-gray-900">Laravel Start</span>
            </a>
            <div class="flex items-center gap-6">
                @guest
                <a href="/login" class="bg-primary-500 text-white px-4 py-2 rounded-lg hover:bg-primary-600 transition">
                    Get Started
                </a>
                @endguest

                @auth
                <div class="flex items-center gap-x-4">
                    <span class="text-lg text-default-800">👋 hey, {{ auth()->user()->name }}!</span>
                    <a href="/dashboard" class="bg-primary-500 text-white px-4 py-2 rounded-lg hover:bg-primary-600 transition">
                        Go to dashboard
                    </a>
                </div>
                @endauth
            </div>
        </nav>
    </header>

    <section class="pt-32 pb-24 bg-gradient-to-b from-white to-gray-50">
        <div class="prose container max-w-4xl mx-auto px-4">
            <x-markdown>
# Terms and Conditions
**Effective Date:** {{ $effectiveDate->format('Y/m/d') }}

## 1. Introduction
Welcome to **Laravel Start** ("Service"), operated by Dmytro Shatrov, an individual entrepreneur registered in **Ukraine** ("we," "our," or "us"). These Terms and Conditions ("Terms") govern your use of our Service, accessible at [startapp.laravel.cloud](https://startapp.laravel.cloud). By using our Service, you agree to these Terms. If you do not agree, please do not use our Service.

## 2. Service Description
Laravel Start enables developers to connect their **GitHub** accounts and create new projects from Laravel starter kits quickly.

## 3. Eligibility
You must be at least 18 years old or meet the legal age of majority in your jurisdiction to use our Service.

## 4. User Responsibilities
By using Laravel Start, you agree:
- To provide accurate information when signing up.
- Not to use the Service for illegal or unauthorized activities.
- To comply with GitHub’s terms of service when connecting your account.

## 5. Free & Open Source Service
Laravel Start is now completely free to use and open source under the MIT License. You can view the source code and license details on our GitHub repository. There are no subscription fees or paid plans.

## 6. Open Source Contributions
We welcome contributions to the Laravel Start project. By contributing to the project, you agree that your contributions will be licensed under the same MIT License that covers the project.

## 7. Intellectual Property
Laravel Start does not claim any intellectual property rights over the content users create using the Service.

## 8. Liability Disclaimer
- The Service is provided "as is" and "as available" without warranties of any kind.
- We do not guarantee uninterrupted or error-free service.
- We are not responsible for data loss, unauthorized access, or any damages resulting from using the Service.

## 9. Privacy & Data Handling
We comply with **GDPR**. Our **Privacy Policy** is available at **/privacy-policy**. By using Laravel Start, you agree to our data handling practices.

## 10. Governing Law & Dispute Resolution
These Terms are governed by the **laws of Ukraine**. Any disputes arising from these Terms will be resolved in the courts of Ukraine.

## 11. Changes to Terms
We may update these Terms from time to time. Users will be notified of significant changes. Continued use of the Service after changes means acceptance of the new Terms.

## 12. Contact Information
For legal inquiries or support, contact:
📧 **{{ $supportEmail }}**

Registered in **Ukraine**
            </x-markdown>
        </div>
    </section>

    @include('partials.footer')
</body>
</html>
