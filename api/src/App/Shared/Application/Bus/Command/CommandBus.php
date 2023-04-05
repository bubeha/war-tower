<?php

namespace App\Shared\Application\Bus\Command;

interface CommandBus
{
    public function handle(Command $command): void;
}
