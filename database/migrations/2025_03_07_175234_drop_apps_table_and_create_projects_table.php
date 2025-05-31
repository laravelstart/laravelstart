<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::dropIfExists('apps');

        Schema::create('projects', function (Blueprint $table) {
            $table->id();

            $table->foreignId('starter_kit_id')
                ->nullable(false)
                ->constrained();

            $table->foreignId('user_id')
                ->nullable(false)
                ->constrained();

            $table->string('github_id');
            $table->string('repo_owner');
            $table->string('repo_name');
            $table->boolean('is_organisation');
            $table->boolean('is_private');

            $table->string('repo_url');
            $table->string('ssh_url');
            $table->string('https_url');

            $table->jsonb('commit')->nullable();

            $table->timestamps();
        });
    }
};
