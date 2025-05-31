<?php

declare(strict_types=1);

namespace App\Http\Resources;

use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin Project
 */
class ProjectResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'kit' => $this->whenLoaded('starterKit',
                fn () => new StarterKitResource($this->starterKit),
            ),
            'repoOwner' => $this->repo_owner,
            'repoName' => $this->repo_name,
            'repoUrl' => $this->repo_url,
            'sshUrl' => $this->ssh_url,
            'httpsUrl' => $this->https_url,
            'createdAt' => $this->created_at,
            'commit' => $this->commit,
        ];
    }
}
