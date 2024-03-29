<?php

declare(strict_types=1);

namespace Siketyan\YarnLock\Berry;

use Siketyan\YarnLock\AbstractConstraint;
use Siketyan\YarnLock\Internal\Assert;
use Siketyan\YarnLock\Internal\AssertionException;
use Siketyan\YarnLock\MalformedYarnLockException;

class Constraint extends AbstractConstraint
{
    public function __construct(
        string $name,
        string $range,
        public readonly ?string $prefix = null,
    ) {
        parent::__construct($name, $range);
    }

    public function hasSuffix(): bool
    {
        return $this->prefix !== '';
    }

    /**
     * @throws MalformedYarnLockException
     */
    public static function parse(string $raw): self
    {
        $parts = explode('@', $raw);

        try {
            $offset = Assert::string(Assert::in(0, $parts)) === '' ? 2 : 1;
            $range = explode(':', implode('@', \array_slice($parts, $offset)), 2);

            return new self(
                Assert::nonEmptyString(implode('@', \array_slice($parts, 0, $offset))),
                Assert::nonEmptyString($range[array_key_last($range)]),
                \count($range) > 1 ? Assert::nonEmptyString($range[array_key_first($range)]) : null,
            );
        } catch (AssertionException $e) {
            throw new MalformedYarnLockException($e);
        }
    }
}
