<?php

namespace App\Shared\Query;

use App\Shared\Query\Querynterface;

interface QueryHandlerInterface
{
    public function handle(QueryInterface $query): mixed;
}
