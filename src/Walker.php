<?php

declare(strict_types=1);

namespace Siketyan\YarnLock;

class Walker
{
    /**
     * @var string[]
     */
    private array $lines;

    private int $cursor = 0;

    /**
     * @param string[] $lines
     */
    public function __construct(
        array $lines,
    ) {
        $this->lines = $lines;
    }

    public function read(): ?string
    {
        return $this->lines[$this->cursor] ?? null;
    }

    public function step(): void
    {
        ++$this->cursor;
    }
}
