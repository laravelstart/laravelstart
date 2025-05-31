<?php

declare(strict_types=1);

namespace App\Http\Resources;

use App\Models\StarterKit;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin StarterKit
 */
class StarterKitResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'slug' => $this->slug,
            'installsCount' => $this->installs_count,
            'user' => $this->whenLoaded('user',
                fn () => new UserResource($this->user),
            ),
            'repoOrganisation' => $this->repo_organisation,
            'repoName' => $this->repo_name,
            'repoBranch' => $this->repo_branch,
            'repoUrl' => $this->repo_branch === 'main'
                ? "https://github.com/{$this->repo_organisation}/{$this->repo_name}"
                : "https://github.com/{$this->repo_organisation}/{$this->repo_name}/tree/{$this->repo_branch}",
            'isPublic' => $this->is_public,
            'composerDependencies' => $this->composer_dependencies,
            'nodeDependencies' => $this->node_dependencies,
            'tags' => $this->getTags(),
            'lastUpdatedAt' => $this->updated_at ?? $this->created_at,
        ];
    }
}
