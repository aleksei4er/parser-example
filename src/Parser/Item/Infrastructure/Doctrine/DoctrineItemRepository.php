<?php

namespace App\Parser\Item\Infrastructure\Doctrine;

use App\Parser\Item\Domain\Entity\Item;
use App\Parser\Item\Domain\Repository\ItemRepositoryInterface;
use App\Parser\Site\Domain\Entity\Site;
use App\Shared\Infrastructure\Doctrine\DoctrineRepository;
use Doctrine\ORM\ORMInvalidArgumentException;
use Doctrine\ORM\ORMException;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\Query;
use Doctrine\Persistence\ManagerRegistry;
use LogicException;
use RuntimeException;

class DoctrineItemRepository extends DoctrineRepository implements ItemRepositoryInterface
{
    /**
     * 
     * @param ManagerRegistry $registry 
     * @return void 
     * @throws LogicException 
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Item::class);
    }

    /**
     * 
     * @param string $href 
     * @param string $data 
     * @return Item 
     * @throws ORMInvalidArgumentException 
     * @throws ORMException 
     * @throws OptimisticLockException 
     */
    public function create(Site $site, string $href, string $data): Item
    {
        $item = new Item();

        $item->setSite($site);

        $item->setHref($href);

        $item->setData($data);

        $this->persist($item);

        return $item;
    }

    /**
     * 
     * @return Query 
     */
    public function listing(): Query
    {
        return $this->getEntityManager()
            ->createQuery('SELECT t.id, t.href, t.data FROM 
                App\Parser\Item\Domain\Entity\Item t
            ');
    }

    /**
     * 
     * @param string $href 
     * @return Item 
     * @throws RuntimeException 
     */
    public function findByHref(string $href): Item
    {
        return $this->findOneBy(['href' => $href]);
    }
}
