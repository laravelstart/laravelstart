<?php

declare(strict_types=1);

namespace App\Services\PushRepository;

use App\Models\User;
use App\Support\GitRepository;
use DateTimeImmutable;

interface PushRepositoryContract
{
    /**
     * @param string $localRepoPath
     * @param GitRepository $target
     * @param string $commitMessage
     * @return array{
     *     commit_sha: string,
     *     message: string,
     *     author: string,
     *     email: string,
     *     created_at: DateTimeImmutable,
     * }
     */
    public function handle(string $localRepoPath, GitRepository $target, string $commitMessage): array;

    public function authorize(User $user): void;
}
