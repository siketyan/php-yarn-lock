<?php

declare(strict_types=1);

namespace Siketyan\YarnLock\Classic;

use Siketyan\YarnLock\AbstractPackage;
use Siketyan\YarnLock\Constraints;

class Package extends AbstractPackage
{
    private string $resolvedUrl;
    private string $integrity;

    /**
     * @phpstan-param Constraints<Constraint> $constraints
     */
    public function __construct(
        Constraints $constraints,
        string $version,
        string $resolution,
        string $checksum,
    ) {
        parent::__construct($constraints, $version);

        $this->resolvedUrl = $resolution;
        $this->integrity = $checksum;
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
