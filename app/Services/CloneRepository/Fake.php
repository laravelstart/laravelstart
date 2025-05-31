<?php

declare(strict_types=1);

namespace App\Services\CloneRepository;

use App\Models\User;
use App\Support\GitRepository;

class Fake implements CloneRepositoryContract
{
    public function __construct()
    {
    }

    public function handle(GitRepository $source): string
    {
        return '';
    }

    public function authorize(User $user): void
    {
    }
}
