<?php

declare(strict_types=1);

namespace App\Domain\Exception;

use Exception;

final class DateTimeException extends Exception
{
    public function __construct(Exception $e)
    {
        parent::__construct('Date and time are malformed or invalid', 500, $e);
    }
}
