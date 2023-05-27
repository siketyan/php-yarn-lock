<?php

declare(strict_types=1);

namespace Siketyan\YarnLock;

use Siketyan\YarnLock\Berry\YarnBerry;
use Siketyan\YarnLock\Classic\YarnClassic;
use Symfony\Component\Yaml\Yaml;

class YarnLock
{
    private const CRLF = "\r\n";
    private const LF = "\n";

    public static function parse(string $buffer): array
    {
        $buffer = str_replace(self::CRLF, self::LF, $buffer);
        $lines = explode(self::LF, $buffer);

        if ($lines[1] === '# yarn lockfile v1') {
            $walker = new Walker($lines);
            $parser = new YarnLockParser($walker);

            return $parser->parse();
        }

        return Yaml::parse($buffer);
    }

    /**
     * @return list<PackageInterface>
     */
    public static function parsePackages(array $yarnLock): array
    {
        /** @var list<YarnVersionInterface> $versions */
        $versions = [
            new YarnBerry(),
            new YarnClassic(),
        ];

        if ($metadata = $yarnLock['__metadata'] ?? null) {
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
