<?php

namespace App\Models;

use App\Models\Observers\UserObserver;
use App\Support\GithubClientFactory;
use Database\Factories\UserFactory;
use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

/**
 * @property int $id
 * @property string $name
 * @property string $provider
 * @property string $provider_id
 * @property string $token
 * @property string $image
 * @property string|null $country_code
 * @property string|null $signed_up_device
 * @property string|null $latest_device
 */
#[ObservedBy(UserObserver::class)]
class User extends Authenticatable implements FilamentUser
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    protected $guarded = [];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function syncWithSocial(\Laravel\Socialite\Contracts\User $socialUser, string $provider): void
    {
        if ($this->provider === $provider && $this->provider_id === $socialUser->getId()) {
            return;
        }

        $this->update([
            'provider' => $provider,
            'provider_id' => $socialUser->getId(),
        ]);
    }

    public function getGithubAccount(): array
    {
        return app(GithubClientFactory::class)
            ->authenticated($this)
            ->currentUser()
            ->show();
    }

    public function projects(): HasMany
    {
        return $this->hasMany(Project::class, 'user_id');
    }

    public function kits(): HasMany
    {
        return $this->hasMany(StarterKit::class, 'user_id');
    }

    public function pinnedKits(): HasMany
    {
        return $this->hasMany(PinnedKit::class, 'user_id');
    }

    public function canAccessPanel(Panel $panel): bool
    {
        return in_array($this->email, config('admin.emails'));
    }
}
