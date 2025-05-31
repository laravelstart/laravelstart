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
        DB::table('apps')->delete();
        DB::table('starter_kits')->delete();

        Schema::table('starter_kits', function (Blueprint $table) {
            $table->unique('slug');
        });
    }
};
