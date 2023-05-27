<?php

declare(strict_types=1);

namespace Siketyan\YarnLock;

/**
 * @template TPackage of PackageInterface
 */
interface YarnVersionInterface
{
    /**
     * @param null|array{version: positive-int, cacheKey: positive-int} $metadata
     */
    public function supports(?array $metadata): bool;

    /**
     * @param array<string, array<string, mixed>> $yarnLock
     *
     * @return list<TPackage>
     */
    public function packages(array $yarnLock): array;
}
