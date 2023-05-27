<?php

declare(strict_types=1);

namespace Siketyan\YarnLock\Berry;

use Siketyan\YarnLock\AbstractConstraint;
use Siketyan\YarnLock\Internal\Assert;
use Siketyan\YarnLock\Internal\AssertionException;
use Siketyan\YarnLock\MalformedYarnLockException;

class Constraint extends AbstractConstraint
{
    private ?string $prefix;

    public function __construct(
        string $name,
        string $range,
        ?string $prefix = null,
    ) {
        parent::__construct($name, $range);

        $this->prefix = $prefix;
    }

    public function getPrefix(): ?string
    {
        return $this->prefix;
    }

    public function hasSuffix(): bool
    {
        return $this->getPrefix() !== '';
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
