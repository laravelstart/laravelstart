<?php

declare(strict_types=1);

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProjectResource;
use App\Http\Resources\StarterKitResource;
use App\Models\StarterKit;
use App\Support\PageMeta;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class PageController extends Controller
{
    public function __invoke(Request $request)
    {
        PageMeta::setTitle('Dashboard');

        $kitsType = $request->get('type', 'official');

        /** @var Collection<int, StarterKit> $pinnedKits */
        $pinnedKits = $request->user()
            ->pinnedKits()
            ->with('kit')
            ->orderBy('created_at', 'desc')
            ->get()
            ->map->kit;

        $official = StarterKit::query()
            ->where('is_public', '=', true)
            ->where('repo_organisation', '=', 'laravel')
            ->limit(3)
            ->orderBy('created_at', 'desc')
            ->get();

        $community = StarterKit::query()
            ->where('is_public', '=', true)
            ->where('repo_organisation', '!=', 'laravel')
            ->orderBy('created_at', 'desc')
            ->limit(3)
            ->get();

        $my = StarterKit::query()
            ->where('user_id', '=', Auth::id())
            ->orderBy('created_at', 'desc')
            ->limit(3)
            ->get();

        $recentProjects = $request->user()
            ->projects()
            ->with('starterKit')
            ->orderBy('created_at', 'desc')
            ->limit(8)
            ->get();

        return Inertia::render('Dashboard/Page', [
            'type' => $kitsType,
            'pinnedKits' => StarterKitResource::collection($pinnedKits),
            'recentKits' => [
                'official' => StarterKitResource::collection($official),
                'community' => StarterKitResource::collection($community),
                'my' => StarterKitResource::collection($my),
            ],
            'recentProjects' => ProjectResource::collection($recentProjects),
        ]);
    }
}
