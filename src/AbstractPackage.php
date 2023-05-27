<?php

declare(strict_types=1);

namespace Siketyan\YarnLock;

/**
 * @template TConstraint of ConstraintInterface
 *
 * @implements PackageInterface<TConstraint>
 */
class AbstractPackage implements PackageInterface
{
    /**
     * @phpstan-param Constraints<TConstraint> $constraints
     */
    public function __construct(
        public readonly Constraints $constraints,
        public readonly string $version,
    ) {
    }

    /**
     * @return Constraints<TConstraint>
     */
    public function getConstraints(): Constraints
    {
        return $this->constraints;
    }

    public function getVersion(): string
    {
        return $this->version;
    }

    public function getName(): string
    {
        return $this->getConstraints()->first()->getName();
    }
}
