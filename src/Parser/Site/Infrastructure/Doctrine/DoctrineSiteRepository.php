<?php

namespace App\Parser\Site\Infrastructure\Doctrine;

use App\Parser\Site\Domain\Entity\Site;
use App\Parser\Site\Domain\Repository\SiteRepositoryInterface;
use App\Shared\Infrastructure\Doctrine\DoctrineRepository;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\ORMInvalidArgumentException;
use Doctrine\ORM\ORMException;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\Persistence\ManagerRegistry;
use LogicException;

class DoctrineSiteRepository extends DoctrineRepository implements SiteRepositoryInterface
{
    /**
     * 
     * @param ManagerRegistry $registry 
     * @return void 
     * @throws LogicException 
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Site::class);
    }

    /**
     * 
     * @param string $title 
     * @return Site 
     * @throws ORMInvalidArgumentException 
     * @throws ORMException 
     * @throws OptimisticLockException 
     */
    public function create(string $title): Site
    {
        $site = new Site();

        $site->setTitle($title);

        $this->persist($site);

        return $site;
    }

    /**
     * 
     * @param string $title 
     * @return Site 
     */
    public function findByTitle(string $title): Site
    {
        return $this->findOneBy(['title' => $title]);
    }

    /**
     * 
     * @param string $title 
     * @return Site 
     * @throws ORMInvalidArgumentException 
     * @throws ORMException 
     * @throws OptimisticLockException 
     */
    // public function createFromArray(string $title): Site
    // {
    //     $site = new Site();

    //     $site->setTitle($title);

    //     $this->persist($site);

    //     return $site;
    // }
}
