<?php

namespace App\Console\Commands;

use App\Models\StarterKit;
use App\Services\ParseComposerDependencies\ParseComposerDependenciesContract;
use App\Services\ParseNodeDependencies\ParseNodeDependenciesContract;
use Github\Client;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Auth;

class CreateKit extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:create-kit {owner} {repo} {branch} {title}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle(
        ParseComposerDependenciesContract $parseDependencies,
        ParseNodeDependenciesContract $parseNodeDependencies,
        Client $github,
    )
    {
        $owner = $this->argument('owner');
        $repo = $this->argument('repo');
        $branch = $this->argument('branch');
        $title = $this->argument('title');

        $composerJsonRaw = $github
            ->repository()
            ->contents()
            ->show($owner, $repo, 'composer.json', reference: $branch);

        $composerDependencies = $parseDependencies->handle(
            base64_decode($composerJsonRaw['content'])
        );

        $packageJsonRaw = $github
            ->repository()
            ->contents()
            ->show($owner, $repo, 'package.json', reference: $branch);

        if ($packageJsonRaw) {
            $nodeDependencies = $parseNodeDependencies->handle(
                base64_decode($packageJsonRaw['content']),
            );
        } else {
            $nodeDependencies = null;
        }

        $kit = StarterKit::query()->create([
            'title' => $title,
            'slug' => str($title)->slug(),
            'repo_organisation' => $owner,
            'repo_name' => $repo,
            'repo_branch' => $branch,
            'composer_dependencies' => $composerDependencies,
            'node_dependencies' => $nodeDependencies,
            'is_public' => true,
        ]);

        $this->info("Created kit with id " . $kit->id);
    }
}
