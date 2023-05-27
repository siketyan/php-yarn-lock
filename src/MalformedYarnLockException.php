<?php

declare(strict_types=1);

namespace Siketyan\YarnLock;

class MalformedYarnLockException extends \Exception
{
    public function __construct(?\Throwable $previous = null)
    {
        parent::__construct('Malformed yarn.lock found.', 0, $previous);
    }
}
