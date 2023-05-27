<?php

declare(strict_types=1);

namespace Siketyan\YarnLock;

class YarnLockParser
{
    private const INDENT_CHAR = ' ';

    private const TOKEN_HASH = '#';
    private const TOKEN_QUOTE = '"';
    private const TOKEN_SPACE = ' ';
    private const TOKEN_COLON = ':';
    private const TOKEN_EMPTY = '';

    public function __construct(
        private readonly Walker $walker,
    ) {
    }

    public function parse(): array
    {
        $block = [];
        $indent = null;

        while (($line = $this->walker->read()) !== null) {
            $currentIndent = strspn($line, self::INDENT_CHAR);

            if ($currentIndent === \strlen($line)) {
                $this->walker->step();

                continue;
            }

            if ($indent === null) {
                $indent = $currentIndent;
            } elseif ($currentIndent < $indent) {
                break;
            }

            $tokens = $this->parseLine($line);
            $this->walker->step();

            if ($tokens === []) {
                continue;
            }

            $first = $tokens[array_key_first($tokens)];
            $last = $tokens[array_key_last($tokens)];

            if ($last === ':') {
                $rest = implode('', \array_slice($tokens, 0, \count($tokens) - 1));
                $block[$rest] = $this->parse();
            } else {
                $rest = implode('', \array_slice($tokens, 1));
                $block[$first] = $rest;
            }
        }

        return $block;
    }

    private function parseLine(string $line): array
    {
        $tokens = [];
        $token = self::TOKEN_EMPTY;
        $inQuote = false;

        foreach ([...str_split($line), self::TOKEN_EMPTY] as $char) {
            if ($char === self::TOKEN_HASH && !$inQuote) {
                if ($token !== '') {
                    $tokens[] = $token;
                }

                break;
            }

            if ($char === self::TOKEN_COLON && !$inQuote) {
                $tokens[] = $token;
                $tokens[] = $char;
                $token = '';

                continue;
            }

            if ($char === self::TOKEN_SPACE && !$inQuote) {
                if ($token !== '') {
                    $tokens[] = $token;
                    $token = '';
                }

                continue;
            }

            if ($char === self::TOKEN_QUOTE) {
                $inQuote = !$inQuote;

                continue;
            }

            if ($char === self::TOKEN_EMPTY && $token !== '') {
                $tokens[] = $token;

                continue;
            }

            $token .= $char;
        }

        return $tokens;
    }
}
