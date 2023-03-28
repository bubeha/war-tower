<?php

declare(strict_types=1);

namespace App\Game\Domain\Repository\User;

use App\Game\Domain\Entity\User;

interface GetCurrentUser
{
    public function getCurrentUser(): null|User;
}
