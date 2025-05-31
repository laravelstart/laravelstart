<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StarterKitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('starter_kits')->insert([
            [
                'title' => 'Laravel + Livewire Starter Kit',
                'slug' => 'laravel-livewire-starter-kit',
                'repo_organisation' => 'laravel',
                'repo_name' => 'livewire-starter-kit',
                'repo_branch' => 'main',
                'is_public' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Laravel + Livewire + WorkOS Starter Kit',
                'slug' => 'laravel-livewire-workos-starter-kit',
                'repo_organisation' => 'laravel',
                'repo_name' => 'livewire-starter-kit',
                'repo_branch' => 'workos',
                'is_public' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Laravel + React Starter Kit',
                'slug' => 'laravel-react-starter-kit',
                'repo_organisation' => 'laravel',
                'repo_name' => 'react-starter-kit',
                'repo_branch' => 'main',
                'is_public' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Laravel + React + WorkOS Starter Kit',
                'slug' => 'laravel-react-workos-starter-kit',
                'repo_organisation' => 'laravel',
                'repo_name' => 'react-starter-kit',
                'repo_branch' => 'workos',
                'is_public' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Laravel + Vue Starter Kit',
                'slug' => 'laravel-vue-starter-kit',
                'repo_organisation' => 'laravel',
                'repo_name' => 'vue-starter-kit',
                'repo_branch' => 'main',
                'is_public' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Laravel & HeroUI Template',
                'slug' => 'laravel-hero-ui-template',
                'repo_organisation' => 'heroui-inc',
                'repo_name' => 'laravel-template',
                'repo_branch' => 'master',
                'is_public' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Laravel + Svelte Starter Kit',
                'slug' => 'laravel-svelte-starter-kit',
                'repo_organisation' => 'oseughu',
                'repo_name' => 'svelte-starter-kit',
                'repo_branch' => 'main',
                'is_public' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
