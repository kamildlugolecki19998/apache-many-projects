<?php

namespace App\Infrastructure\Persistence;
use App\Domain\Debt\Entity\Debt;
use Doctrine\ORM\EntityManagerInterface;
use App\Domain\Debt\Repository\DebtRepositoryInterface;

class DoctrineDebtRepository implements DebtRepositoryInterface
{
    public function __construct(private EntityManagerInterface $entityManager) {}

    public function findById(string $id): ?Debt
    {
        return $this->entityManager->find(Debt::class, $id);
    }

    public function save(Debt $debt): void
    {
        $this->entityManager->persist($debt);
        $this->entityManager->flush();
    }

    public function remove(Debt $debt): void
    {
        $this->entityManager->remove($debt);
        $this->entityManager->flush();
    }
}