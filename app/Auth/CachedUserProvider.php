<?php

declare(strict_types=1);

namespace App\Auth;

use App\Models\User;
use Illuminate\Auth\EloquentUserProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class CachedUserProvider extends EloquentUserProvider
{
    public function retrieveById($identifier)
    {
        return Cache::remember(
            $this->getCacheKey($identifier),
            now()->addMinutes(30),
            fn () => $this->getUser($identifier),
        );
    }

    public static function registerMacro(): void
    {
        Auth::macro('clearCache', function () {
            $userId = auth()->id();

            if (!$userId) {
                return;
            }

            Cache::forget("auth:user:{$userId}");
        });

        Auth::macro('clearCacheFor', function (User $user) {
            Cache::forget("auth:user:{$user->id}");
        });
    }

    private function getCacheKey($identifier): string
    {
        return "auth:user:{$identifier}";
    }

    private function getUser($identifier): User
    {
        $user = parent::retrieveById($identifier);

        if (!$user instanceof User) {
            throw new \RuntimeException("Cached provider works only with " . User::class);
        }

        return $user;
    }
}
