<?php

declare(strict_types=1);

namespace Siketyan\YarnLock\Berry;

use Siketyan\YarnLock\Constraints;
use Siketyan\YarnLock\Internal\Assert;
use Siketyan\YarnLock\Internal\AssertionException;
use Siketyan\YarnLock\MalformedYarnLockException;
use Siketyan\YarnLock\YarnVersionInterface;

/**
 * @implements YarnVersionInterface<Package>
 */
class YarnBerry implements YarnVersionInterface
{
    public function supports(?array $metadata): bool
    {
        return $metadata !== null;
    }

    /**
     * @return list<Package>
     *
     * @throws MalformedYarnLockException
     */
    public function packages(array $yarnLock): array
    {
        $packages = [];

        foreach ($yarnLock as $key => $value) {
            try {
                $packages[] = new Package(
                    new Constraints(array_map(fn (string $c): Constraint => Constraint::parse(trim($c)), explode(',', $key))),
                    Assert::nonEmptyString(Assert::in('version', $value)),
                    Assert::nonEmptyString(Assert::in('resolution', $value)),
                    Assert::nonEmptyString(Assert::in('languageName', $value)), // @phpstan-ignore-line
                    Assert::nonEmptyString(Assert::in('linkType', $value)), // @phpstan-ignore-line
                    Assert::stringOrNull($value['checksum'] ?? null),
                );
            } catch (AssertionException $e) {
                throw new MalformedYarnLockException($e);
            }
        }

        return $packages;
    }
}
