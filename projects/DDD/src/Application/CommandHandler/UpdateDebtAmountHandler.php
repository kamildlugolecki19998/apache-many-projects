<?php

namespace App\Application\Command\CommandHandler;

use App\Shared\Command\CommandHandlerIntrerface;
use App\Shared\Command\CommandInterface;

 class UpdateDebtAmountHandler implements CommandHandlerIntrerface 
{

    public function __construct(private DebtRepositoryInterface $debtRepository) {}


    public function handle(CommandInterface $command): void
    {
        $debt = $this->debtRepository->findById($command->getDebtId());
        if (!$debt) {
            throw new \Exception('Debt not found');
        }
        $debt->updateAmount($command->getNewAmount());
        $this->debtRepository->save($debt);
    }
}