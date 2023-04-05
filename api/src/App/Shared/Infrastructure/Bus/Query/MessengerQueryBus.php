<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Bus\Query;

use App\Shared\Application\Bus\Query\Query;
use App\Shared\Application\Bus\Query\QueryBus;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Messenger\Stamp\HandledStamp;

final readonly class MessengerQueryBus implements QueryBus
{
    public function __construct(private MessageBusInterface $messageBus)
    {
    }

    public function query(Query $query): mixed
    {
        $envelope = $this->messageBus->dispatch($query);

        /** @var HandledStamp $stamp */
        $stamp = $envelope->last(HandledStamp::class);

        return $stamp->getResult();
    }
}
