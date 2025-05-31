<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Privacy Policy - {{ config('app.name', 'Laravel') }}</title>

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
# Privacy Policy
**Effective Date:** {{ $effectiveDate->format('Y/m/d') }}

## 1. Introduction
This Privacy Policy explains how we collect, use, store, and protect personal data when users sign up through our GitHub OAuth app. We are committed to complying with the General Data Protection Regulation (GDPR) and ensuring the security and privacy of user data.

## 2. Data We Collect
When users authenticate via GitHub OAuth, we collect and store the following data:

- **Basic Identifiers**:
- Email address
- GitHub username
- GitHub ID

- **Authentication Data**:
- GitHub OAuth token (stored until expired and replaced with a new token)

- **GitHub-Related Data (Identifiers Only, No Content)**:
- List of GitHub organizations the user belongs to
- List of the user’s personal GitHub repositories
- List of repositories within the user’s GitHub organizations

## 3. How We Collect Data
We collect this data via the **GitHub API** using the GitHub OAuth token provided by the user during authentication.

## 4. Purpose of Data Collection
We collect and process user data for the following purposes:
- **Authentication & Account Management**: To enable users to log in securely via GitHub OAuth.
- **Access Control & Authorization**: To determine user permissions based on their GitHub repositories and organizations.
- **User Experience & Feature Enablement**: To personalize and optimize services based on GitHub-related data.

## 5. Data Retention
We store data as follows:
- **Email & GitHub Username**: Stored indefinitely unless a deletion request is made.
- **GitHub OAuth Token**: Stored until it expires and is replaced with a new token via the GitHub OAuth flow.
- **GitHub Repository & Organization Identifiers**: Stored in cache, with a lifespan ranging from **30 minutes to indefinite**, depending on system caching behavior.
- **User Data Deletion**: Users may request data deletion at any time (see Section 8 – User Rights).

## 6. Data Storage & Security
- All data is securely stored using **Neon**, a serverless database provider.
- We implement industry-standard security measures, including encryption, access controls, and database security, to prevent unauthorized access, alteration, disclosure, or destruction of user data.

## 7. Sharing of Data with Third Parties
We do **not** share or sell user data to third parties. Data is used solely for authentication, access control, and application functionality.

## 8. User Rights under GDPR
Under GDPR, users have the following rights regarding their personal data:
- **Right to Access** – Users can request a copy of the personal data we store.
- **Right to Rectification** – Users can request corrections to their stored data.
- **Right to Erasure ("Right to Be Forgotten")** – Users can request deletion of their personal data.
- **Right to Restriction of Processing** – Users can request that their data processing be limited under certain conditions.
- **Right to Data Portability** – Users can request their data in a structured, commonly used format.
- **Right to Object** – Users can object to certain types of data processing.

### How to Exercise Your Rights
Users can request to view, update, or delete their personal data by contacting our support team at:
📧 **{{ $supportEmail }}**

## 9. Changes to This Privacy Policy
We may update this Privacy Policy from time to time. Any changes will be communicated to users through our website or email notifications.

## 10. Contact Information
For any questions regarding this Privacy Policy or data-related inquiries, users can contact:
📧 **{{ $supportEmail }}**
            </x-markdown>
        </div>
    </section>

    @include('partials.footer')
</body>
</html>
