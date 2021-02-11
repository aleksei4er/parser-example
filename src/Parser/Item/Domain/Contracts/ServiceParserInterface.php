<?php

namespace App\Parser\Item\Domain\Contracts;

use App\Parser\Site\Domain\Entity\Site;

interface ServiceParserInterface
{
    public function process(Site $site): void;
}
