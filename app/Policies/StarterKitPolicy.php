<?php

namespace App\Policies;

use App\Models\StarterKit;
use App\Models\User;

class StarterKitPolicy
{
    public function see(User $user, StarterKit $kit): bool
    {
        if ($kit->is_public) {
            return true;
        }

        return $user->id === $kit->user_id;
    }
}
