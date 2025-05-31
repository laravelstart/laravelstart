<?php

namespace App\Console\Commands;

use App\Mail\NewStarterKitMail;
use App\Models\StarterKit;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class NotifyAboutNewStarterKit extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'notify:new-kit {kitId}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send notification emails to all active users with new kit notification';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $kit = StarterKit::query()->findOrFail($this->argument('kitId'));

        User::all()->each(function (User $user) use ($kit) {
            Mail::to($user)->send(new NewStarterKitMail($kit, $user));
        });

        return 0;
    }
}
