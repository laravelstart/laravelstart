<?php

namespace App\Models\Observers;

use App\Jobs\SendWelcomeEmail;
use App\Models\User;

class UserObserver
{
    public function created(User $user): void
    {
        SendWelcomeEmail::dispatchAfterResponse($user);
    }
}
