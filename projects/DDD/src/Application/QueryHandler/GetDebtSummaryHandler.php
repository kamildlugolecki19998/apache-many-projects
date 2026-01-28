<?php

namespace App\Application\QueryHandler;

use App\Shared\Query\QueryInterface;
use App\Shared\Query\QueryHandlerInterface;
use App\Domain\Debt\Repository\DebtRepositoryInterface;

class GetDebtSummaryHandler implements QueryHandlerInterface
{
    public function __construct(private DebtRepositoryInterface $debtRepository) {}

    public function handle(QueryInterface $query): mixed
    {
        $debt = $this->debtRepository->findById($query->getDebtId());
        if (!$debt) {
            throw new \Exception('Debt not found');
        }
        return [
            'debtId' => $debt->getId(),
            'amount' => $debt->getAmount(),
            'status' => $debt->getStatus()
        ];
    }

}