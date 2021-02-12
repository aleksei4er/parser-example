<?php

namespace App\Parser\Item\Application\Query;

use App\Parser\Item\Domain\Contracts\ItemParserInterface;
use App\Parser\Item\Domain\Contracts\SiteStrategyInterface;
use App\Shared\Infrastructure\HttpClient\ClientServiceInterface;
use App\Shared\Infrastructure\String\UnicodeStringProxy;

class BaseQueryHandler
{
    /**
     * 
     * @param ClientServiceInterface $http 
     * @param ItemParserInterface $parser 
     * @return void 
     */
    public function __construct(
        private ClientServiceInterface $http,
        private ItemParserInterface $parser,
        protected UnicodeStringProxy $string
        ) {}

    /**
     * Instantiate strategy object
     * 
     * @param string $site 
     * @return SiteStrategyInterface 
     */
    protected function findStrategy(string $site): SiteStrategyInterface
    {
        $strategyClass = $this->string->append($site)
            ->camel()->title()
            ->prepend('\\App\\Parser\\Item\\Infrastructure\\Strategy\\')
            ->append('Strategy')
            ->__toString();

        return new $strategyClass($this->http, $this->parser);
    }
}
