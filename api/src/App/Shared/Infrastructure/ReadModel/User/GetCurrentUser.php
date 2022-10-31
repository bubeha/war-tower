<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\ReadModel\User;

use App\Shared\Domain\Entity\User;

interface GetCurrentUser
{
    public function getCurrentUser(): null|User;
}