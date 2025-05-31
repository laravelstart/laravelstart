<?php

declare(strict_types=1);

namespace App\Services\CreateRepository;

use App\Models\User;
use App\Support\GitRepository;

class Fake implements CreateRepositoryContract
{
    public function handle(GitRepository $target): array
    {
        if (null === $target->isOrganisation) {
            throw new \InvalidArgumentException('isOrganisation parameter is required.');
        }

        if (null === $target->public) {
            throw new \InvalidArgumentException('public parameter is required.');
        }

        return [
            "id" => 941934851,
            "name" => "test-repo",
            "full_name" => "webpnk/test-repo",
            "private" => true,
            "owner" => [
                "login" => "webpnk",
                "type" => "User",
            ],
            "html_url" => "https://github.com/webpnk/test-repo",
            "ssh_url" => "git@github.com/webpnk/test-repo.git",
            "clone_url" => "https://github.com/webpnk/test-repo.git",
        ];
    }

    public function authorize(User $user): void
    {
    }
}
