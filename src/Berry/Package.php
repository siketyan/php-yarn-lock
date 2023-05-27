<?php

declare(strict_types=1);

namespace Siketyan\YarnLock\Berry;

use Siketyan\YarnLock\AbstractPackage;
use Siketyan\YarnLock\Constraints;

class Package extends AbstractPackage
{
    public const LANGUAGE_NODE = 'node';
    public const LANGUAGE_UNKNOWN = 'unknown';

    public const LINK_HARD = 'hard';
    public const LINK_SOFT = 'soft';

    /**
     * @phpstan-param Constraints<Constraint> $constraints
     */
    public function __construct(
        Constraints $constraints,
        string $version,
        private readonly string $resolution,
        private readonly string $languageName,
        private readonly string $linkType,
        private readonly ?string $checksum = null,
    ) {
        parent::__construct($constraints, $version);
    }

    public function getResolution(): string
    {
        return $this->resolution;
    }

    /**
     * @return self::LANGUAGE_*
     */
    public function getLanguageName(): string
    {
        return $this->languageName;
    }

    /**
     * @return self::LINK_*
     */
    public function getLinkType(): string
    {
        return $this->linkType;
    }

    public function getChecksum(): ?string
    {
        return $this->checksum;
    }
}
