<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Doctrine;

use Symfony\Component\String\UnicodeString;
use App\Shared\Domain\Aggregate\AggregateRoot;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\ORMInvalidArgumentException;
use Doctrine\ORM\ORMException;
use Doctrine\ORM\OptimisticLockException;

abstract class DoctrineRepository extends ServiceEntityRepository
{
    /**
     * 
     * @param AggregateRoot $entity 
     * @return void 
     * @throws ORMInvalidArgumentException 
     * @throws ORMException 
     * @throws OptimisticLockException 
     */
    protected function persist(AggregateRoot $entity): void
    {
        $this->getEntityManager()->persist($entity);
        $this->getEntityManager()->flush();
    }
}
