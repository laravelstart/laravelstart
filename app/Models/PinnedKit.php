<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

/**
 * @property int $id
 * @property int $starter_kit_id
 * @property int $user_id
 * @property Carbon $created_at
 * @property Carbon|null $updated_at
 */
class PinnedKit extends Model
{
    protected $guarded = [];

    public function kit(): BelongsTo
    {
        return $this->belongsTo(StarterKit::class, 'starter_kit_id');
    }
}
