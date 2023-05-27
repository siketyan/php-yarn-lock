<?php

declare(strict_types=1);

namespace Siketyan\YarnLock;

class YarnVersionNotSupportedException extends \RuntimeException
{
    public function __construct()
    {
        parent::__construct('This yarn.lock file is not supported by siketyan/php-yarn-lock yet.');
    }
}
