<?php

namespace App\Parser\Item\Application\Query;

use Doctrine\Common\Collections\ArrayCollection;
use App\Parser\Item\Application\Traits\FindStrategy;
use App\Parser\Item\Application\Query\FetchDataQuery;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use App\Parser\Item\Domain\Contracts\ItemParserInterface;

final class FetchDataQueryHandler
{
    use FindStrategy;

    /**
     * Http client and parser are intended for FindStrategy trait.
     * 
     * @param HttpClientInterface $http 
     * @param ItemParserInterface $parser 
     * @return void 
     */
    public function __construct(private HttpClientInterface $http, private ItemParserInterface $parser) {}

    /**
     * 
     * @param FetchDataQuery $createItemCommand 
     * @return array 
     */
    public function handle(FetchDataQuery $createItemCommand): ArrayCollection
    {
        $strategy = $this->findStrategy($createItemCommand->getSiteName());
        return $strategy->loadUrls()->map(function ($url) use ($strategy) {
            return ['href' => $url] + $strategy->loadData($url);
        });
    }
}
