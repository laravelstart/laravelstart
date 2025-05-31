<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::table('apps')->delete();
        DB::table('starter_kits')->delete();

        $csvFile = database_path('data/starter_kits.csv');
        if (!file_exists($csvFile)) {
            throw new Exception('CSV file not found: ' . $csvFile);
        }

        $file = fopen($csvFile, 'r');

        // Skip the header row
        $headers = fgetcsv($file);

        while (($data = fgetcsv($file)) !== false) {
            $row = array_combine($headers, $data);

            DB::table('starter_kits')->insert([
                'id' => $row['id'],
                'title' => $row['title'],
                'slug' => $row['slug'],
                'repo_organisation' => $row['repo_organisation'],
                'repo_name' => $row['repo_name'],
                'repo_branch' => $row['repo_branch'],
                'user_id' => $row['user_id'] ?: null,
                'is_public' => $row['is_public'],
                'composer_dependencies' => $row['composer_dependencies'],
                'node_dependencies' => $row['node_dependencies'],
                'created_at' => $row['created_at'],
                'updated_at' => $row['updated_at']
            ]);
        }

        fclose($file);
    }
};
