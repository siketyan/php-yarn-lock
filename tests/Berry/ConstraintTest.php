<?php

declare(strict_types=1);

namespace Siketyan\YarnLock\Berry;

use PHPUnit\Framework\TestCase;

class ConstraintTest extends TestCase
{
    public function testParse(): void
    {
        $constraint = Constraint::parse(
            'fsevents@patch:fsevents@^2.3.2#~builtin<compat/fsevents>',
        );

        $this->assertSame('fsevents', $constraint->getName());
        $this->assertSame('fsevents@^2.3.2#~builtin<compat/fsevents>', $constraint->getRange());
        $this->assertSame('patch', $constraint->getPrefix());
    }
}
