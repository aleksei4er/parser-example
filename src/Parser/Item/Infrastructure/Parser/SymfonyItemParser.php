<?php

namespace App\Parser\Item\Infrastructure\Parser;

use App\Shared\Infrastructure\Crawler\SymfonyCrawlerProxy;
use App\Parser\Item\Domain\Contracts\ItemParserInterface;

class SymfonyItemParser extends SymfonyCrawlerProxy implements ItemParserInterface
{

}
