<?php

declare(strict_types=1);

namespace Siketyan\YarnLock;

use Siketyan\YarnLock\Classic\Package;

interface YarnVersionInterface
{
    public function supports(?array $metadata): bool;

    /**
     * @param array<string, array> $yarnLock
     *
     * @return Package
     */
    public function packages(array $yarnLock): array;
}
