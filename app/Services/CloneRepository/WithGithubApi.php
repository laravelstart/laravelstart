<?php

declare(strict_types=1);

namespace App\Services\CloneRepository;

use App\Models\User;
use App\Support\GitRepository;
use Github\AuthMethod;
use Github\Client;
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

        $readme = $this->github
            ->repository()
            ->contents()
            ->show($source->owner, $source->name, 'README.md', reference: $source->branch);

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

        file_put_contents(
            $localRepoPath . '/README.md',
            base64_decode($readme['content']),
        );

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
//
//    private function prepareFilesForGitHub($dir, GitRepository $target) {
//        $files = [];
//        $iterator = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($dir));
//
//        /** @var \SplFileInfo $file */
//        foreach ($iterator as $file) {
//            if ($file->isFile()) {
//
//                $relativePath = str_replace($dir, '', $file->getPathname() );
//                $relativePath = trim($relativePath, '/');
//
//                $content = file_get_contents($file->getPathname());
//
//                $blob = $this->github->api('gitData')->blobs()->create($target->organisation, $target->name, [
//                    'content' => base64_encode($content),
//                    'encoding' => 'base64'
//                ]);
//
//                $files[] = [
//                    'path' => $relativePath,
//                    'mode' => '100644',
//                    'type' => 'blob',
//                    'sha' => $blob['sha']
//                ];
//            }
//        }
//
//        return $files;
//    }
//
//    private function commitFiles(string $path, GitRepository $target): void
//    {
//        $branchInfo = $this->github->api('repo')->branches($target->organisation, $target->name, $target->branch);
//        $latestCommitSha = $branchInfo['commit']['sha'];
//        $latestTreeSha = $branchInfo['commit']['commit']['tree']['sha'];
//
////        $filesToUpload = $this->prepareFilesForGitHub($path, $target);
//
//// Step 5: Create a new tree
//        $newTree = $this->github->api('gitData')->trees()->create($target->organisation, $target->name, [
//            'tree' => [],
//            'base_tree' => $latestTreeSha,
//        ]);
//
//        $newTreeSha = $newTree['sha'];
//
//// Step 6: Create a new commit
//        $newCommit = $this->github->api('gitData')->commits()->create($target->organisation, $target->name, [
//            'message' => 'Init commit',
//            'tree' => $newTreeSha,
//        ]);
//
//        $newCommitSha = $newCommit['sha'];
//
//// Step 7: Update the branch reference to the new commit
//        $this->github->api('gitData')->references()->update(
//            $target->organisation,
//            $target->name,
//            "refs/heads/{$target->branch}",
//            [
//                'sha' => $newCommitSha
//            ]);
//
//    }
    public function authorize(User $user): void
    {
        $this->github->authenticate($user->token, AuthMethod::ACCESS_TOKEN);
    }
}
