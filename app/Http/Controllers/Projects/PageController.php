<?php

declare(strict_types=1);

namespace App\Http\Controllers\Projects;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProjectResource;
use App\Support\PageMeta;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PageController extends Controller
{
    public function __invoke(Request $request)
    {
        PageMeta::setTitle('Projects');

        $projects = $request
            ->user()
            ->projects()
            ->with('starterKit')
            ->get();

        return Inertia::render('Projects/Page', [
            'projects' => ProjectResource::collection($projects),
        ]);
    }
}
