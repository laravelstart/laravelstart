<?php

use App\Models\StarterKit;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $lastId = DB::table('starter_kits')->max('id');

        DB::table('starter_kits')->insert([
            'id' => $lastId + 1,
            'title' => 'Modern SaaS Starter Kit - React & Inertia',
            'slug' => 'modern-saas-starter-kit-react-inertia',
            'repo_organisation' => 'shipfastlabs',
            'repo_name' => 'larasonic-react',
            'repo_branch' => 'main',
            'user_id' => null,
            'is_public' => true,
            'composer_dependencies' => '[{"package": "echolabsdev/prism", "version": "^0.26.0"}, {"package": "filament/filament", "version": "^3.2"}, {"package": "inertiajs/inertia-laravel", "version": "^2.0"}, {"package": "laravel/cashier", "version": "^15.5"}, {"package": "laravel/framework", "version": "^11.9"}, {"package": "laravel/jetstream", "version": "^5.3"}, {"package": "laravel/octane", "version": "^2.5"}, {"package": "laravel/sanctum", "version": "^4.0"}, {"package": "laravel/socialite", "version": "^5.16"}, {"package": "laravel/tinker", "version": "^2.9"}, {"package": "pinkary-project/type-guard", "version": "^0.1.0"}, {"package": "resend/resend-php", "version": "^0.14.0"}, {"package": "sentry/sentry-laravel", "version": "^4.10"}, {"package": "spatie/laravel-sitemap", "version": "^7.3"}, {"package": "symfony/mailer", "version": "~7.1.0"}, {"package": "tightenco/ziggy", "version": "^2.0"}]',
            'node_dependencies' => '[{"package": "@hookform/resolvers", "version": "^3.10.0"}, {"package": "@iconify/react", "version": "^5.2.0"}, {"package": "@inertiajs/react", "version": "^2.0.5"}, {"package": "@radix-ui/react-accordion", "version": "^1.2.3"}, {"package": "@radix-ui/react-alert-dialog", "version": "^1.1.6"}, {"package": "@radix-ui/react-aspect-ratio", "version": "^1.1.2"}, {"package": "@radix-ui/react-avatar", "version": "^1.1.3"}, {"package": "@radix-ui/react-checkbox", "version": "^1.1.4"}, {"package": "@radix-ui/react-collapsible", "version": "^1.1.3"}, {"package": "@radix-ui/react-context-menu", "version": "^2.2.6"}, {"package": "@radix-ui/react-dialog", "version": "^1.1.6"}, {"package": "@radix-ui/react-dropdown-menu", "version": "^2.1.6"}, {"package": "@radix-ui/react-hover-card", "version": "^1.1.6"}, {"package": "@radix-ui/react-label", "version": "^2.1.2"}, {"package": "@radix-ui/react-menubar", "version": "^1.1.6"}, {"package": "@radix-ui/react-navigation-menu", "version": "^1.2.5"}, {"package": "@radix-ui/react-popover", "version": "^1.1.6"}, {"package": "@radix-ui/react-progress", "version": "^1.1.2"}, {"package": "@radix-ui/react-radio-group", "version": "^1.2.3"}, {"package": "@radix-ui/react-scroll-area", "version": "^1.2.3"}, {"package": "@radix-ui/react-select", "version": "^2.1.6"}, {"package": "@radix-ui/react-separator", "version": "^1.1.2"}, {"package": "@radix-ui/react-slider", "version": "^1.2.3"}, {"package": "@radix-ui/react-slot", "version": "^1.1.2"}, {"package": "@radix-ui/react-switch", "version": "^1.1.3"}, {"package": "@radix-ui/react-tabs", "version": "^1.1.3"}, {"package": "@radix-ui/react-toast", "version": "^1.2.6"}, {"package": "@radix-ui/react-toggle", "version": "^1.1.2"}, {"package": "@radix-ui/react-toggle-group", "version": "^1.1.2"}, {"package": "@radix-ui/react-tooltip", "version": "^1.1.8"}, {"package": "@tailwindcss/forms", "version": "^0.5.10"}, {"package": "@tailwindcss/postcss", "version": "^4.0.12"}, {"package": "@tailwindcss/typography", "version": "^0.5.16"}, {"package": "@unhead/addons", "version": "^2.0.0-rc.9"}, {"package": "@unhead/react", "version": "^2.0.0-rc.9"}, {"package": "@unovis/ts", "version": "^1.5.1"}, {"package": "@vitejs/plugin-react", "version": "^4.3.4"}, {"package": "axios", "version": "^1.8.2"}, {"package": "change-case", "version": "^5.4.4"}, {"package": "chokidar", "version": "^4.0.3"}, {"package": "class-variance-authority", "version": "^0.7.1"}, {"package": "clsx", "version": "^2.1.1"}, {"package": "cmdk", "version": "1.0.0"}, {"package": "concurrently", "version": "^9.1.2"}, {"package": "date-fns", "version": "^4.1.0"}, {"package": "embla-carousel-react", "version": "^8.5.2"}, {"package": "input-otp", "version": "^1.4.2"}, {"package": "lucide-react", "version": "^0.475.0"}, {"package": "next-themes", "version": "^0.4.5"}, {"package": "postcss", "version": "^8.5.3"}, {"package": "react", "version": "^19.0.0"}, {"package": "react-day-picker", "version": "9.5.1"}, {"package": "react-dom", "version": "^19.0.0"}, {"package": "react-hook-form", "version": "^7.54.2"}, {"package": "react-resizable-panels", "version": "^2.1.7"}, {"package": "recharts", "version": "^2.15.1"}, {"package": "sonner", "version": "^2.0.1"}, {"package": "tailwind-merge", "version": "^3.0.2"}, {"package": "tailwindcss", "version": "^4.0.12"}, {"package": "tailwindcss-animate", "version": "^1.0.7"}, {"package": "vaul", "version": "^1.1.2"}, {"package": "vite", "version": "6.0.11"}, {"package": "ziggy-js", "version": "^2.5.2"}, {"package": "zod", "version": "^3.24.2"}, {"package": "@antfu/eslint-config", "version": "^4.8.1"}, {"package": "@eslint-react/eslint-plugin", "version": "^1.31.0"}, {"package": "eslint", "version": "^9.22.0"}, {"package": "eslint-plugin-format", "version": "^1.0.1"}, {"package": "eslint-plugin-react-hooks", "version": "^5.2.0"}, {"package": "eslint-plugin-react-refresh", "version": "^0.4.19"}, {"package": "laravel-vite-plugin", "version": "^1.2.0"}]',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('starter_kits')->insert([
            'id' => $lastId + 2,
            'title' => 'Modern SaaS Starter Kit - Vue & Inertia',
            'slug' => 'modern-saas-starter-kit-vue-inertia',
            'repo_organisation' => 'shipfastlabs',
            'repo_name' => 'larasonic-vue',
            'repo_branch' => 'main',
            'user_id' => null,
            'is_public' => true,
            'composer_dependencies' => '[{"package": "echolabsdev/prism", "version": "^0.26.0"}, {"package": "filament/filament", "version": "^3.2"}, {"package": "inertiajs/inertia-laravel", "version": "^2.0"}, {"package": "laravel/cashier", "version": "^15.5"}, {"package": "laravel/framework", "version": "^11.9"}, {"package": "laravel/jetstream", "version": "^5.3"}, {"package": "laravel/octane", "version": "^2.5"}, {"package": "laravel/sanctum", "version": "^4.0"}, {"package": "laravel/socialite", "version": "^5.16"}, {"package": "laravel/tinker", "version": "^2.9"}, {"package": "pinkary-project/type-guard", "version": "^0.1.0"}, {"package": "resend/resend-php", "version": "^0.14.0"}, {"package": "sentry/sentry-laravel", "version": "^4.10"}, {"package": "spatie/laravel-sitemap", "version": "^7.3"}, {"package": "symfony/mailer", "version": "~7.1.0"}, {"package": "tightenco/ziggy", "version": "^2.0"}]',
            'node_dependencies' => '[{"package": "@ai-sdk/vue", "version": "^1.1.20"}, {"package": "@iconify/vue", "version": "^4.3.0"}, {"package": "@inertiajs/vue3", "version": "^2.0.5"}, {"package": "@tailwindcss/forms", "version": "^0.5.10"}, {"package": "@tailwindcss/postcss", "version": "^4.0.12"}, {"package": "@tailwindcss/typography", "version": "^0.5.16"}, {"package": "@tanstack/vue-table", "version": "^8.21.2"}, {"package": "@unhead/addons", "version": "^1.11.20"}, {"package": "@unhead/vue", "version": "^1.11.20"}, {"package": "@unovis/ts", "version": "^1.5.1"}, {"package": "@unovis/vue", "version": "^1.5.1"}, {"package": "@vee-validate/zod", "version": "^4.15.0"}, {"package": "@vitejs/plugin-vue", "version": "^5.2.1"}, {"package": "@vueuse/core", "version": "^12.8.2"}, {"package": "@vueuse/integrations", "version": "^12.8.2"}, {"package": "axios", "version": "^1.8.2"}, {"package": "change-case", "version": "^5.4.4"}, {"package": "chokidar", "version": "^4.0.3"}, {"package": "class-variance-authority", "version": "^0.7.1"}, {"package": "clsx", "version": "^2.1.1"}, {"package": "concurrently", "version": "^9.1.2"}, {"package": "embla-carousel-vue", "version": "^8.5.2"}, {"package": "lucide-vue-next", "version": "^0.462.0"}, {"package": "postcss", "version": "^8.5.3"}, {"package": "radix-vue", "version": "^1.9.17"}, {"package": "tailwind-merge", "version": "^2.6.0"}, {"package": "tailwindcss", "version": "^4.0.12"}, {"package": "tailwindcss-animate", "version": "^1.0.7"}, {"package": "v-calendar", "version": "^3.1.2"}, {"package": "vaul-vue", "version": "^0.2.1"}, {"package": "vee-validate", "version": "^4.15.0"}, {"package": "vite", "version": "6.0.11"}, {"package": "vue", "version": "^3.5.13"}, {"package": "vue-sonner", "version": "^1.3.0"}, {"package": "ziggy-js", "version": "^2.5.2"}, {"package": "zod", "version": "^3.24.2"}, {"package": "@antfu/eslint-config", "version": "^3.16.0"}, {"package": "eslint", "version": "^9.22.0"}, {"package": "eslint-plugin-format", "version": "^0.1.3"}, {"package": "eslint-plugin-vue", "version": "^9.33.0"}, {"package": "laravel-vite-plugin", "version": "^1.2.0"}]',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
};
