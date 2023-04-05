<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Bus\Command;

use App\Shared\Application\Bus\Command\Command;
use App\Shared\Application\Bus\Command\CommandBus;
use Symfony\Component\Messenger\MessageBusInterface;

final readonly class MessengerCommandBus implements CommandBus
{
    public function __construct(private MessageBusInterface $messageBus)
    {
    }

    public function handle(Command $command): void
    {
        $this->messageBus->dispatch($command);
    }
}
