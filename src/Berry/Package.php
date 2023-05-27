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

    private string $resolution;
    private string $languageName;
    private string $linkType;
    private ?string $checksum;

    /**
     * @phpstan-param Constraints<Constraint> $constraints
     */
    public function __construct(
        Constraints $constraints,
        string $version,
        string $resolution,
        string $languageName,
        string $linkType,
        ?string $checksum = null
    ) {
        parent::__construct($constraints, $version);

        $this->resolution = $resolution;
        $this->languageName = $languageName;
        $this->linkType = $linkType;
        $this->checksum = $checksum;
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
