<?php

declare(strict_types=1);

namespace Siketyan\YarnLock\Berry;

use Siketyan\YarnLock\AbstractPackage;
use Siketyan\YarnLock\Constraints;

/**
 * @extends AbstractPackage<Constraint>
 */
class Package extends AbstractPackage
{
    public const LANGUAGE_NODE = 'node';
    public const LANGUAGE_UNKNOWN = 'unknown';

    public const LINK_HARD = 'hard';
    public const LINK_SOFT = 'soft';

    /**
     * @phpstan-param Constraints<Constraint> $constraints
     * @phpstan-param self::LANGUAGE_* $languageName
     * @phpstan-param self::LINK_* $linkType
     */
    public function __construct(
        Constraints $constraints,
        string $version,
        public readonly string $resolution,
        public readonly string $languageName,
        public readonly string $linkType,
        public readonly ?string $checksum = null,
    ) {
        parent::__construct($constraints, $version);
    }
}
