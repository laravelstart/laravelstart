<?php

namespace App\Services\PushRepository;

use App\Models\User;
use App\Support\GitRepository;
use CzProject\GitPhp\Git;
use CzProject\GitPhp\GitException;
use Github\AuthMethod;
use Github\Client;
use Illuminate\Support\Facades\Log;
use RuntimeException;

class Fake implements PushRepositoryContract
{
    public function handle(string $localRepoPath, GitRepository $target, string $commitMessage): array
    {
        return [
            'commit_sha' => 'fa18fa18fa18fa18fa18fa18fa18',
            'message' => 'Test Message',
            'author' => 'webpnk',
            'email' => 'test@laravelstart.app',
            'created_at' => [
                'date' => now()->format('Y-m-d H:i:s'),
            ],
        ];
    }

    public function authorize(User $user): void
    {
    }
}
