<?php

namespace App\Parser\Item\Application\Services;

use App\Parser\Site\Domain\Entity\Site;
use App\Shared\Domain\CQRS\CommandBusInterface;
use App\Parser\Item\Application\Query\FetchDataQuery;
use App\Parser\Item\Application\Command\CreateItemCommand;
use App\Parser\Item\Application\Query\FetchDataQueryHandler;
use App\Parser\Item\Domain\Contracts\ServiceParserInterface;
use App\Parser\Item\Application\Command\CreateItemCommandHandler;

class Parser implements ServiceParserInterface
{
    public function __construct(
        protected FetchDataQueryHandler $fetchDataHandler,
        protected CreateItemCommandHandler $createItemHandler,
        protected CommandBusInterface $bus
    ) {}

    /**
     * 
     * @param Site $site 
     * @return void 
     */
    public function process(Site $site): void
    {
        $this->fetchDataHandler->handle(new FetchDataQuery($site->getTitle()))->forAll(function($_, $value) use ($site) {
            try {
                $this->bus->dispatch(new CreateItemCommand($site, $value));
            } catch (\Throwable $e) {
                echo $e->getMessage() . "\n";
                echo "Skipping {$value['href']}\n";
            }
            return true;
        });
    }
}
