<?php

namespace App\Models;

use App\Support\KitTag;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property string $title
 * @property string $slug
 * @property string $repo_organisation
 * @property string $repo_name
 * @property string $repo_branch
 * @property int $installs_count
 * @property string|null $preview_image
 * @property array|null $composer_dependencies
 * @property array|null $node_dependencies
 * @property int|null $user_id
 * @property boolean $is_public
 */
class StarterKit extends Model
{
    protected $guarded = [];

    private const TAG_LABELS = [
        'laravel/framework' => 'Laravel',
        'filament/filament' => 'Filament',
        'inertiajs/inertia-laravel' => 'Inertia',
        'livewire/flux' => 'Flux UI',
        'livewire/volt' => 'Volt',
        'tailwindcss' => 'tailwindcss',
        'vite' => 'Vite',
        'eslint' => 'ESLint',
        '@headlessui/react' => 'HeadlessUI',
        'react' => 'React',
        'typescript' => 'Typescript',
        'vue' => 'Vue',
        'next' => 'Next.js',
        'svelte' => 'Svelte',
    ];

    protected function casts(): array
    {
        return [
            'is_public' => 'boolean',
            'composer_dependencies' => 'array',
            'node_dependencies' => 'array',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * @return array<int, KitTag>
     */
    public function getTags(): array
    {
        return collect($this->composer_dependencies ?? [])
            ->merge($this->node_dependencies ?? [])
            ->filter(fn (array $dependency) => in_array($dependency['package'], array_keys(self::TAG_LABELS)))
            ->map(
                fn (array $dependency) => new KitTag(
                    package: $dependency['package'],
                    version: $dependency['version'],
                    label: self::TAG_LABELS[$dependency['package']]
                )
            )
            ->sort(function (KitTag $a, KitTag $b) {
                // Laravel Framework always comes first
                if ($b->package === 'laravel/framework') return 1;
                if ($a->package === 'laravel/framework') return -1;

                // Laravel Framework always comes first
                if ($b->package === 'filament/filament') return 1;
                if ($a->package === 'filament/filament') return -1;

                // Inertia comes next
                if ($b->package === 'inertiajs/inertia-laravel') return 1;
                if ($a->package === 'inertiajs/inertia-laravel') return -1;

                // Frontend frameworks come next
                $frontendFrameworks = ['react', 'vue', 'svelte'];
                $aIsFrontend = in_array($a->package, $frontendFrameworks);
                $bIsFrontend = in_array($b->package, $frontendFrameworks);
                if ($aIsFrontend && !$bIsFrontend) return -1;
                if (!$aIsFrontend && $bIsFrontend) return 1;

                // TypeScript comes next
                if ($b->package === 'typescript') return 1;
                if ($a->package === 'typescript') return -1;

                // Everything else maintains relative order
                return 0;
            })
            ->toArray();
    }

    public function getPreviewImagePath(): ?string
    {
        if (!$this->preview_image) {
            return '/images/og-preview.png';
        }

        return "/images/previews/{$this->preview_image}";
    }
}
