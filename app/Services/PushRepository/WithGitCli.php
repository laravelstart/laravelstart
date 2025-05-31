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

class WithGitCli implements PushRepositoryContract
{
    private string $token;

    private string $userName;

    private string $userEmail;

    public function __construct(private readonly Git $git)
    {
    }

    /**
     * @throws GitException
     */
    public function handle(string $localRepoPath, GitRepository $target, string $commitMessage): array
    {
        try {
            $repo = $this->git->init($localRepoPath);

            $repo->execute('config', 'user.name', "\"{$this->userName}\"");
            $repo->execute('config', 'user.email', "\"{$this->userEmail}\"");

            $repo->addAllChanges();
            $repo->commit($commitMessage);
            $repo->addRemote(
                'origin',
                "https://{$this->token}:x-oauth-basic@github.com/{$target->owner}/{$target->name}.git",
            );
            $repo->execute('branch', '-M', 'main');
            $repo->push(['origin', 'main'], ['-u']);

            $lastCommit = $repo->getLastCommit();
            return [
                'commit_sha' => $lastCommit->getId()->toString(),
                'message' => $lastCommit->getSubject(),
                'author' => $lastCommit->getCommitterName(),
                'email' => $lastCommit->getCommitterEmail(),
                'created_at' => $lastCommit->getCommitterDate(),
            ];
        } catch (GitException $exception) {
            Log::debug($exception->getMessage());
            Log::debug($exception->getRunnerResult()?->getErrorOutputAsString());
            Log::debug('Commit message: ' . $commitMessage);
            Log::debug('Token: ' . $this->token);
            Log::debug('Remote: ' . "https://{$this->token}:x-oauth-basic@github.com/{$target->owner}/{$target->name}.git");
            Log::debug(implode(' | ', $repo->execute('status')));

            throw $exception;
        }
    }

    public function authorize(User $user): void
    {
        $this->token = $user->token;
        $this->userName = $user->name;
        $this->userEmail = $user->email;
    }
}
