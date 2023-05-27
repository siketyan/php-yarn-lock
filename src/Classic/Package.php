<?php

declare(strict_types=1);

namespace Siketyan\YarnLock\Classic;

use Siketyan\YarnLock\AbstractPackage;
use Siketyan\YarnLock\Constraints;

/**
 * @extends AbstractPackage<Constraint>
 */
class Package extends AbstractPackage
{
    /**
     * @phpstan-param Constraints<Constraint> $constraints
     */
    public function __construct(
        Constraints $constraints,
        string $version,
        public readonly string $resolvedUrl,
        public readonly string $integrity,
    ) {
        parent::__construct($constraints, $version);
    }
}
