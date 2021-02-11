<?php

namespace App\Parser\Item\Application\Traits;

use Symfony\Component\String\UnicodeString;
use App\Parser\Item\Domain\Contracts\SiteStrategyInterface;

trait FindStrategy
{
    /**
     * Instantiate strategy object
     * 
     * @param string $site 
     * @return SiteStrategyInterface 
     */
    protected function findStrategy(string $site): SiteStrategyInterface
    {
        $strategyClass = (new UnicodeString($site))
            ->camel()->title()
            ->prepend('\\App\\Parser\\Item\\Infrastructure\\Strategy\\')
            ->append('Strategy')
            ->__toString();

        return new $strategyClass($this->http, $this->parser);
    }
}
