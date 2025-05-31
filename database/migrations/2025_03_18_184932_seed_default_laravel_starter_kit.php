<?php

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
        DB::table('starter_kits')->insert([
            'id' => 8,
            'title' => 'Vanilla Laravel 11',
            'slug' => 'vanilla-laravel-11',
            'repo_organisation' => 'laravel',
            'repo_name' => 'laravel',
            'repo_branch' => '11.x',
            'user_id' => null,
            'is_public' => true,
            'composer_dependencies' => '[{"package": "laravel/framework", "version": "^11.31"}, {"package": "laravel/tinker", "version": "^2.9"}]',
            'node_dependencies' => '[{"package": "autoprefixer", "version": "^10.4.20"}, {"package": "axios", "version": "^1.7.4"}, {"package": "concurrently", "version": "^9.0.1"}, {"package": "laravel-vite-plugin", "version": "^1.2.0"}, {"package": "postcss", "version": "^8.4.47"}, {"package": "tailwindcss", "version": "^3.4.13"}, {"package": "vite", "version": "^6.0.11"}]',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('starter_kits')->insert([
            'id' => 9,
            'title' => 'Vanilla Laravel 12',
            'slug' => 'vanilla-laravel-12',
            'repo_organisation' => 'laravel',
            'repo_name' => 'laravel',
            'repo_branch' => '12.x',
            'user_id' => null,
            'is_public' => true,
            'composer_dependencies' => '[{"package": "laravel/framework", "version": "^12.0"}, {"package": "laravel/tinker", "version": "^2.10.1"}]',
            'node_dependencies' => '[{"package": "@tailwindcss/vite", "version": "^4.0.0"}, {"package": "axios", "version": "^1.8.2"}, {"package": "concurrently", "version": "^9.0.1"}, {"package": "laravel-vite-plugin", "version": "^1.2.0"}, {"package": "tailwindcss", "version": "^4.0.0"}, {"package": "vite", "version": "^6.0.11"}]',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
};
