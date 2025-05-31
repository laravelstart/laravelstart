<?php

declare(strict_types=1);

namespace App\Http\Controllers\Kits;

use App\Http\Controllers\Controller;
use App\Models\StarterKit;
use App\Services\ParseComposerDependencies\ParseComposerDependenciesContract;
use App\Services\ParseNodeDependencies\ParseNodeDependenciesContract;
use App\Support\GithubClientFactory;
use Github\Client;
use Github\Exception\RuntimeException;
use Illuminate\Database\UniqueConstraintViolationException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class StoreController extends Controller
{
    private Client $github;

    public function __construct(
        private readonly ParseComposerDependenciesContract $parseDependencies,
        private readonly ParseNodeDependenciesContract $parseNodeDependencies,
        GithubClientFactory $factory
    )
    {
        $this->github = $factory->authenticated(Auth::user());
    }

    public function __invoke(StoreRequest $request)
    {
        $repository = $request->getSourceRepositoryData();

        try {
            $composerJsonRaw = $this->github
                ->repository()
                ->contents()
                ->show($repository->owner, $repository->name, 'composer.json', reference: $repository->branch);
        } catch (RuntimeException) {
            return redirect()->back()->withErrors('This is not a Laravel repository!');
        }

        $composerDependencies = $this->parseDependencies->handle(
            base64_decode($composerJsonRaw['content'])
        );

        $laravel = array_filter($composerDependencies,
            fn (array $dep) => $dep['package'] === 'laravel/framework',
        );

        if (!count($laravel)) {
            return redirect()->back()->withErrors('This is not a Laravel repository!');
        }

        try {
            $packageJsonRaw = $this->github
                ->repository()
                ->contents()
                ->show($repository->owner, $repository->name, 'package.json', reference: $repository->branch);
        } catch (RuntimeException) {
            $packageJsonRaw = null;
        }

        if ($packageJsonRaw) {
            $nodeDependencies = $this->parseNodeDependencies->handle(
                base64_decode($packageJsonRaw['content']),
            );
        } else {
            $nodeDependencies = null;
        }

        for ($try = 1; $try < 10; $try++) {
            try {
                $slugSuffix = $try === 1 ? '' : '-' . Str::random(5);

                $kit = StarterKit::query()->create([
                    'title' => $request->get('title'),
                    'slug' => str($request->get('title'))->slug() . $slugSuffix,
                    'repo_organisation' => $repository->owner,
                    'repo_name' => $repository->name,
                    'repo_branch' => $repository->branch,
                    'user_id' => Auth::id(),
                    'composer_dependencies' => $composerDependencies,
                    'node_dependencies' => $nodeDependencies,
                    'is_public' => $request->get('visibility') === 'public',
                ]);

                break;
            } catch (UniqueConstraintViolationException $exception) {
                Log::debug("Starter kit unique constraint failed, try " . $try);

                continue;
            }
        }

        if (!isset($kit)) {
            return redirect()->back()->withErrors('Filed to assign a unique slug for this kit. Try a different name!');
        }

        return redirect()->to("/kits/$kit->slug")->with('toast', 'Custom kit was created successfully!');
    }
}
