<?php

declare(strict_types=1);

namespace Siketyan\YarnLock;

/**
 * @template TConstraint of ConstraintInterface
 */
interface PackageInterface
{
    /**
     * @return Constraints<TConstraint>
     */
    public function getConstraints(): Constraints;

    public function getVersion(): string;

    public function getName(): string;
}
