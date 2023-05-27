<?php

declare(strict_types=1);

namespace Siketyan\YarnLock;

/**
 * @template TConstraint of ConstraintInterface
 */
class Constraints
{
    /**
     * @var list<TConstraint>
     */
    private array $constraints;

    /**
     * @param non-empty-list<TConstraint> $constraints
     */
    public function __construct(
        array $constraints = [],
    ) {
        $this->constraints = $constraints;
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
