<?php

namespace App\Application\Command;

use App\Shared\Command\CommandInterface;

class UpdateDebtAmount implements CommandInterface 
{
    public function __construct(
        private string $debtId,
        private float $newAmount
    ) {}

    public function getDebtId(): string
    {
        return $this->debtId;
    }

    public function getNewAmount(): float
    {
        return $this->newAmount;
    }
}