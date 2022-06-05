<?php

declare(strict_types=1);

namespace App\Infrastructure\ReadModel\User;

use App\Domain\Entity\User;

interface GetCurrentUser
{
    public function getCurrentUser(): null|User;
}
