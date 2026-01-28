<?php

namespace App\Domain\Debt\Repository;

use App\Domain\Debt\Entity\Debt;

interface  DebtRepositoryInterface
{
    public function findById(string $id): ?Debt;
    public function save(Debt $debt): void;
    public function remove(Debt $debt): void;
}