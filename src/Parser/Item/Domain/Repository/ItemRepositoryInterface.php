<?php

namespace App\Parser\Item\Domain\Repository;

use Doctrine\ORM\Query;
use App\Parser\Item\Domain\Entity\Item;
use App\Parser\Site\Domain\Entity\Site;

interface ItemRepositoryInterface
{
    public function find(int $id);

    public function findByHref(string $href): Item | null;

    public function listing(): Query;

    public function create(Site $site, string $href, string $data): Item;
}
