<?php

declare(strict_types=1);

namespace App\Services\ParseNodeDependencies;

interface ParseNodeDependenciesContract
{
    /**
     * @param string $rawPackageJson
     * @return list<array{
     *     package: string,
     *     version: string
     * }>
     */
    public function handle(string $rawPackageJson): array;
}
