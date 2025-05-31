<?php

declare(strict_types=1);

namespace App\Http\Controllers\Browse;

use App\Http\Controllers\Controller;
use App\Http\Resources\StarterKitResource;
use App\Models\StarterKit;
use App\Support\PageMeta;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class PageController extends Controller
{
    public function __invoke(Request $request, ?string $type = null)
    {
        if (null === $type) {
            return redirect()->to('/browse/official');
        }

        if (!in_array($type, ['official', 'community', 'my'])) {
            abort(404);
        }

        if ($type === 'my' && !Auth::check()) {
            return redirect()->setIntendedUrl($request->url())->to('/login');
        }

        $capitalType = str($type)->ucfirst()->toString();
        PageMeta::setTitle("{$capitalType} Laravel Starter Kits");
        PageMeta::setDescription("Browse {$capitalType} Laravel Starter Kits on " . config('app.name'));
        PageMeta::setProps([
            'og:title' => "{$capitalType} Laravel Starter Kits",
            'og:description' => "Browse {$capitalType} Laravel Starter Kits on " . config('app.name'),
            'og:image' => url('/images/og-preview.png'),
            'og:url' => url("/browse/{$type}"),
            'og:type' => 'website',
            'og:site_name' => config('app.name'),
        ]);

        PageMeta::setMeta([
            'twitter:card' => 'summary_large_image',
            'twitter:title' => "{$capitalType} Laravel Starter Kits",
            'twitter:description' => "Browse {$capitalType} Laravel Starter Kits on " . config('app.name'),
            'twitter:image' => url('/images/og-preview.png'),
            'twitter:site' => "@webpnk_dev",
            'twitter:creator' => "@webpnk_dev",
        ]);

        $kits = StarterKit::query()
            ->when($type === 'official',
                fn (Builder $query) => $query
                    ->where('is_public', '=', true)
                    ->where('repo_organisation', '=', 'laravel')
            )
            ->when($type === 'community',
                fn (Builder $query) => $query
                    ->where('is_public', '=', true)
                    ->where('repo_organisation', '!=', 'laravel')
            )
            ->when($type === 'my',
                fn (Builder $query) => $query
                    ->where('user_id', '=', $request->user()->id)
            )
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return Inertia::render('Browse/Page', [
            'kits' => Inertia::merge(
                fn () => StarterKitResource::collection($kits->items()),
            ),
            'meta' => [
                'currentPage' => $kits->currentPage(),
                'isLastPage' => $kits->lastPage() === $kits->currentPage(),
                'total' => $kits->total(),
            ],
            'type' => $type,
        ]);
    }
}
