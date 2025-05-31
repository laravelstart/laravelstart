<?php

declare(strict_types=1);

namespace App\Support;

use Illuminate\Contracts\Support\Arrayable;

readonly class KitTag implements Arrayable
{
    public function __construct(
        public string $package,
        public string $version,
        public string $label,
    ) {}

    public function toArray()
    {
        return [
            'package' => $this->package,
            'version' => $this->version,
            'label' => $this->label,
        ];
    }
}
