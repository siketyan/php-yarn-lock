<?php

declare(strict_types=1);

namespace Siketyan\YarnLock;

class YarnLockParser
{
    private const INDENT_CHAR = ' ';
    private const INDENT_WIDTH = 2;

    private const TOKEN_HASH = '#';
    private const TOKEN_QUOTE = '"';
    private const TOKEN_SPACE = ' ';
    private const TOKEN_COLON = ':';
    private const TOKEN_EMPTY = '';

    private Walker $walker;

    public function __construct(
        Walker $walker
    ) {
        $this->walker = $walker;
    }

    public function parse(): array
    {
        return $this->parseBlock(0);
    }

    private function parseBlock(int $indent): array
    {
        $block = [];

        while (($line = $this->walker->read()) !== null) {
            if (strspn($line, self::INDENT_CHAR) < $indent) {
                break;
            }

            $tokens = $this->parseLine($line);
            $this->walker->step();

            if (count($tokens) === 0) {
                continue;
            }

            $first = $tokens[array_key_first($tokens)];
            $last = $tokens[array_key_last($tokens)];

            if ($last === ':') {
                $rest = implode(array_slice($tokens, 0, count($tokens) - 1));
                $block[$rest] = $this->parseBlock($indent + self::INDENT_WIDTH);
            } else {
                $rest = implode(array_slice($tokens, 1));
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
                if (strlen($token) > 0) {
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
                if (strlen($token) > 0) {
                    $tokens[] = $token;
                    $token = '';
                }

                continue;
            }

            if ($char === self::TOKEN_QUOTE) {
                $inQuote = !$inQuote;

                continue;
            }

            if ($char === self::TOKEN_EMPTY && strlen($token) > 0) {
                $tokens[] = $token;

                continue;
            }

            $token .= $char;
        }

        return $tokens;
    }
}
