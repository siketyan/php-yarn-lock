<?php

declare(strict_types=1);

namespace Siketyan\YarnLock\Classic;

use PHPUnit\Framework\TestCase;

class ConstraintTest extends TestCase
{
    public function testParse(): void
    {
        $constraint = Constraint::parse('typescript@^5.0.4');

        $this->assertSame('typescript', $constraint->name);
        $this->assertSame('^5.0.4', $constraint->range);
    }

    public function testParsePrefixed(): void
    {
        $constraint = Constraint::parse('@types/node@^18');

        $this->assertSame('@types/node', $constraint->name);
        $this->assertSame('^18', $constraint->range);
    }
}
