<?php

declare(strict_types=1);

namespace Siketyan\YarnLock\Classic;

use PHPUnit\Framework\TestCase;

class ConstraintTest extends TestCase
{
    public function testParse(): void
    {
        $constraint = Constraint::parse('typescript@^5.0.4');

        $this->assertSame('typescript', $constraint->getName());
        $this->assertSame('^5.0.4', $constraint->getRange());
    }

    public function testParsePrefixed(): void
    {
        $constraint = Constraint::parse('@types/node@^18');

        $this->assertSame('@types/node', $constraint->getName());
        $this->assertSame('^18', $constraint->getRange());
    }
}
