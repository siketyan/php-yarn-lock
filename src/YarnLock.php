<?php

declare(strict_types=1);

namespace Siketyan\YarnLock;

class YarnLock
{
    private const CRLF = "\r\n";
    private const LF = "\n";

    public static function parse(string $buffer): array
    {
        $buffer = str_replace(self::CRLF, self::LF, $buffer);
        $lines = explode(self::LF, $buffer);
        $walker = new Walker($lines);
        $parser = new YarnLockParser($walker);

        return $parser->parse();
    }
}
