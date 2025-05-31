<?php

declare(strict_types=1);

namespace App\Http\Controllers\Projects\Show;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProjectResource;
use App\Models\Project;
use App\Support\PageMeta;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PageController extends Controller
{
    public function __invoke(Project $project, Request $request)
    {
        if ($project->user_id !== $request->user()->id) {
            abort(404);
        }

        PageMeta::setTitle("Projects/{$project->repo_owner}/{$project->repo_name}");

        $project->load('starterKit');

        return Inertia::render('Projects/Show/Page', [
            'project' => new ProjectResource($project),
        ]);
    }
}
