<?php

declare(strict_types=1);

namespace App\Services\ParseComposerDependencies;

interface ParseComposerDependenciesContract
{
    /**
     * @param string $rawComposerJson
     * @return list<array{
     *     package: string,
     *     version: string
     * }>
     */
    public function handle(string $rawComposerJson): array;
}
