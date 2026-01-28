<?php

namespace App\Application\Query;

use App\Shared\Query\QueryInterface;
class GetDebtSummaryQuery implements QueryInterface 
{
    public function __construct(private string $debtId) {}

    public function getDebtId(): string
    {
        return $this->debtId;
    }

}