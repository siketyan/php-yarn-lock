<?php

declare(strict_types=1);

namespace Siketyan\YarnLock;

/**
 * @template TConstraint of ConstraintInterface
 */
class Constraints
{
    /**
     * @param non-empty-list<TConstraint> $constraints
     */
    public function __construct(
        public readonly array $constraints,
    ) {
    }

    public function first(): ConstraintInterface
    {
        return $this->constraints[array_key_first($this->constraints)];
    }

    /**
     * @return list<TConstraint>
     */
    public function all(): array
    {
        return $this->constraints;
    }
}
