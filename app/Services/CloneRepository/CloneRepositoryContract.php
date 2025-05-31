<?php

declare(strict_types=1);

namespace App\Services\CloneRepository;

use App\Models\User;
use App\Support\GitRepository;

interface CloneRepositoryContract
{
    public function handle(
        GitRepository $source,
    ): string;

    public function authorize(User $user): void;
}
