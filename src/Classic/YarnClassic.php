<?php

declare(strict_types=1);

namespace Siketyan\YarnLock\Classic;

use Siketyan\YarnLock\Constraints;
use Siketyan\YarnLock\Internal\Assert;
use Siketyan\YarnLock\Internal\AssertionException;
use Siketyan\YarnLock\MalformedYarnLockException;
use Siketyan\YarnLock\YarnVersionInterface;

/**
 * @implements YarnVersionInterface<Package>
 */
class YarnClassic implements YarnVersionInterface
{
    public function supports(?array $metadata): bool
    {
        return $metadata === null;
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
                    new Constraints(array_map(static fn (string $c): Constraint => Constraint::parse(trim($c)), explode(',', $key))),
                    Assert::nonEmptyString(Assert::in('version', $value)),
                    Assert::nonEmptyString(Assert::in('resolved', $value)),
                    Assert::nonEmptyString(Assert::in('integrity', $value)),
                );
            } catch (AssertionException $e) {
                throw new MalformedYarnLockException($e);
            }
        }

        return $packages;
    }
}
