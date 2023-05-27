<?php

declare(strict_types=1);

namespace Siketyan\YarnLock\Classic;

use Siketyan\YarnLock\AbstractConstraint;
use Siketyan\YarnLock\Internal\Assert;
use Siketyan\YarnLock\Internal\AssertionException;
use Siketyan\YarnLock\MalformedYarnLockException;

class Constraint extends AbstractConstraint
{
    /**
     * @throws MalformedYarnLockException
     */
    public static function parse(string $raw): self
    {
        $parts = explode('@', $raw);

        $lastIndex = array_key_last($parts);
        $last = $parts[$lastIndex];
        $rest = \array_slice($parts, 0, $lastIndex);

        try {
            return new self(
                Assert::nonEmptyString(implode('@', $rest)),
                Assert::nonEmptyString($last),
            );
        } catch (AssertionException $e) {
            throw new MalformedYarnLockException($e);
        }
    }
}
