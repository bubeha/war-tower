<?php

declare(strict_types=1);

namespace App\User\Application\SignUp;

use App\Shared\Application\Bus\Command\CommandHandler;
use App\User\Domain\Entity\User;
use App\User\Domain\Repository\User\UserRepositoryInterface;

final readonly class SignUpHandler implements CommandHandler
{
    public function __construct(private UserRepositoryInterface $repository)
    {
    }

    /**
     * @throws \App\Shared\Domain\Exception\DateTimeException
     */
    public function __invoke(SignUpCommand $command): void
    {
        // todo add validate email logic
        $user = User::create($command->getId(), $command->getName(), \str_replace(' ', '_', \strtolower($command->getName())), $command->getEmail());

        $this->repository->store($user);
    }
}
