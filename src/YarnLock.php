<?php

declare(strict_types=1);

namespace Siketyan\YarnLock;

class YarnLock
{
    public static function parse(string $buffer, string $eol = "\n"): array
    {
        $lines = explode($eol, $buffer);
        $walker = new Walker($lines);
        $parser = new YarnLockParser($walker);

        return $parser->parse();
    }
}
