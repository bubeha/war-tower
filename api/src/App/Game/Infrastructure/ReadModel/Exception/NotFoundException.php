<?php

declare(strict_types=1);

namespace App\Game\Infrastructure\ReadModel\Exception;

use Exception;

final class NotFoundException extends Exception
{
    public function __construct()
    {
        parent::__construct('Resource not found');
    }
}
