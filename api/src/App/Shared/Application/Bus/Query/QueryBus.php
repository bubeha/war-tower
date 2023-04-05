<?php

declare(strict_types=1);

namespace App\Shared\Application\Bus\Query;

interface QueryBus
{
    public function query(Query $query): mixed;
}
