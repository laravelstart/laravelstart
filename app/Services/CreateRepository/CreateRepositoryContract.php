<?php

declare(strict_types=1);

namespace App\Services\CreateRepository;

use App\Models\User;
use App\Support\GitRepository;

interface CreateRepositoryContract
{
    /**
     * @param GitRepository $target
     * @return array{
     *     id: int,
     *     name: string,
     *     full_name: string,
     *     private: boolean,
     *     owner: array{
     *         login: string,
     *         type: string
     *     },
     *     html_url: string,
     *     ssh_url: string,
     *     clone_url: string
     * }
     */
    public function handle(GitRepository $target): array;

    public function authorize(User $user): void;
}
