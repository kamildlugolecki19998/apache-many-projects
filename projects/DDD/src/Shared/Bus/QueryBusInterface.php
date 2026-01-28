<?php

namespace App\Shared\Bus;

use App\Shared\Query\QueryInterface;

interface QueryBusInterface
{
    public function execute(QueryInterface $query): mixed;
}