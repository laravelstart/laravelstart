<?php

declare(strict_types=1);

namespace App\Support;

use App\Models\User;
use Github\AuthMethod;
use Github\Client;
use RuntimeException;

class GithubClientFactory
{
    public function authenticated(User $user): Client
    {
        if (!$user->token) {
            throw new RuntimeException("Invalid user provided");
        }

        $client = new \Github\Client();
        $client
            ->authenticate($user->token, authMethod: AuthMethod::ACCESS_TOKEN);

        return $client;
    }
}
