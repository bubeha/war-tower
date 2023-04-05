<?php

declare(strict_types=1);

namespace App\User\Domain\Repository\User;

use App\User\Domain\Entity\User;

interface UserRepositoryInterface
{
    public function store(User $user): void;
}
