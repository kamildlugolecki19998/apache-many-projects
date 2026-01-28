<?php

namespace App\Shared\Bus;

use App\Shared\Command\CommandInterface;

interface CommandBusInterface
{
    public function dispatch(CommandInterface $command): void;
}
