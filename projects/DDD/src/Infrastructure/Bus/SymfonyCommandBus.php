<?php

namespace App\Infrastructure\Bus;

use App\Shared\Command\CommandInterface;
use Symfony\Component\Messenger\MessageBusInterface;

class SymfonyCommandBus 
{
    public function __construct(private MessageBusInterface $messageBus) {}

    public function dispatch(CommandInterface $command): void
    {
        $this->messageBus->dispatch($command);
    }
}