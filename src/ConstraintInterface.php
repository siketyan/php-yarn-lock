<?php

declare(strict_types=1);

namespace Siketyan\YarnLock;

interface ConstraintInterface
{
    public function getName(): string;

    public function getRange(): string;
}
