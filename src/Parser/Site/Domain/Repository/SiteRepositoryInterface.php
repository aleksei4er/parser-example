<?php

namespace App\Parser\Site\Domain\Repository;

use App\Parser\Site\Domain\Entity\Site;

interface SiteRepositoryInterface
{
    public function create(string $title): Site;

    public function findByTitle(string $title);
}
