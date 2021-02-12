<?php

namespace App\Parser\Item\Application\Query;

use Doctrine\Common\Collections\ArrayCollection;
use App\Parser\Item\Application\Query\FetchDataQuery;

final class FetchDataQueryHandler extends BaseQueryHandler
{
    /**
     * 
     * @param FetchDataQuery $createItemCommand 
     * @return ArrayCollection 
     */
    public function handle(FetchDataQuery $createItemCommand): ArrayCollection
    {
        $strategy = $this->findStrategy($createItemCommand->getSiteName());
        return $strategy->loadUrls()->map(function ($url) use ($strategy) {
            return ['href' => $url] + $strategy->loadData($url);
        });
    }
}
