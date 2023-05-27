<?php

declare(strict_types=1);

namespace Siketyan\YarnLock;

use Siketyan\YarnLock\Berry\YarnBerry;
use Siketyan\YarnLock\Classic\YarnClassic;
use Symfony\Component\Yaml\Yaml;

/**
 * @phpstan-type YarnLockArray array<string, array<string, mixed>>
 */
class YarnLock
{
    private const CRLF = "\r\n";
    private const LF = "\n";

    /**
     * @phpstan-return YarnLockArray
     */
    public static function parse(string $buffer): array
    {
        $buffer = str_replace(self::CRLF, self::LF, $buffer);
        $lines = explode(self::LF, $buffer);

        if ($lines[1] === '# yarn lockfile v1') {
            $walker = new Walker($lines);
            $parser = new YarnLockParser($walker);

            return $parser->parse(); // @phpstan-ignore-line
        }

        return Yaml::parse($buffer); // @phpstan-ignore-line
    }

    /**
     * @phpstan-param YarnLockArray $yarnLock
     *
     * @return list<PackageInterface<ConstraintInterface>>
     */
    public static function parsePackages(array $yarnLock): array
    {
        /** @var list<YarnVersionInterface<PackageInterface<ConstraintInterface>>> $versions */
        $versions = [
            new YarnBerry(),
            new YarnClassic(),
        ];

        /** @var null|array{version: positive-int, cacheKey: positive-int} $metadata */
        $metadata = $yarnLock['__metadata'] ?? null;

        if ($metadata !== null) {
            unset($yarnLock['__metadata']);
        }

        foreach ($versions as $version) {
            if ($version->supports($metadata)) {
                return $version->packages($yarnLock);
            }
        }

        throw new YarnVersionNotSupportedException();
    }
}
