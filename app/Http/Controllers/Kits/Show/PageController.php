<?php

declare(strict_types=1);

namespace App\Http\Controllers\Kits\Show;

use App\Http\Controllers\Controller;
use App\Http\Resources\StarterKitResource;
use App\Models\StarterKit;
use App\Support\PageMeta;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PageController extends Controller
{
    public function __invoke(StarterKit $kit, Request $request)
    {
        if (!$request->user() && !$kit->is_public) {
            abort(404);
        }

        if ($request->user()?->cannot('see', $kit)) {
            abort(404);
        }

        $kit->load('user');

        PageMeta::setTitle($kit->title);
        PageMeta::setProps([
            'og:title' => $kit->title,
            'og:description' => "Start fresh Laravel project from {$kit->title}!",
            'og:image' => url($kit->getPreviewImagePath()),
            'og:url' => url("/kits/{$kit->slug}"),
            'og:type' => 'website',
            'og:site_name' => config('app.name'),
        ]);
        PageMeta::setMeta([
            'twitter:card' => 'summary_large_image',
            'twitter:title' => $kit->title,
            'twitter:description' => "Start fresh Laravel project from {$kit->title}!",
            'twitter:image' => url($kit->getPreviewImagePath()),
            'twitter:site' => "@webpnk_dev",
            'twitter:creator' => "@webpnk_dev",
        ]);

        return Inertia::render('Kits/Show/Page', [
            'kit' => new StarterKitResource($kit),
        ]);
    }
}
