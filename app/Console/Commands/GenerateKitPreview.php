<?php

namespace App\Console\Commands;

use App\Models\StarterKit;
use Illuminate\Console\Command;
use Spatie\Browsershot\Browsershot;

class GenerateKitPreview extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:kit-preview {kit}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $kit = StarterKit::query()->findOrFail($this->argument('kit'));

        $now = time();
        $outDir = public_path('images/previews');
        $filename = "{$kit->slug}-{$now}.png";

        Browsershot::url(url("/kits/{$kit->id}/preview"))->save(
            "{$outDir}/{$filename}"
        );

        $kit->update([
            'preview_image' => "{$kit->slug}-{$now}.png",
        ]);
    }
}
