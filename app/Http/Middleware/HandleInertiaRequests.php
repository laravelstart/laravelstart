<?php

namespace App\Http\Middleware;

use App\Http\Resources\AuthenticatedUserResource;
use App\Models\User;
use App\Support\GithubClientFactory;
use Github\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Inertia\Inertia;
use Inertia\Middleware;
use Tighten\Ziggy\Ziggy;

class HandleInertiaRequests extends Middleware
{
    private readonly Client $github;

    public function __construct(GithubClientFactory $factory)
    {
        if (Auth::check()) {
            $this->github = $factory->authenticated(Auth::user());
        }
    }

    /**
     * The root template that is loaded on the first page visit.
     *
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determine the current asset version.
     */
    public function version(Request $request): ?string
    {
        return parent::version($request);
    }

    /**
     * Define the props that are shared by default.
     *
     * @return array<string, mixed>
     */
    public function share(Request $request): array
    {
        $user = $request->user();

        $request->validate([
            'organisation' => [
                'sometimes',
                'nullable',
                'string',
                // in: cached orgs
            ],
        ]);

        if ($user) {
            $this->trackUserAgent($user, $request);
        }

        return [
            ...parent::share($request),
            'auth' => [
                'user' => when($user, fn () => new AuthenticatedUserResource($user)),
            ],
            'ziggy' => fn () => [
                ...(new Ziggy)->toArray(),
                'location' => $request->url(),
            ],
            'organisations' => Arr::select($this->getOrganisations(), ['login', 'avatar_url']),
            'repositories' => Inertia::lazy(
                fn () => Arr::select($this->getRepositories($request->organisation), ['name', 'private']),
            ),
            'branches' => Inertia::lazy(
                fn () => Arr::pluck($this->getBranches($request->organisation, $request->repositoryName), 'name'),
            ),
            'toast' => Inertia::always($request->session()->get('toast')),
        ];
    }

    private function getOrganisations(): array
    {
        if (!isset($this->github) || !Auth::check()) {
            return [];
        }

        return Cache::remember(
            "user:" . Auth::user()->token . ":organisations",
            now()->addMinute(),
            fn () => $this->github->currentUser()->organizations(),
        );
    }

    private function getRepositories(?string $organisation = null): array
    {
        if (!isset($this->github)) {
            return [];
        }

        if ($organisation) {
            return Cache::remember(
                "user:" . Auth::user()->token . ":{$organisation}:repositories:",
                now()->addMinute(),
                fn () => $this->github->repositories()->org($organisation),
            );
        }

        return Cache::remember(
            "user:" . Auth::user()->token . ":" . Auth::user()->name . ":repositories",
            now()->addMinute(),
            fn () => $this->github->currentUser()->repositories(),
        );
    }

    private function getBranches(?string $organisation, ?string $repository): array
    {
        if (!isset($this->github) || !$repository) {
            return [];
        }

        if ($organisation) {
            return Cache::remember(
                "user:" . Auth::user()->token . ":{$organisation}:repository:{$repository}:branches",
                now()->addMinute(),
                fn () =>  $this->github->repo()->branches($organisation, $repository),
            );
        }

        return Cache::remember(
            "user:" . Auth::user()->token . ":" . Auth::user()->name . ":repository:{$repository}:branches",
            now()->addMinute(),
            fn () => $this->github->repo()->branches(Auth::user()->name, $repository),
        );
    }

    private function trackUserAgent(User $user, Request $request): void
    {
        if ($user->latest_device !== $request->userAgent()) {
            $user->update([
                'latest_device' => $request->userAgent(),
            ]);

            Auth::clearCacheFor($user);
        }
    }
}
