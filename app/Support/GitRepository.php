<?php

declare(strict_types=1);

namespace App\Support;

class GitRepository
{
    public function __construct(
        public readonly string $owner,
        public readonly string $name,
        public readonly ?bool $isOrganisation = null,
        public readonly string $branch = 'main',
        public readonly ?bool $public = null,
    ) {}
}
