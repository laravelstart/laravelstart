<?php

declare(strict_types=1);

namespace App\Services\CloneRepository;

use App\Models\User;
use App\Support\GitRepository;
use Github\AuthMethod;
use Github\Client;
use Github\Exception\RuntimeException as GithubException;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use RuntimeException;
use ZipArchive;

class WithGithubApi implements CloneRepositoryContract
{
    public function __construct(protected readonly Client $github)
    {
    }

    public function handle(GitRepository $source): string
    {
        $zip = $this->github->api('repo')
            ->contents()
            ->archive($source->owner, $source->name, 'zipball', $source->branch);



        $tmpDirName = "{$source->owner}_{$source->name}_{$source->branch}_" . time();
        $tmpFileName = "{$tmpDirName}/archive.zip";

        Storage::disk('temp')->put($tmpFileName, $zip);

        $this->unzip(
            Storage::disk('temp')->path($tmpDirName),
            'archive.zip',
        );

        $unzippedDirs = File::directories(
            Storage::disk('temp')->path($tmpDirName) . "/unzip",
            true
        );

        $localRepoPath = $unzippedDirs[0];

        $this->pullReadme($source, $localRepoPath);

        return $localRepoPath;
    }

    private function unzip(string $directory, string $fileName): void
    {
        $zip = new ZipArchive;

        if ($zip->open("{$directory}/{$fileName}") === TRUE) {
            $zip->extractTo("{$directory}/unzip");
            $zip->close();
        } else {
            throw new RuntimeException('Unable to unzip');
        }
    }

    private function pullReadme(GitRepository $source, string $localRepoPath): void
    {
        try {
            $readme = $this->github
                ->repository()
                ->contents()
                ->show($source->owner, $source->name, 'README.md', reference: $source->branch);

            file_put_contents(
                $localRepoPath . '/README.md',
                base64_decode($readme['content']),
            );
        } catch (GithubException) {
            return;
        }
    }

    public function authorize(User $user): void
    {
        $this->github->authenticate($user->token, AuthMethod::ACCESS_TOKEN);
    }
}
