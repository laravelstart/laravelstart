<?php

declare(strict_types=1);

namespace App\Http\Controllers\Projects;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\StarterKit;
use App\Services\CloneRepository\CloneRepositoryContract;
use App\Services\CreateRepository\CreateRepositoryContract;
use App\Services\PushRepository\PushRepositoryContract;
use Illuminate\Http\RedirectResponse;

class StoreController extends Controller
{
    public function __invoke(
        StarterKit $kit,
        StoreRequest $request,
        CreateRepositoryContract $createRepository,
        CloneRepositoryContract $clone,
        PushRepositoryContract $push,
    ): RedirectResponse
    {
        if ($request->user()->cannot('create', Project::class)) {
            return redirect()->back()->withErrors('Please upgrade to create more projects!');
        }

        if ($request->user()->cannot('see', $kit)) {
            abort(404);
        }

        $createRepository->authorize($request->user());
        $clone->authorize($request->user());
        $push->authorize($request->user());

        $source = $request->getSourceRepositoryData();
        $target = $request->getTargetRepositoryData();

        $localRepoPath = $clone->handle($source);
        $createdRepository = $createRepository->handle($target);
        $commit = $push->handle($localRepoPath, $target, $request->get('message'));

        /** @var Project $project */
        $project = $request->user()->projects()->create([
            'starter_kit_id' => $kit->id,
            'github_id' => (string) $createdRepository['id'],
            'repo_owner' => $createdRepository['owner']['login'],
            'repo_name' => $createdRepository['name'],
            'is_organisation' => $createdRepository['owner']['type'] === 'Organisation',
            'is_private' => $createdRepository['private'],
            'repo_url' => $createdRepository['html_url'],
            'https_url' => $createdRepository['clone_url'],
            'ssh_url' => $createdRepository['ssh_url'],
            'commit' => $commit,
        ]);

        $kit->increment('installs_count');

        return redirect()->to("/projects/{$project->id}")->with(
            'toast',
            "Project was successfully created from «{$source->owner}/{$source->name}»!"
        );
    }
}
