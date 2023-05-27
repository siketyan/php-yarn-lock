<?php

declare(strict_types=1);

namespace Siketyan\YarnLock;

abstract class AbstractConstraint implements ConstraintInterface
{
    private string $name;
    private string $range;

    public function __construct(
        string $name,
        string $range
    ) {
        $this->name = $name;
        $this->range = $range;
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
