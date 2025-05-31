<?php

declare(strict_types=1);

namespace App\Services\ParseNodeDependencies;

use Exception;

class ParseWithJsonDecode implements ParseNodeDependenciesContract
{
    public function handle(string $rawPackageJson): array
    {
        $dependencies = $this->parseJson($rawPackageJson);

        return array_map(
            fn (string $package) => [
                'package' => $package,
                'version' => $dependencies[$package],
            ],
            array_keys($dependencies),
        );
    }

    private function parseJson(string $content): array
    {
        $data = json_decode($content, true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new Exception("Invalid package.json format");
        }

        return array_merge(
            $data['dependencies'] ?? [],
            $data['devDependencies'] ?? [],
        );
    }

}
