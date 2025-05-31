<?php

declare(strict_types=1);

namespace App\Services\ParseComposerDependencies;

use MCStreetguy\ComposerParser\ComposerJson;

class ParseWithPackage implements ParseComposerDependenciesContract
{
    private const EXCLUDE = [
        'php',
        'ext-'
    ];

    public function handle(string $rawComposerJson): array
    {
        $parsedData = json_decode($rawComposerJson, true);

        $composerJson = new ComposerJson($parsedData);

        $require = $composerJson->getRequire()->getPackages();

        $filtered = array_filter($require,
            fn (array $item) => !self::isPackageExcluded($item['package'])
        );

        return array_values($filtered);
    }

    private static function isPackageExcluded(string $package): bool
    {
        foreach (self::EXCLUDE as $exclude) {
            if (str($package)->startsWith($exclude)) {
                return true;
            }
        }

        return false;
    }
}
