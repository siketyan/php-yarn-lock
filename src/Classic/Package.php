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
        private readonly string $resolvedUrl,
        private readonly string $integrity,
    ) {
        parent::__construct($constraints, $version);
    }

    public function getResolvedUrl(): string
    {
        return $this->resolvedUrl;
    }

    public function getIntegrity(): string
    {
        return $this->integrity;
    }
}
