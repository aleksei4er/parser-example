<?php

namespace App\Parser\Item\Domain\Contracts;

use Doctrine\Common\Collections\ArrayCollection;

interface SiteStrategyInterface
{
    /**
     * Load urls from the listing
     *
     * @return array
     */
    public function loadUrls(): ArrayCollection;

    /**
     * Load data of the particular item by url
     *
     * @param string $url
     * @return array
     */
    public function loadData(string $url): array;
}
