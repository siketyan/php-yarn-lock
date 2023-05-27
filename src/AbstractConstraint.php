<?php

declare(strict_types=1);

namespace Siketyan\YarnLock;

abstract class AbstractConstraint implements ConstraintInterface
{
    public function __construct(
        private readonly string $name,
        private readonly string $range,
    ) {
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getRange(): string
    {
        return $this->range;
    }
}
