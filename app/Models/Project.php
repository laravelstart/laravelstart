<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property int $user_id
 * @property int $starter_kit_id
 * @property string $github_id
 * @property string $repo_owner
 * @property string $repo_name
 * @property string $repo_url
 * @property string $ssh_url
 * @property string $https_url
 * @property string $is_private
 * @property array{
 *      commit_sha: string,
 *      message: string,
 *      author: string,
 *      email: string,
 *      created_at: array{ date: string, timezone_type: int, timezone: string },
 *  } $commit
 * @property Carbon $created_at
 * @property Carbon|null $updated_at
 *
 * @property StarterKit $starterKit
 */
class Project extends Model
{
    protected $guarded = [];

    protected function casts(): array
    {
        return [
            'is_private' => 'boolean',
            'commit' => 'array',
        ];
    }

    public function starterKit(): BelongsTo
    {
        return $this->belongsTo(StarterKit::class, 'starter_kit_id');
    }
}
