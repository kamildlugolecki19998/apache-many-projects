<?php

namespace App\Infrastructure\Bus;

use App\Shared\Query\QueryInterface;
use App\Shared\Bus\QueryBusInterface;
use Symfony\Component\Messenger\MessageBusInterface;

class SymfonyQueryBus  implements QueryBusInterface
{

    use HandleTrait;

    public function __construct(private readonly MessageBusInterface $messageBus)
    {
        
    }

    public function execute(QueryInterface $query): mixed
    {
            return $this->handle($query);
    }
}